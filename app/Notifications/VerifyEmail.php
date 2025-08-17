<?php

namespace App\Notifications;

use App\Mail\VerifyUserEmailMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerifyEmail extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     *
     * @return VerifyUserEmailMail|MailMessage
     */
    public function toMail($notifiable)
    {
//        return (new MailMessage)
//            ->subject('Verify Email Address')
//            ->markdown('emails.verify', [
//                'user' => $notifiable,
//                'verificationUrl' => $notifiable->verificationUrl(),
//            ]);
        return new VerifyUserEmailMail($notifiable);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
