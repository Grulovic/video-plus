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
        $this->info('TESTING 49824');
        Video::where('id',49824)->where('disk', 'local')->orderBy('id', 'desc')->chunk(100, function ($videos) {
            foreach ($videos as $video) {
                $this->info('---------------------------------------');
                $this->info('Moving video: ' . $video->id);

                $fileName = $video->file_name;
                $this->info("File Name: " . $fileName);

                if (Storage::disk('videos')->exists($fileName)) {
                    $this->info("File exists");

                    $stream = Storage::disk('videos')->readStream($fileName);

                    try {
                        // Attempt to write to the destination disk
                        if (Storage::disk('remote-sftp')->writeStream($fileName, $stream)) {
                            $this->info("Copy done");

//                            $video->update(['disk' => 'remote-sftp']);
//
//                            // Remove the local file only if the write operation was successful
//                            Storage::disk('videos')->delete($fileName);
//                            $this->info("Delete done");
                        } else {
                            $this->error("Failed to copy to remote-sftp: Not enough space or other error.");
                        }
                    } catch (\Exception $e) {
                        $this->error("Error copying file: " . $e->getMessage());
                    } finally {
                        // Close the stream if it's open
                        if (is_resource($stream)) {
                            fclose($stream);
                        }
                    }
                } else {
                    $this->warning("File does not exist on local storage.");
                }

                $this->info('---------------------------------------');
            }
        });
    }

}
