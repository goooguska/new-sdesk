<?php

namespace App\Services\Admin;

use App\Contracts\Repositories\Admin\CategoryRepository;
use App\Contracts\Services\Admin\CategoryService as CategoryServiceContract;
use App\Services\BaseService;

class CategoryService extends BaseService implements CategoryServiceContract
{
    public function __construct(private readonly CategoryRepository $repository)
    {
        parent::__construct($repository);
    }
}
