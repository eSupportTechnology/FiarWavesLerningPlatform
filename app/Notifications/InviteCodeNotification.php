<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Log;

class InviteCodeNotification extends Notification
{
    use Queueable;
    protected $inviteCode;

    public function __construct($inviteCode)
    {
        $this->inviteCode = $inviteCode;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)->view(
            'emails.invite-code',
            [
                'name' => $notifiable->fname,
                'inviteCode' => $this->inviteCode,
            ]
        )->subject('Welcome to Better Way! Your Invite Code');
    }
}
