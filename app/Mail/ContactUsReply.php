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
    protected $data_email;
    protected $data_message;

    public function __construct($email,$message)
    {
        $this->data_email = $email;
        $this->data_message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->from( config('mail.from.address') )
                    ->with([
                        'data_email' => $this->data_email,
                        'data_message' => $this->data_message
                    ])
                    ->view('email.contact_us_reply');
    }
}
