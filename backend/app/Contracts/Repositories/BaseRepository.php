<?php

namespace App\Contracts\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface BaseRepository
{
    public function all(): Collection;

    public function getById(int $id): ?Model;

    public function save(Model $model): Model;

    public function create(array $fields): Model;

    public function update( int $id, array $fields): Model;

    public function delete(int $id): bool;
}
