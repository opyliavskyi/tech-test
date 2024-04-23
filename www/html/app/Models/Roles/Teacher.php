<?php

namespace App\Models\Roles;

use App\Contracts\WelcomeNotifiableInterface;
use App\Models\User;

class Teacher extends User implements WelcomeNotifiableInterface
{
    public const string ROLE = 'teacher';

    protected static string $singleTableType = self::ROLE;

    public function getWelcomeNotification(): string
    {
        return 'Teacher welcome notification';
    }

    public function getDefaultSubscription(): string
    {
        return 'gold';
    }
}
