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

class SendQueueEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $data;
    public $timeout = 7200;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->data['users'] as $user){
            try {
                if (InvalidEmail::where('email', $user)->exists()) {
                    Log::info("Skipping email to invalid address: $user");
                    continue;
                }

                try {
                    Mail::to($user)->send(new $this->data['mail']($this->data['data']));
                } catch (\Exception $e) {
                    if ($e->getCode() === 550 || str_contains($e->getMessage(), '550')) {
                        InvalidEmail::firstOrCreate(['email' => $user]);
                        Log::error("Email failed and stored: $user - " . $e->getMessage());
                    }
                }
            } catch (\Exception $exception) {
                Log::error("Failed to send email to: $user");
                Log::error($exception->getMessage());
            }
        }
    }
}
