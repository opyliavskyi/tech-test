<?php

namespace App\Models\Roles;

use App\Contracts\WelcomeNotifiableInterface;
use App\Models\User;

class Student extends User implements WelcomeNotifiableInterface
{
    public const string ROLE = 'student';

    protected static string $singleTableType = self::ROLE;

    public function getWelcomeNotification(): string
    {
        return 'Student welcome notification';
    }
}
