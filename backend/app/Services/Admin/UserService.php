<?php

namespace App\Services\Admin;

use App\Contracts\Repositories\Admin\UserRepository;
use App\Contracts\Services\Admin\UserService as UserServiceContract;
use App\Services\BaseService;

class UserService extends BaseService implements UserServiceContract
{
    public function __construct(private readonly UserRepository $repository)
    {
        parent::__construct($repository);
    }
}
