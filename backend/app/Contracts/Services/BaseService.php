<?php

namespace App\Contracts\Services;

interface BaseService
{
    public function getAll(): array;

    public function getById(int $id): array|null;

    public function create(array $fields): array;

    public function update(int $id, array $fields): array;

    public function delete(int $id): bool;
}
