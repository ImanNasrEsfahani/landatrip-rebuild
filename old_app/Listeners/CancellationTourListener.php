<?php

namespace App\Listeners;

use App\Mail\CancellationTourMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class CancellationTourListener
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
        foreach ($event->group->users as $user) {
            if ($user->email) {
                Mail::to($user->email)->send(new CancellationTourMail($event->group));
            }
            info("CancellationTourMailListener is fired for Email address: $event->group ");
        }
    }
}
