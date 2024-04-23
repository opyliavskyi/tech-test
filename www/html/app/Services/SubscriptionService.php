<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\AllowSubscriptionInterface;
use App\Contracts\SubscriptionServiceInterface;

class SubscriptionService implements SubscriptionServiceInterface
{
    public function subscribe(AllowSubscriptionInterface $member): void
    {
        $member->subscribe();
    }
}
