<?php

namespace App\Repositories;

use App\Contracts\Repositories\StatusRepository as StatusRepositoryContract;
use App\Models\Status;

class StatusRepository extends BaseRepository implements StatusRepositoryContract
{
    public function __construct(Status $model)
    {
        parent::__construct($model);
    }

    public function getByCode(string $code): ?Status
    {
        return $this->model->where('code', $code)->first();
    }
}
