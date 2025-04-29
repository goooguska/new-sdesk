<?php

namespace App\Http\Controllers\Api\Auth;

use App\Contracts\Services\UserService;
use App\Exceptions\Auth\TwoFactorException;
use App\Http\Controllers\Controller;
use App\Http\Presenters\Api\Auth\AuthUserPresenter;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\TwoFactorRequest;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function login(
        LoginRequest $request,
        UserService $userService
    )
    {
        try {
            if (! $userService->initTwoFactor($request->all())) {
                throw TwoFactorException::failedSend();
            }

            return new JsonResponse([
                'success' => true,
            ]);
        } catch (\Throwable $e) {
            return new JsonResponse($e->getMessage(), 401);
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
            return new JsonResponse($e->getMessage(), 422);
        }
    }
}
