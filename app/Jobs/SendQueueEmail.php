<?php

namespace App\Jobs;

use App\Mail\PlanUpdated;
use App\Mail\ContactUs;
use App\Mail\GalleryUploaded;
use App\Mail\VideoUploaded;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendQueueEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->mail = $data['mail'];
        $this->users = $data['users'];
        $this->data = $data['data'];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::debug($this->mail);
        Log::debug($this->data);
        Log::debug($this->users);
        foreach ($this->users as $user){
            Mail::to( $user )->send(new $this->mail( $this->data ));
        }
    }
}
