<?php

namespace App\Exceptions\Auth;

use DomainException;

class InvalidCredentialsException extends DomainException
{
    public static function invalid(): self
    {
        return new self('Неверный email или пароль');
    }
}
