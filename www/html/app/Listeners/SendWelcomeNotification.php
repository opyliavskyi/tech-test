<?php

namespace App\Listeners;

use App\Contracts\WelcomeNotifiableInterface;
use App\Events\UserCreated;
use App\Notifications\WelcomeNotification;
use Illuminate\Support\Facades\Notification;

class SendWelcomeNotification
{
    public function handle(UserCreated $event): void
    {
        if ($event->user instanceof WelcomeNotifiableInterface) {
            Notification::send($event->user, new WelcomeNotification($event->user));
        }
    }
}
