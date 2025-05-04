<?php

namespace App\Repositories\Admin;

use App\Contracts\Repositories\Admin\CategoryRepository as CategoryRepositoryContract;
use App\Models\Category;
use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository implements CategoryRepositoryContract
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }
}
