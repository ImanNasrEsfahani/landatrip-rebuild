<?php

namespace App\Listeners;

use App\Events\ContactFormSubmit;

class ContactFormSMSListener extends BaseListener
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
     * @return void
     */
    public function handle(ContactFormSubmit $event)
    {
        $patternValues = [
            "name"      => $event->contact->name,
            "email"     => $event->contact->email,
            "phone"     => $event->contact->phone,
            "body"      => $event->contact->message,
        ];
        if(strtolower(env('APP_ENV')) === 'production') {
            foreach ([env("SMS_RECIPIENT_1", null), env("SMS_RECIPIENT_2", null), env("SMS_RECIPIENT_3", null)] as $item) {
                if ($item) {
                    $this->FARAZAMAN_SMS_PANEL(env("FARAZAMAN_PATTERN_PAYMENT_CONTACT_US", null), $item, $patternValues);
                }
            }
        }
    }
}
