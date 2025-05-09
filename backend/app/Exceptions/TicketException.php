<?php

namespace App\Exceptions;

class TicketException extends EntityException
{
    public static function notFound(): static
    {
        return new static(parent::notFound()->getMessage());
    }

    protected static function entity(): string
    {
       return 'ticket';
    }

    protected static function entities(): string
    {
       return 'tickets';
    }
}
