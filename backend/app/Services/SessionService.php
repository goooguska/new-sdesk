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
            //TODO Браузер хранит куки, пока не решил как эту тему решить на клиенте
            // Поэтому делаем logout
            $this->logout();
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
            session()->invalidate();
            session()->regenerateToken();
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
}
