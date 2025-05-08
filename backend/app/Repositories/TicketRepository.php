<?php

namespace App\Repositories;

use App\Contracts\Repositories\TicketRepository as TicketRepositoryContract;
use App\Models\Ticket;

class TicketRepository extends BaseRepository implements TicketRepositoryContract
{
    public function __construct(Ticket $model)
    {
        parent::__construct($model);
    }
}
