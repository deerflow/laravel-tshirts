<?php

namespace App\Listeners;

use App\Events\ImageGeneratedEvent;
use App\Mail\ImageGeneratedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailWithImage implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param ImageGeneratedEvent $event
     * @return void
     */
    public function handle(ImageGeneratedEvent $event)
    {
        Mail::to($event->getEmail())->send(new ImageGeneratedMail($event->getPath()));
    }
}
