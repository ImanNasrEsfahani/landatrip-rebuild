<?php

namespace App\Listeners;

use App\Mail\CreateCommunityMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class CreateCommunityListener
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
        if ($event->community->users->first()->email) {
            Mail::to($event->community->users->first()->email)->send(new CreateCommunityMail($event->community));
        }
        info("CreateCommunityMailListener is fired for Email address: $event->community->users ");
    }
}
