<?php

namespace App\Contracts\Services;

use App\Models\User;

interface SessionService
{
    public function login(User $user): User;

    public function logout(): void;
}
