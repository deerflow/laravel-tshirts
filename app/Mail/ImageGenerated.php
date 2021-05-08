<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ImageGenerated extends Mailable
{
    use Queueable, SerializesModels;

    private $imagePath;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $imagePath)
    {
        $this->imagePath = $imagePath;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): ImageGenerated
    {
        return $this->from('test@shirtify.com')
            ->view('mails.image-generated', ['imagePath' => $this->imagePath]);
    }
}
