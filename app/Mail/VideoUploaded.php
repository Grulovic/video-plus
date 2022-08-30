<?php

namespace App\Mail;

use App\Models\Video;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VideoUploaded extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $product;

    public function __construct(Video $video)
    {
        $this->video = $video;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from( $email = config('mail.from.address'), $name = 'VideoPlus.rs' )
                    ->subject('New Video: '.substr($this->video->name,0,30).'...')
                    ->with([
                        'video' => $this->video
                    ])
                    ->view('email.video_uploaded');
    }
}
