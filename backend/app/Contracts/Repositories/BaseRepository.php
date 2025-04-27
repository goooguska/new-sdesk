<?php

namespace App\Contracts\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface BaseRepository
{
    public function all(): Collection;

    public function getById(int $id): ?Model;

    public function save(Model $model): Model;

    public function create(array $fields): Model;

    public function update(array $fields, int $id): Model;

    public function delete(int $id): bool;
}
