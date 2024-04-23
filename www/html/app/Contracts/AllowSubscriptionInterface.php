<?php

namespace App\Contracts;

interface AllowSubscriptionInterface
{
    public function getDefaultSubscription(): string;

    public function subscribe(?string $subscription = null): void;
}
