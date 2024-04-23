<?php

namespace App\Providers;

use App\Contracts\SubscriptionServiceInterface;
use App\Contracts\UserServiceInterface;
use App\Events\UserCreated;
use App\Listeners\SendWelcomeNotification;
use App\Services\SubscriptionService;
use App\Services\UserService;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(SubscriptionServiceInterface::class, SubscriptionService::class);
    }

    public function boot(): void
    {
        Event::listen(
            UserCreated::class,
            SendWelcomeNotification::class,
        );
    }
}
