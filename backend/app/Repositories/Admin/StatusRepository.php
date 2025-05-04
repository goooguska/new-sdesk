<?php

namespace App\Repositories\Admin;

use App\Contracts\Repositories\Admin\StatusRepository as StatusRepositoryContract;
use App\Models\Status;
use App\Repositories\BaseRepository;

class StatusRepository extends BaseRepository implements StatusRepositoryContract
{
    public function __construct(Status $model)
    {
        parent::__construct($model);
    }
}
