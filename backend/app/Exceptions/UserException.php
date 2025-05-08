<?php

namespace App\Exceptions;

class UserException extends EntityException
{
    public static function notFound(): static
    {
        return new static(parent::notFound()->getMessage());
    }

    public static function notSupportRole(): static
    {
        return new static('Текущая роль не поддерживается');
    }

    protected static function entity(): string
    {
       return 'user';
    }

    protected static function entities(): string
    {
       return 'users';
    }
}
