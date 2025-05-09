<?php

namespace App\Repositories;

use App\Contracts\Repositories\TicketRepository as TicketRepositoryContract;
use App\Models\Ticket;
use Illuminate\Support\Collection;

class TicketRepository extends BaseRepository implements TicketRepositoryContract
{
    public function __construct(Ticket $model)
    {
        parent::__construct($model);

        $this->defaultRelations = ['assigned', 'creator', 'category', 'status'];
    }

    public function getAllByUserIdAndRole(int $userId, string $userRole): Collection
    {
        return $this->model
            ->with($this->defaultRelations)
            ->where($userRole, $userId)
            ->get();
    }

    public function getTicketById(string $id): ?Ticket
    {
        /** @var Ticket|null */
        return $this->model
            ->with($this->defaultRelations)
            ->where('id', $id)
            ->first();
    }
}
