<?php

namespace App\Services;

use App\Contracts\Repositories\StatusRepository;
use App\Contracts\Services\StatusService as StatusServiceContract;
use App\Models\Status;

class StatusService extends BaseService implements StatusServiceContract
{
    public function __construct(private readonly StatusRepository $repository)
    {
        parent::__construct($repository);
    }

    public function getByCode(string $code): ?Status
    {
        return $this->repository->getByCode($code);
    }
}
