<?php

namespace App\Listeners;

use App\Events\NewsletterFormSubmit;

class NewsletterFormSMSListener extends BaseListener
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
     * @return void
     */
    public function handle(NewsletterFormSubmit $event)
    {
        $patternValues = [
            "email" => $event->newsletter->newsletter_email,
        ];

        if(strtolower(env('APP_ENV')) === 'production') {
            foreach ([env("SMS_RECIPIENT_1", null), env("SMS_RECIPIENT_2", null), env("SMS_RECIPIENT_3", null)] as $item) {
                if ($item) {
                    $this->FARAZAMAN_SMS_PANEL(env("FARAZAMAN_PATTERN_PAYMENT_NEWSLETTER", null), $item, $patternValues);
                }
            }
        }
    }
}
