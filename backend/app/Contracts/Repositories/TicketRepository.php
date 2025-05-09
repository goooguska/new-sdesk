<?php

namespace App\Contracts\Repositories;

use App\Models\Ticket;
use Illuminate\Support\Collection;

interface TicketRepository
{
    public function getAllByUserIdAndRole(int $userId, string $userRole): Collection;

    public function getTicketById(string $id): ?Ticket;
}
