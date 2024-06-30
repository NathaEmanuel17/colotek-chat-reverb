<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as App;

class BaseRepository
{
    protected $model;
    protected $app;

    public function __construct(App $app, Model $model)
    {
        $this->app = $app;
        $this->model = $this->makeModel($model);
    }

    /**
     * Make model instance
     *
     * @param Model $model
     * @return Model
     * @throws \Exception
     */
    public function makeModel(Model $model): Model
    {
        $this->model = $model;

        if (!$this->model instanceof Model) {
            throw new \Exception("Class {$this->model} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model;
    }

    /**
     * Get all instances of model
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Create a new record in the database
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    /**
     * Update record in the database
     *
     * @param int $id
     * @param array $data
     * @return Model
     */
    public function update(int $id, array $data): Model
    {
        $record = $this->findOrFail($id);
        $record->update($data);

        return $record->fresh();
    }

    /**
     * Remove record from the database
     *
     * @param int $id
     * @return bool|null
     * @throws \Exception
     */
    public function delete(int $id): ?bool
    {
        $record = $this->findOrFail($id);
        return $record->delete();
    }

    /**
     * Show the record with the given id
     *
     * @param int $id
     * @return Model|null
     */
    public function find(int $id): ?Model
    {
        return $this->model->find($id);
    }

    /**
     * Show the record with the given id or fail
     *
     * @param int $id
     * @return Model
     */
    public function findOrFail(int $id): Model
    {
        return $this->model->findOrFail($id);
    }
}
