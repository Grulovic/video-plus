<?php

namespace App\Console\Commands;

use App\Jobs\SendQueueEmail;
use App\Mail\GovFtpUpdate;
use App\Models\FtpGovFile;
use App\Models\Video;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class MoveVideosToExternalStorage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'moveVideosToExternalStorage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Move Videos To External Storage';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $remoteDisks = ['remote-sftp-2', 'remote-sftp'];

        Video::where('disk', 'local')
            ->where('has_missing_original_file', false)
            ->orderBy('id', 'asc')
            ->chunk(100, function ($videos) use ($remoteDisks) {
                foreach ($videos as $video) {
                    $this->info('---------------------------------------');
                    $this->info('Moving video: ' . $video->id);

                    $fileName = $video->file_name;
                    $this->info("File Name: " . $fileName);

                    if (!Storage::disk('videos')->exists($fileName)) {
                        $this->warn("File does not exist on local storage.");
                        $this->info('---------------------------------------');
                        continue;
                    }

                    $copiedToDisk = null;

                    foreach ($remoteDisks as $diskName) {
                        $this->info("Trying remote disk: {$diskName}");

                        // Open a FRESH read stream for each attempt (important).
                        $stream = Storage::disk('videos')->readStream($fileName);
                        if ($stream === false || !is_resource($stream)) {
                            $this->error("Failed to open read stream for local file on attempt to {$diskName}.");
                            continue;
                        }

                        try {
                            $ok = Storage::disk($diskName)->writeStream($fileName, $stream);

                            if ($ok) {
                                $this->info("Copy done to {$diskName}");
                                $copiedToDisk = $diskName;
                                break; // stop trying further disks
                            } else {
                                $this->error("Failed to copy to {$diskName}: Not enough space or other error.");
                            }
                        } catch (\Throwable $e) {
                            $this->error("Error copying to {$diskName}: " . $e->getMessage());
                        } finally {
                            if (is_resource($stream)) {
                                fclose($stream);
                            }
                        }
                    }

//                    if ($copiedToDisk) {
//                        // Update DB and delete local *only after* a successful remote write
//                        $video->update(['disk' => $copiedToDisk]);
//
//                        try {
//                            Storage::disk('videos')->delete($fileName);
//                            $this->info("Delete done (local) after successful copy to {$copiedToDisk}");
//                        } catch (\Throwable $e) {
//                            $this->error("Copied to {$copiedToDisk} but failed to delete local file: " . $e->getMessage());
//                        }
//                    } else {
//                        $this->error("All remote disks failed for {$fileName}. Keeping local file.");
//                    }

                    $this->info('---------------------------------------');
                }
            });

    }

}
