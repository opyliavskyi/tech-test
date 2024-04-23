<?php

declare(strict_types=1);

namespace App\Contracts;

interface SubscriptionServiceInterface
{
    public function subscribe(AllowSubscriptionInterface $member): void;
}
