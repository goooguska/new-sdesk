<?php

namespace App\Exceptions\Auth;

use Exception;

class TwoFactorException extends Exception
{
    protected $code = 422;

    public static function invalidCode(): self
    {
        return new self('Неверный код подтверждения');
    }

    public static function expiredCode(): self
    {
        return new self('Срок действия кода истёк');
    }

    public static function tooManyAttempts(): self
    {
        return new self('Слишком много попыток. Повторите через позже');
    }

    public static function failedSend($data = null): self
    {
        return new self('2fa.send', $data, 400);
    }
}
