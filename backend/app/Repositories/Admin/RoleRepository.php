<?php

namespace App\Repositories\Admin;

use App\Contracts\Repositories\Admin\RoleRepository as RoleRepositoryContract;
use App\Models\Role;
use App\Repositories\BaseRepository;

class RoleRepository extends BaseRepository implements RoleRepositoryContract
{
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }
}
