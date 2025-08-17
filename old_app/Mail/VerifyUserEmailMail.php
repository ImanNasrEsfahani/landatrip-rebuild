<?php

namespace App\Mail;

use App\Enums\GroupStatusEnum;
use App\Models\Group;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class VerifyUserEmailMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var User $user
     */
    public User $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     *
     * @return Envelope
     */
    public function envelope()
    {
        $name = $this->user->name;

        Log::info('Email content:', [
            'name'    => $name,
            'to'      => $this->user->email,
            'subject' => 'Email Verification - Landa Trip'
        ]);

        return new Envelope(
            from: env("MAIL_FROM_ADDRESS"),
            to: $this->user->email,
            bcc: env("MAIL_RECIPIENT_1"),
            subject: 'Verify User Email Mail',
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
            view: 'emails.verification.verify',
            with: [
                'name'              => $this->user->name,
                'verification_code' => $this->user->verification_code,
                'thisWeekTour'      => $thisWeekTour,
                'thisMonthTour'     => $thisMonthTour
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
