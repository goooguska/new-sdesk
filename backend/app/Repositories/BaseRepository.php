<?php

namespace App\Repositories;

use App\Contracts\Repositories\BaseRepository as BaseRepositoryContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @template TModel of Model
 */
abstract class BaseRepository implements BaseRepositoryContract
{
    public function __construct(protected Model $model) {}

    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * @return TModel
     */
    public function getById(int $id): ?Model
    {
        return $this->model->find($id);
    }

    public function save(Model $model): Model
    {
        if (! $model->save()) {
            throw new \RuntimeException('Failed to save user');
        }

        return $model->refresh();
    }

    public function create(array $fields): Model
    {
        return $this->model->create($fields);
    }

    public function update(int $id, array $fields): Model
    {
        $this->getById($id)->update($fields);

        return $this->getById($id);
    }

    public function delete(int $id): bool
    {
        return $this->getById($id)->delete();
    }
}
