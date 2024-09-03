<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GovFtpUpdate extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $new_files;
    public function __construct($new_files)
    {
        $this->new_files = $new_files;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from( $email = config('mail.from.address'), $name = 'VideoPlus.rs' )
            ->subject('Gov FTP Updates')
            ->with([
                'new_files' => $this->new_files
            ])
            ->view('email.gov_ftp_update');
    }
}
