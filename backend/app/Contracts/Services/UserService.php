<?php

namespace App\Contracts\Services;

use App\Models\User;

interface UserService
{
    public function initTwoFactor(array $credentials): bool;

    public function confirmTwoFactor(string $email, string $code): User;
}
