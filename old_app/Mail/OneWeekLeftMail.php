<?php

namespace App\Mail;

use App\Enums\GroupStatusEnum;
use App\Models\Group;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OneWeekLeftMail extends Mailable
{
    use Queueable, SerializesModels;

    public Group $group;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Group $group)
    {
        $this->group = $group;
    }

    /**
     * Get the message envelope.
     *
     * @return Envelope
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'One Week Left Mail',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return Content
     */
    public function content(): Content
    {
        $thisWeekTour = Group::where("status", "=", GroupStatusEnum::booking)->whereBetween('end_registration_date', [Carbon::now(), Carbon::now()->endOfYear()])->where('language_id', "=", "1")->inRandomOrder()->limit(2)->get();
        $thisMonthTour = Group::where("status", "=", GroupStatusEnum::booking)->whereBetween('end_registration_date', [Carbon::now(), Carbon::now()->endOfYear()])->where('language_id', "=", "1")->inRandomOrder()->limit(2)->get();

        return new Content(
            view: 'emails.tour.one-week-left-tour',
            with: [
                'group'         => $this->group,
                'thisWeekTour'  => $thisWeekTour,
                'thisMonthTour' => $thisMonthTour
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
