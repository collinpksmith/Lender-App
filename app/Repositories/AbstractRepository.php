<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;

/**
 * Class Repository
 * @package App\Repositories
 */
abstract class AbstractRepository implements RepositoryInterface
{
    /** @var Model  */
    protected $model;
    /**
     * Repository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    /**
     * Get all instances of model
     * @return \Illuminate\Database\Eloquent\Collection|Model[]|mixed
     */
    public function all()
    {
        return $this->model->all();
    }
    /**
     * create a new record in the database
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }
    /**
     * update record in the database
     * @param array $data
     * @param $id
     * @return mixed
     */
    public function update(array $data, $id)
    {
        $record = $this->find($id);
        return $record->update($data);
    }
    /**
     * remove record from the database
     * @param $id
     * @return int|mixed
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }
    /**
     * @param array $params
     * @return mixed|void
     */
    public function deleteWhere(array $params)
    {
        return $this->model->where($params)->delete();
    }
    /**
     * show the record with the given id
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }
    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->model->find($id);
    }
    /**
     * @param array $params
     * @return Collection
     */
    public function findBy(array $params): Collection
    {
        return $this->model->findBy($params);
    }
    /**
     * @param array $params
     * @return Model
     */
    public function findOneBy(array $params): Model
    {
        /** @var Builder|null */
        $query = null;
        foreach ($params as $key => $param) {
            $query = $query ? $query->where($key, $param) : $this->model->where($key, $param);
        }
        return $query->first();
    }
    /**
     * @param $id
     * @return mixed
     */
    public function findOrFail($id)
    {
        return $this->show($id);
    }
    /**
     * @param array $attributes
     * @param array $values
     * @return Model
     */
    public function firstOrCreate(array $attributes, array $values = []): Model
    {
        return $this->model->firstOrCreate($attributes, $values);
    }
    /**
     * @param array $attributes
     * @param array $values
     * @return Model
     */
    public function updateOrCreate(array $attributes, array $values = []): Model
    {
        return $this->model->updateOrCreate($attributes, $values);
    }
    /**
     * Get the associated model
     * @return Model
     */
    public function getModel()
    {
        return $this->model;
    }
    /**
     * Set the associated model
     * @param $model
     * @return $this
     */
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }
    /**
     * Eager load database relationships
     * @param $relations
     * @return \Illuminate\Database\Eloquent\Builder|Model
     */
    public function with($relations)
    {
        return $this->model->with($relations);
    }
    /**
     * @return Builder
     */
    public function getQuery(): Builder
    {
        return $this->model->getQuery();
    }
    /**
     * @return Model
     */
    public function makeNewInstance(): Model
    {
        $class = get_class($this->model);
        return new $class();
    }
}
