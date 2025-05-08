<?php

namespace App\Services;

use App\Contracts\Repositories\UserRepository;
use App\Contracts\Services\UserService as UserServiceContract;
use App\Models\User;

class UserService extends BaseService implements UserServiceContract
{
    public function __construct(private readonly UserRepository $repository)
    {
        parent::__construct($repository);
    }

    public function getByEmail(string $email): ?User
    {
        return $this->repository->getByEmail($email);
    }
}
