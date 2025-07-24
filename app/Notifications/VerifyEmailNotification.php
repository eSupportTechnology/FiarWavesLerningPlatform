<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmailNotification extends Notification
{
    use Queueable;
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $verificationUrl = url('/verify-email/' . $this->token);

        return (new MailMessage)->view(
            'emails.verify-email',
            [
                'name' => $notifiable->fname,
                'verificationUrl' => $verificationUrl,
            ]
        );
    }
}
