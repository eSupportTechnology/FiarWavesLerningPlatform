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
        return (new MailMessage)
            ->subject('Welcome to BetterWay! Your Invite Code')
            ->greeting('Hi ' . $notifiable->fname . ',')
            ->line("Thank you for registering.")
            ->line("Your Invite Code / User ID is: **{$this->inviteCode}**")
            ->line("You can now log in using this code.")
            ->action('Login Now', url('/customer/login'))
            ->line('If you have any questions, contact support.');
    }
}
