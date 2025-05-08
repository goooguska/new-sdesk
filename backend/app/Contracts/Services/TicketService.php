<?php

namespace App\Contracts\Services;

interface TicketService
{
    public function createTicket(array $fields): array;
}
