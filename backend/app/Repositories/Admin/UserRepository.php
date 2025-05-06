<?php

namespace App\Repositories\Admin;

use App\Contracts\Repositories\Admin\UserRepository as UserRepositoryContract;
use App\Models\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryContract
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
