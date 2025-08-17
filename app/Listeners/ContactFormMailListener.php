<?php

namespace App\Listeners;

use App\Events\ContactFormSubmit;
use App\Mail\ContactMail;
use App\Mail\NewsletterMail;
use Illuminate\Support\Facades\Mail;

class ContactFormMailListener extends BaseListener
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
     * @param ContactFormSubmit $event
     *
     * @return void
     */
    public function handle(ContactFormSubmit $event): void
    {
        foreach ([env('MAIL_RECIPIENT_1', null), env('MAIL_RECIPIENT_2', null), env('MAIL_RECIPIENT_3', null), $event->contact->email] as $recipient) {
            if ($recipient) {
                Mail::to($recipient)->send(new ContactMail($event->contact));
            }
        }
        info("ContactMailListener is fired for Email address: $recipient");
    }
}
