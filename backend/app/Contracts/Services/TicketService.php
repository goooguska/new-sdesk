<?php

namespace App\Contracts\Services;

interface TicketService
{
    public function createTicket(array $fields): array;

    public function getAllForCurrentUser(): array;

    public function getTicketById(string $id): array;

    public function getRatioDoneAndRejectedTicketsPerWeek(): array;

    public function getDoneCountTicketsPerWeek(): array;

    public function getCountTicketsPerWeekByCategory(): array;
}
