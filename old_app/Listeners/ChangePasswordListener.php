<?php

namespace App\Listeners;

use App\Mail\ChangePasswordMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class ChangePasswordListener
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
        if ($event->user->email) {
            Mail::to($event->user->email)->send(new ChangePasswordMail($event->user));
        }
        info("ChangePasswordMailListener is fired for Email address: $event->user");
    }
}
