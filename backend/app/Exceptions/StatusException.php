<?php

namespace App\Exceptions;

class StatusException extends EntityException
{
    public static function notFound(): static
    {
        return new static(parent::notFound()->getMessage());
    }

    protected static function entity(): string
    {
       return 'status';
    }

    protected static function entities(): string
    {
       return 'statuses';
    }
}
