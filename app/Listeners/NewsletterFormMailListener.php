<?php

namespace App\Listeners;

use App\Events\NewsletterFormSubmit;
use App\Mail\NewsletterMail;
use Illuminate\Support\Facades\Mail;

class NewsletterFormMailListener
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
     * @param NewsletterFormSubmit $event
     *
     * @return void
     */
    public function handle(NewsletterFormSubmit $event): void
    {
        if ($event->newsletter->newsletter_email) {
                Mail::to($event->newsletter->newsletter_email)->send(new NewsletterMail($event->newsletter));
            }
        info("NewsletterMailListener is fired for Email address: $event->newsletter->newsletter_email ");
    }
}
