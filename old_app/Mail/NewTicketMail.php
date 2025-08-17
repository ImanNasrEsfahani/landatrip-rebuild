<?php

namespace App\Mail;

use App\Enums\GroupStatusEnum;
use App\Models\Group;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewTicketMail extends Mailable
{
    use Queueable, SerializesModels;

    public Ticket $ticket;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'New Ticket Email',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return Content
     */
    public function content()
    {
        $thisWeekTour = Group::where("status", "=", GroupStatusEnum::booking)->whereBetween('end_registration_date', [Carbon::now(), Carbon::now()->endOfYear()])->where('language_id', "=", "1")->inRandomOrder()->limit(2)->get();
        $thisMonthTour = Group::where("status", "=", GroupStatusEnum::booking)->whereBetween('end_registration_date', [Carbon::now(), Carbon::now()->endOfYear()])->where('language_id', "=", "1")->inRandomOrder()->limit(2)->get();

        return new Content(
            view: 'emails.ticket.new-ticket',
            with: [
                'ticket'        => $this->ticket,
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
