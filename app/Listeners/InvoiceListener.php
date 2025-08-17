<?php

namespace App\Listeners;

use App\Mail\InvoiceMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class InvoiceListener
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
            Mail::to($event->user->email)->send(new InvoiceMail($event->invoice));
        }
        info("InvoiceMailListener is fired for Email address: $event->user->email  ");
    }
}
