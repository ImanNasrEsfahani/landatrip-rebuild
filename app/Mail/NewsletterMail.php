<?php

namespace App\Mail;

use App\Enums\GroupStatusEnum;
use App\Models\Group;
use App\Models\Newsletter;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class NewsletterMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Newsletter email
     */
    public Newsletter $newsletter;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Newsletter $newsletter)
    {
        $this->newsletter = $newsletter;
    }

    /**
     * Get the message envelope.
     *
     * @return Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address('newsletter-no-reply@landatrip.com', 'Landa Trip Newsletter'),
            replyTo: [
                new Address('info@landatrip.com', 'Landa Trip contact us'),
            ],
            subject: 'Landa Trip Newsletter',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return Content
     */
    public function content()
    {
        $thisWeekTour = Group::where("status", "=", GroupStatusEnum::registration)->whereBetween('end_registration_date', [Carbon::now(), Carbon::now()->endOfYear()])->where('language_id', "=", "1")->inRandomOrder()->limit(2)->get();
        $thisMonthTour = Group::where("status", "=", GroupStatusEnum::registration)->whereBetween('end_registration_date', [Carbon::now(), Carbon::now()->endOfYear()])->where('language_id', "=", "1")->inRandomOrder()->limit(2)->get();

        return new Content(
            view: 'emails.newsletter.newsletter',
            with: [
                'email' =>  $this->newsletter->newsletter_email,
                'thisWeekTour'    => $thisWeekTour,
                'thisMonthTour'   => $thisMonthTour
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
