<?php

namespace App\Exceptions;

use Exception;

abstract class EntityException extends Exception
{
    public static function notFound(): static
    {
        return new static('Not found ' . static::entity());
    }

    public static function failedCreate(): static
    {
        return new static('Failed create ' . static::entity());
    }

    public static function failedUpdate(string $id): static
    {
        return new static('Failed update ' . static::entity() . "[$id]");
    }

    public static function failedDelete(string $id): static
    {
        return new static('Failed delete ' . static::entity() . "[$id]");
    }

    abstract protected static function entity(): string;

    abstract protected static function entities(): string;
}
