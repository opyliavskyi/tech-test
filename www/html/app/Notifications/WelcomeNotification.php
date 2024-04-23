<?php

namespace App\Notifications;

use App\Contracts\WelcomeNotifiableInterface;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public User&WelcomeNotifiableInterface $user)
    {
        //
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line($this->user->getWelcomeNotification());
    }

    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
