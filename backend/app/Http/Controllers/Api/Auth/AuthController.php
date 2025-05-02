<?php

namespace App\Http\Controllers\Api\Auth;

use App\Contracts\Services\AuthService;
use App\Exceptions\Auth\InvalidCredentialsException;
use App\Exceptions\Auth\TwoFactorException;
use App\Http\Controllers\Controller;
use App\Http\Presenters\Api\Auth\AuthUserPresenter;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\TwoFactorRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function login(
        LoginRequest $request,
        AuthService $userService
    )
    {
        try {
            $userService->initTwoFactor($request->all());

            return new JsonResponse([
                'success' => true,
            ]);
        } catch (InvalidCredentialsException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'errors' => ['email' => [$e->getMessage()]]
            ], 401);
        } catch (TwoFactorException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'errors' => ['code' => [$e->getMessage()]]
            ], 422);
        }
    }

    public function confirmTwoFactor(
        TwoFactorRequest $request,
        AuthService $userService
    )
    {
        try {
            $user = $userService->confirmTwoFactor(
                $request->input('email'),
                $request->input('code')
            );

            return AuthUserPresenter::make($user);
        } catch (TwoFactorException $e) {
            return new JsonResponse([
                'message' => $e->getMessage(),
                'errors' => [
                    'code' => [$e->getMessage()]
                ]
            ], 422);
        }
    }

    public function logout(Request $request, AuthService $authService)
    {
        $authService->logout();

        return new JsonResponse([
            'success' => true,
        ]);
    }

    public function me(Request $request)
    {
        return $request->user();
    }
}
