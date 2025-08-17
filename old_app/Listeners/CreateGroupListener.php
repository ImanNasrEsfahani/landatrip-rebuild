<?php

namespace App\Listeners;

use App\Mail\CreateGroupMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class CreateGroupListener
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
        if ($event->group->users->first()->email) {
            Mail::to($event->group->users->first()->email)->send(new CreateGroupMail($event->group));
        }
        info("CreateGroupMailListener is fired for Email address: $event->group->users ");
    }
}
