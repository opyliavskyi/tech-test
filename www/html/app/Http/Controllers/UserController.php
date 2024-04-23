<?php

namespace App\Http\Controllers;

use App\Contracts\SubscriptionServiceInterface;
use App\Contracts\UserServiceInterface;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function __construct(
        private readonly UserServiceInterface $userService,
        private readonly SubscriptionServiceInterface $subscriptionService,
    ) {

    }

    public function store(CreateUserRequest $request): JsonResponse
    {
        try {
            $user = $this->userService->store($request);

            $this->subscriptionService->subscribe($user);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Wrong user data'], Response::HTTP_BAD_REQUEST);
        }

        return response()->json([], Response::HTTP_CREATED);
    }
}
