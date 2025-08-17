<?php

namespace App\Listeners;

use App\Mail\MembershipMail;
use App\Mail\VerifyUserEmailMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class VerifyListener
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
        if(!$event->user->email_verified_at) {
            if ($event->user->email) {
                Mail::to($event->user->email)->send(new VerifyUserEmailMail($event->user));
            }
            info("VerifyUserEmailMailListener is fired for Email address: $event->user");
        }
    }
}
