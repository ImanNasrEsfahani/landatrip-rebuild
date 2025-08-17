<?php

namespace App\Listeners;

use App\Mail\AcceptedDocMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class AcceptedDocListener
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if ($event->userDocument->user->email) {
            Mail::to($event->userDocument->user->email)->send(new AcceptedDocMail($event->userDocument));
        }
        info("AcceptedDocMailListener is fired for Email address: $event->userDocument->user ");
    }
}
