<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\UserServiceInterface;
use App\Events\UserCreated;
use App\Factories\UserFactory;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;

class UserService implements UserServiceInterface
{
    public function store(CreateUserRequest $request): User
    {
        $user = UserFactory::create($request->role, $request->validated());

        UserCreated::dispatch($user);

        return $user;
    }
}
