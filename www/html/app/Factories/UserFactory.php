<?php

namespace App\Factories;

use App\Models\Roles\ParentUser;
use App\Models\Roles\PrivateTutor;
use App\Models\Roles\Student;
use App\Models\Roles\Teacher;
use App\Models\User;

class UserFactory
{
    private function __construct()
    {

    }

    public static function create(string $role, array $data): User
    {
        return match ($role) {
            Student::ROLE => Student::create($data),
            Teacher::ROLE => Teacher::create($data),
            ParentUser::ROLE => ParentUser::create($data),
            PrivateTutor::ROLE => PrivateTutor::create($data),
            default => throw new \UnexpectedValueException('Wrong user role'),
        };
    }
}
