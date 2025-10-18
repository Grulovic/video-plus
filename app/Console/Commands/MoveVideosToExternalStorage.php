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

                    $targetDisk   = null;   // where we will end up (exists or copied)
                    $alreadyThere = false;  // true if it already existed remotely

                    // ---------- 1) EXISTS CHECK (skip copy if found) ----------
                    foreach ($remoteDisks as $diskName) {
                        try {
                            if (Storage::disk($diskName)->exists($fileName)) {
                                try {
                                    $size = Storage::disk($diskName)->size($fileName);
                                    if ($size > 0) {
                                        $this->info("Remote already has the file on '{$diskName}' with size {$size}. Skipping copy.");
                                        $targetDisk   = $diskName;
                                        $alreadyThere = true;
                                        break;
                                    } else {
                                        $this->warn("Remote file exists on '{$diskName}' but size is 0. Will attempt copy.");
                                    }
                                } catch (\Throwable $e) {
                                    $this->warn("Failed to get remote file size on '{$diskName}': " . $e->getMessage() . ". Will attempt copy.");
                                }
                            }
                        } catch (\Throwable $e) {
                            $this->warn("Existence check failed on '{$diskName}': " . $e->getMessage());
                        }
                    }

                    // ---------- 2) COPY (only if not found anywhere) ----------
                    if (!$targetDisk) {
                        foreach ($remoteDisks as $diskName) {
                            $this->info("Attempting copy to '{$diskName}'...");

                            // Ensure parent dir on remote if path has directories
                            $dir = trim(pathinfo($fileName, PATHINFO_DIRNAME), '/.');
                            if ($dir && $dir !== $fileName) {
                                try {
                                    Storage::disk($diskName)->makeDirectory($dir);
                                } catch (\Throwable $e) {
                                    $this->warn("Could not ensure remote dir '{$dir}' on '{$diskName}': " . $e->getMessage());
                                }
                            }

                            // Fresh stream per attempt
                            $stream = Storage::disk('videos')->readStream($fileName);
                            if ($stream === false || !is_resource($stream)) {
                                $this->error("Failed to open local read stream.");
                                continue;
                            }

                            try {
                                if (Storage::disk($diskName)->writeStream($fileName, $stream)) {
                                    $this->info("Copy succeeded on '{$diskName}'.");
                                    $targetDisk = $diskName;
                                    break;
                                } else {
                                    $this->error("Copy failed on '{$diskName}'.");
                                }
                            } catch (\Throwable $e) {
                                $this->error("Error copying to '{$diskName}': " . $e->getMessage());
                            } finally {
                                if (is_resource($stream)) {
                                    fclose($stream);
                                }
                            }
                        }
                    }

                    // ---------- 3) FINALIZE (both scenarios) ----------
                    if ($targetDisk) {
                        // Update DB to whichever remote we chose
                        $video->update(['disk' => $targetDisk]);

                        // Remove local file only if remote file size > 0
                        try {
                            $remoteSize = Storage::disk($targetDisk)->size($fileName);
                            $this->info("Remote file size on '{$targetDisk}': {$remoteSize}");
                            if ($remoteSize > 0) {
//                                Storage::disk('videos')->delete($fileName);
                                $this->info(($alreadyThere ? "Skipped copy; " : "Copied; ") . "deleted local and set disk='{$targetDisk}'.");
                            } else {
                                $this->warn("Remote file size is 0 on '{$targetDisk}', skipping local file deletion.");
                            }
                        } catch (\Throwable $e) {
                            $this->warn("Failed to get remote file size on '{$targetDisk}': " . $e->getMessage() . ". Skipping local file deletion.");
                        }
                    } else {
                        $this->error("No remote had the file and copy failed on all remotes. Keeping local file.");
                    }

                    $this->info('---------------------------------------');
                }
            });


    }

}
