<?php

namespace App\Http\Controllers\Api\Auth;

use App\Contracts\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function login(
        LoginRequest $request,
        UserService $userService
    )
    {
        $credentials = $request->only('email', 'password');

        return $userService->loginUser($credentials);
    }
}
