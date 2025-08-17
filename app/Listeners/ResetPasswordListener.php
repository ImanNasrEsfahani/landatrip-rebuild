<?php

namespace App\Listeners;

use App\Mail\ResetPasswordMail;
use App\Mail\VerifyUserEmailMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class ResetPasswordListener
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
     * @param object $event
     *
     * @return void
     */
    public function handle($event)
    {

        if ($event->user->email) {
            Mail::to($event->user->email)->send(new ResetPasswordMail($event->user, $event->token));
        }
        info("ResetPasswordMaillListener is fired for Email address: $event->user");
    }
}
