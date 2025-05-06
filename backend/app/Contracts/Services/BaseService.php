<?php

namespace App\Contracts\Services;

interface BaseService
{
    public function getAll(): array;

    public function getById(string $id): array|null;

    public function create(array $fields): array;

    public function update(string $id, array $fields): array;

    public function delete(string $id): bool;
}
