<?php

namespace App\Services\Admin;

use App\Contracts\Repositories\Admin\TicketRepository;
use App\Contracts\Services\Admin\TicketService as TicketServiceContract;
use App\Services\BaseService;

class TicketService extends BaseService implements TicketServiceContract
{
    public function __construct(private readonly TicketRepository $repository)
    {
        parent::__construct($repository);
    }
}
