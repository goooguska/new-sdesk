<?php

namespace App\Contracts\Services;

use App\Models\User;
use Illuminate\Http\JsonResponse;

interface UserService
{
    public function initTwoFactor(array $credentials): JsonResponse;

    public function confirmTwoFactor(string $email, string $code): User;
}
