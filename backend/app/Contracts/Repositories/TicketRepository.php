<?php

namespace App\Contracts\Repositories;

use Illuminate\Support\Collection;

interface TicketRepository
{
    public function getAllByUserIdAndRole(int $userId, string $userRole): Collection;
}
