<?php

namespace App\Mail;

use App\Models\Gallery;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GalleryUploaded extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $product;

    public function __construct(Gallery $gallery)
    {
        $this->gallery = $gallery;
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
                        'gallery' => $this->gallery
                    ])
                    ->view('email.gallery_uploaded');
    }
}
