<?php

namespace App\Services;

use App\Contracts\Repositories\BaseRepository;
use App\Contracts\Services\BaseService as BaseServiceContract;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

abstract class BaseService implements BaseServiceContract
{
    public function __construct(private readonly BaseRepository $repository) {}

    public function getById(int $id): array|null
    {
        $entity = $this->repository->getById($id);

        if ($entity === null) {
            throw new NotFoundHttpException('Entity not found.');
        }

        return $entity->toArray();
    }

    public function getAll(): array
    {
        return $this->repository->all()->toArray();
    }

    public function create(array $fields): array
    {
        return $this->repository->create($fields)->toArray();
    }

    public function update(int $id, array $fields): array
    {
        return $this->repository->update($id, $fields)->toArray();
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
