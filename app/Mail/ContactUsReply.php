<?php

namespace App\Mail;

use App\Models\SupportMessage;
use App\Models\Video;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ContactUsReply extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $email;
    protected $message;

    public function __construct($email,$message)
    {
        $this->email = $email;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        dd($this->from( config('mail.from.address') )
            ->with([
                'email' => $this->email,
                'message' => $this->message
            ])
            ->view('email.contact_us_reply'));
        return $this->from( config('mail.from.address') )
                    ->with([
                        'email' => $this->email,
                        'message' => $this->message
                    ])
                    ->view('email.contact_us_reply');
    }
}
