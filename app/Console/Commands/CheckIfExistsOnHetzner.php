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

class CheckIfExistsOnHetzner extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkIfExistsOnHetzner';

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
    public function handle(): int
    {
        $targetDisk = 'hetzner_sftp';

        $this->info('Starting check for videos that exist on Hetzner (disk: ' . $targetDisk . ')');

        Video::where('has_missing_original_file', false)
            ->where('disk', '!=', $targetDisk) // any disk except hetzner
            ->orderBy('id','desc')
            ->chunk(100, function ($videos) use ($targetDisk) {
                foreach ($videos as $video) {
                    $this->info('---------------------------------------');
                    $this->info('Checking video ID: ' . $video->id);

                    $fileName = $video->file_name;

                    if (!$fileName) {
                        $this->warn('Video has no file_name, skipping.');
                        continue;
                    }

                    $this->info("File Name: " . $fileName);

                    try {
                        // 1) Check if file exists on Hetzner
                        if (!Storage::disk($targetDisk)->exists($fileName)) {
                            $this->warn("File NOT found on '{$targetDisk}'. Skipping.");
                            continue;
                        }

                        // 2) Optional: verify file is non-empty
                        $size = 0;
                        try {
                            $size = Storage::disk($targetDisk)->size($fileName);
                            $this->info("Remote file size on '{$targetDisk}': {$size}");
                        } catch (\Throwable $e) {
                            $this->warn("Could not get size for '{$fileName}' on '{$targetDisk}': " . $e->getMessage());
                        }

                        if ($size <= 0) {
                            $this->warn("File exists on '{$targetDisk}' but size is 0. Not updating disk.");
                            continue;
                        }

                        // 3) Update disk to hetzner_sftp
                        $oldDisk = $video->disk;
                        $video->update(['disk' => $targetDisk]);

                        $this->info("Disk updated from '{$oldDisk}' to '{$targetDisk}' for video ID {$video->id}.");

                    } catch (\Throwable $e) {
                        $this->error("Error checking '{$fileName}' on '{$targetDisk}': " . $e->getMessage());
                    }

                    $this->info('---------------------------------------');
                }
            });

        $this->info('Finished checking videos for Hetzner presence.');

        return Command::SUCCESS;
    }

}
