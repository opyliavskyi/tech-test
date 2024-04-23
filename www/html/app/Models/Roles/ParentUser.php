<?php

namespace App\Models\Roles;

use App\Contracts\WelcomeNotifiableInterface;
use App\Models\User;

class ParentUser extends User implements WelcomeNotifiableInterface
{
    public const string ROLE = 'parent';

    protected static string $singleTableType = self::ROLE;

    public function getWelcomeNotification(): string
    {
        return 'Parent welcome notification';
    }
}
