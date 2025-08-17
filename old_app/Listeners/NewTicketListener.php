<?php

namespace App\Listeners;

use App\Mail\NewTicketMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class NewTicketListener
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
        if ($event->ticket->user->email) {
            Mail::to($event->ticket->user->email)->send(new NewTicketMail($event->ticket));
        }
        info("NewTicketMailListener is fired for Email address: $event->ticket->user ");
    }
}
