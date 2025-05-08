<?php

namespace App\Services;

use App\Contracts\Mailer;
use App\Contracts\Repositories\UserRepository;
use App\Contracts\Services\AuthService as UserServiceContract;
use App\Contracts\Services\SessionService;
use App\Exceptions\Auth\TwoFactorException;
use App\Exceptions\UserException;
use App\Mail\Messages\TwoFactorMessage;
use App\Models\User;
use Carbon\Carbon;
use DomainException;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Log;
use Throwable;

class AuthService implements UserServiceContract
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly Mailer $mailer,
        private readonly SessionService $sessionService
    ) {}

    /**
     * @throws TwoFactorException
     */
    public function initTwoFactor(array $credentials): void
    {
        $user = $this->authenticateUser($credentials);

        $this->sendTwoFactorCode($user);
    }

    /**
     * @throws TwoFactorException
     * @throws UserException
     */
    public function confirmTwoFactor(string $email, string $code): User
    {
        $user = $this->userRepository->getByEmail($email);

        if ($user === null) {
            throw UserException::notFound();
        }

        $this->validateTwoFactorCode($user, $code);

        $this->clearTwoFactorCode($user);

        return $this->sessionService->login($user);
    }

    public function logout(): void
    {
        $this->sessionService->logout();
    }

    /**
     * @throws TwoFactorException
     */
    private function validateTwoFactorCode(?User $user, string $code): void
    {
        if ($user === null || $user->two_factor_code === null) {
            throw TwoFactorException::invalidCode();
        }

        if ($user->two_factor_code !== $code) {
            throw TwoFactorException::invalidCode();
        }

        if (Carbon::now()->gt($user->two_factor_expires_at)) {
            throw TwoFactorException::expiredCode();
        }
    }

    private function clearTwoFactorCode(User $user): void
    {
        $user->two_factor_code = null;
        $user->two_factor_expires_at = null;

        $this->userRepository->save($user);
    }

    private function authenticateUser(array $credentials): User
    {
        $user = $this->userRepository->getByEmail($credentials['email']);

        if ($user === null || !Hash::check($credentials['password'], $user->password)) {
            throw new DomainException('Данные неверны, проверьте пароль или почту', 401);
        }

        return $user;
    }

    /**
     * @throws TwoFactorException
     */
    private function sendTwoFactorCode(User $user): void
    {
        try {
            $code = $this->generateTwoFactorCode();
            $user->two_factor_code = $code;
            $user->two_factor_expires_at = Carbon::now()->addMinutes(
                config('auth.two_factor.expire', 300)
            );

            $this->userRepository->save($user);

            $this->mailer->sendToQueue(
                $user->email,
                new TwoFactorMessage($code)
            );

        } catch (Throwable $e) {
            Log::error($e->getMessage(), ['exception' => $e]);
            throw TwoFactorException::failedSend();
        }
    }

    private function generateTwoFactorCode(): string
    {
        return (string) rand(100000, 999999);
    }
}
