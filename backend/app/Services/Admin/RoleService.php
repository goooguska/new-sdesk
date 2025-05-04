<?php

namespace App\Services\Admin;

use App\Contracts\Repositories\Admin\RoleRepository;
use App\Contracts\Services\Admin\RoleService as RoleServiceContract;
use App\Services\BaseService;

class RoleService extends BaseService implements RoleServiceContract
{
    public function __construct(private readonly RoleRepository $repository)
    {
        parent::__construct($repository);
    }
}
