<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class InviteCodeNotification extends Notification
{
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
