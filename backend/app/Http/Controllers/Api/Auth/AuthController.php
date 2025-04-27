<?php

namespace App\Http\Controllers\Api\Auth;

use App\Contracts\Services\UserService;
use App\Exceptions\Auth\TwoFactorException;
use App\Http\Controllers\Controller;
use App\Http\Presenters\Api\Auth\AuthUserPresenter;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\TwoFactorRequest;

class AuthController extends Controller
{
    public function login(
        LoginRequest $request,
        UserService $userService
    )
    {
        try {
            return $userService->initTwoFactor($request->all());
        } catch (\DomainException $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }

    public function confirmTwoFactor(
        TwoFactorRequest $request,
        UserService $userService
    )
    {
        try {
            $user = $userService->confirmTwoFactor(
                $request->input('email'),
                $request->input('code'));

            return AuthUserPresenter::make($user);
        } catch (TwoFactorException $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }
}
