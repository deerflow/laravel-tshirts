<?php

namespace App\Listeners;

use App\Events\ImageGenerated;
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
     * @param ImageGenerated $event
     * @return void
     */
    public function handle(ImageGenerated $event)
    {
        Mail::to($event->getEmail())->send(new \App\Mail\ImageGenerated($event->getPath()));
    }
}
