<?php

namespace App\Exceptions\Auth;

use DomainException;

class InvalidCredentialsException extends DomainException
{
    protected $code = 422;

    public static function invalid(): self
    {
        return new self('Неверный email или пароль');
    }
}
