<?php

namespace App\Contracts\Repositories;

use App\Models\User;

interface UserRepository
{
    public function getByEmail(string $email): User|null;
}
