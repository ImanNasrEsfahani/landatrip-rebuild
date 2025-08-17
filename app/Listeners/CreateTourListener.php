<?php

namespace App\Listeners;

use App\Mail\CreateTourMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class CreateTourListener
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
        if ($event->tour->user->first()->email) {
            Mail::to($event->tour->user->first()->email)->send(new CreateTourMail($event->tour));
        }
        info("CreateTourMailListener is fired for Email address: $event->tour->users ");
    }
}
