<?php

namespace App\Events\Ticket;

use App\Events\Event;

class CreatedEvent extends MutatedEvent
{
    public function __construct(
        private readonly string $email,
        private readonly array $fields,
    ) {}

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getTitle(): string
    {
        return $this->fields['title'];
    }

    public function getTicketId(): int
    {
        return $this->fields['id'];
    }
}
