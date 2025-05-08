<?php

namespace App\Contracts\Services;

use App\Models\User;

interface UserService
{
    public function getByEmail(string $email): ?User;
}
