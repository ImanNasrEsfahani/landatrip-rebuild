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

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    private User $user;
    private string $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * Get the message envelope.
     *
     * @return Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Reset Password',
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
            view: 'emails.reset-password.reset-password',
            with: [
                'user'          => $this->user,
                'token'         => url('reset-password', $this->token) . "?email=" . $this->user->email,
                'thisWeekTour'  => $thisWeekTour,
                'thisMonthTour' => $thisMonthTour

            ]        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
//    public function attachments()
//    {
//        return [];
//    }
}
