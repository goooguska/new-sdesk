<?php

namespace App\Services;

use App\Contracts\Repositories\UserRepository;
use App\Contracts\Services\UserService as UserServiceContract;
use App\Http\Presenters\Api\Auth\AuthUserPresenter;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceContract
{
    public function __construct(private readonly UserRepository $userRepository) {}

    public function loginUser(array $credentials): JsonResponse
    {
        $user = $this->authenticateUser($credentials);

        $this->sendTwoFactorMail();

        return new JsonResponse(AuthUserPresenter::make($user));
    }

    private function authenticateUser(array $credentials): User
    {
        $user = $this->userRepository->getByEmail($credentials['email']);

        if ($user === null || !Hash::check($credentials['password'], $user->password)) {
            throw new \DomainException('Invalid credentials', 401);
        }

        return $user;
    }

    private function sendTwoFactorMail()
    {

    }
}
