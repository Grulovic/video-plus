<?php

namespace App\Jobs;

use App\Mail\PlanUpdated;
use App\Mail\ContactUs;
use App\Mail\GalleryUploaded;
use App\Mail\VideoUploaded;
use App\Models\InvalidEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class MoveVideoToExternal implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $video;
    public $timeout = 7200;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($video)
    {
        $this->video = $video;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $video = $this->video;

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

                    $video->update(['disk' => 'remote-sftp']);
//                            // Remove the local file only if the write operation was successful
                    Storage::disk('videos')->delete($fileName);
                    $this->info("Delete done");
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
            $this->info("File does not exist on local storage.");
        }
    }
}
