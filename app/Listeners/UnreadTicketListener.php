<?php

namespace App\Listeners;

use App\Mail\UnreadTicketMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class UnreadTicketListener
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
            Mail::to($event->ticket->user->email)->send(new UnreadTicketMail($event->ticket));
        }
        info("UnreadTicketMailListener is fired for Email address: $event->ticket->user ");
    }
}
