<?php

namespace App\Services;

use App\Contracts\Services\SessionService as SessionServiceContract;
use App\Exceptions\Auth\AuthException;
use App\Exceptions\UserException;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class SessionService implements SessionServiceContract
{
    /**
     * @throws AuthException
     */
    public function login(User $user): User
    {
        try {
            $this->clearSession();
            auth()->login($user);

            return $user;
        } catch (\Throwable $e) {
            Log::error($e->getMessage(), ['exception' => $e]);

            throw new AuthException('Authentication failed', 500, $e);
        }
    }

    public function logout(): void
    {
        try {
            auth()->guard('web')->logout();
            $this->clearSession();
        } catch (\Throwable $e) {
            Log::error($e->getMessage(), ['exception' => $e]);
        }
    }

    /**
     * @throws UserException
     */
    public function me(): User
    {
        try {
            return auth()->user();

        } catch (\Throwable $e) {
            Log::error($e->getMessage(), ['exception' => $e]);

            throw UserException::notFound();
        }
    }

    private function clearSession(): void
    {
        session()->invalidate();
        session()->regenerate();
        session()->regenerateToken();
    }
}
