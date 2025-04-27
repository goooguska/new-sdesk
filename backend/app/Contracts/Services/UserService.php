<?php

namespace App\Contracts\Services;

use Illuminate\Http\JsonResponse;

interface UserService
{
    public function loginUser(array $credentials): JsonResponse;
}
