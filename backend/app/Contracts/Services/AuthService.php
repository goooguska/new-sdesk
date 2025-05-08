<?php

namespace App\Contracts\Services;

use App\Models\User;

interface AuthService
{
    public function initTwoFactor(array $credentials): void;

    public function confirmTwoFactor(string $email, string $code): User;

    public function logout(): void;

    public function me(): User;
}
