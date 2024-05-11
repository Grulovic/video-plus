<?php

namespace App\Console\Commands;

use App\Jobs\SendQueueEmail;
use App\Mail\GovFtpUpdate;
use App\Models\FtpGovFile;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class CopyTestFileToSftpStorage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'copyTestFileToSftpStorage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Copy Test File To Sftp Storage';

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
        Log::info("Copy Test File To Sftp Storage");

        $filePath = 'copy_test.txt';

        if (Storage::disk('public_root')->exists('copy_test.txt')) {
            // Get a stream for the file on the local disk
            $stream = Storage::disk('public_root')->readStream($filePath);

            // Use the stream to write to the destination disk
            Storage::disk('remote-sftp')->writeStream($filePath, $stream);

            // Close the stream
            if (is_resource($stream)) {
                fclose($stream);
            }
        }
    }
}
