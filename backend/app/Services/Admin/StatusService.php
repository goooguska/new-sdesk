<?php

namespace App\Services\Admin;

use App\Contracts\Repositories\Admin\StatusRepository;
use App\Contracts\Services\Admin\StatusService as StatusServiceContract;
use App\Services\BaseService;

class StatusService extends BaseService implements StatusServiceContract
{
    public function __construct(private readonly StatusRepository $repository)
    {
        parent::__construct($repository);
    }
}
