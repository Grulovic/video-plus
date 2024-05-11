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
        Video::where('id','<=',24160)->where('disk','locale')->orderBy('id','desc')->chunk(100, function ($videos) {
            foreach ($videos as $video) {
                $this->info('---------------------------------------');
                $this->info('Moving video: ' . $video->id);

                $fileName = $video->file_name;

                $this->info("File Name: " . $fileName);

                if (Storage::disk('videos')->exists($fileName)) {
                    $this->info("File exists");
                    // Get a stream for the file on the local disk
                    $stream = Storage::disk('videos')->readStream($fileName);

                    // Use the stream to write to the destination disk
                    Storage::disk('remote-sftp')->writeStream($fileName, $stream);

                    // Close the stream
                    if (is_resource($stream)) {
                        fclose($stream);
                    }

                    $this->info("Copy done");

                    $video->update(['disk' => 'remote-sftp']);

                    //remove local file
                    Storage::disk('videos')->delete($fileName);
                    $this->info("Delete done");
                }
            }
            $this->info('---------------------------------------');
        });;
    }
}
