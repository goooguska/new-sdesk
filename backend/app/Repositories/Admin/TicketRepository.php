<?php

namespace App\Repositories\Admin;

use App\Contracts\Repositories\Admin\TicketRepository as TicketRepositoryContract;
use App\Models\Ticket;
use App\Models\User;
use App\Repositories\BaseRepository;

class TicketRepository extends BaseRepository implements
    TicketRepositoryContract
{
    public function __construct(Ticket $model)
    {
        parent::__construct($model);
    }
}
