<?php

namespace App\Models\Roles;

use App\Contracts\WelcomeNotifiableInterface;
use App\Models\User;

class PrivateTutor extends User implements WelcomeNotifiableInterface
{
    public const string ROLE = 'private_tutor';

    protected static string $singleTableType = self::ROLE;

    public function getWelcomeNotification(): string
    {
        return 'Private tutor welcome notification';
    }

    public function getDefaultSubscription(): string
    {
        return 'silver';
    }
}
