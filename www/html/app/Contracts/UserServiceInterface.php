<?php

declare(strict_types=1);

namespace App\Contracts;

use App\Http\Requests\CreateUserRequest;
use App\Models\User;

interface UserServiceInterface
{
    public function store(CreateUserRequest $request): User;
}
