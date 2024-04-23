<?php

namespace App\Contracts;

interface WelcomeNotifiableInterface
{
    public function getWelcomeNotification(): string;
}
