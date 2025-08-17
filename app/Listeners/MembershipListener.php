<?php

namespace App\Listeners;

use App\Mail\MembershipMail;
use App\Mail\RegistrationMail;
use Illuminate\Support\Facades\Mail;

class MembershipListener
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
        if ($event->user->hasRole(["user", "teacher", "agent"])) {
            foreach ([env('MAIL_RECIPIENT_1', null), env('MAIL_RECIPIENT_2', null), env('MAIL_RECIPIENT_3', null), $event->user->email] as $recipient) {
                if ($recipient) {
                    Mail::to($recipient)->send(new MembershipMail($event->user));
                }
            }
            info("MembershipMailListener is fired for Email address: $event->user");
        }

    }
}
