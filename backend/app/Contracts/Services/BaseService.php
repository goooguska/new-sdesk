<?php

namespace App\Contracts\Services;

use Illuminate\Database\Eloquent\Model;

interface BaseService
{
    public function getAll(): array;

    public function getById(string $id): array|null;

    public function create(array $fields): array;

    public function update(string $id, array $fields): array;

    public function delete(string $id): bool;

    public function save(Model $model): Model;

}
