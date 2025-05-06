<?php

namespace App\Repositories;

use App\Contracts\Repositories\BaseRepository as BaseRepositoryContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
     * @param string $id
     *
     * @return Model|null
     */
    public function getById(string $id): ?Model
    {
        return $this->model->find($id);
    }

    /**
     * @param array $fields
     *
     * @return Model
     */
    public function create(array $fields): Model
    {
        $model = $this->model->create($fields);

        if (! $model) {
            throw new \RuntimeException("Ошибка при создании записи.");
        }

        return $model;
    }

    /**
     * @param string   $id
     * @param array $fields
     *
     * @return Model
     */
    public function update(string $id, array $fields): Model
    {
        $model = $this->model->find($id);

        if ($model === null) {
            throw new NotFoundHttpException("Запись не найдена.");
        }

        if (! $model->update($fields)) {
            throw new \RuntimeException("Ошибка при обновлении записи.");
        }

        return $model->refresh();
    }

    public function delete(string $id): bool
    {
        $model = $this->model->find($id);

        if ($model === null) {
            throw new NotFoundHttpException("Запись не найдена.");
        }

        return $model->delete();
    }

    public function save(Model $model): Model
    {
        if (! $model->save()) {
            throw new \RuntimeException('Ошибка при сохранении модели.');
        }

        return $model->refresh();
    }
}
