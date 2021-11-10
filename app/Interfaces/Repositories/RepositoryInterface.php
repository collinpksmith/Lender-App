<?php

declare(strict_types=1);

namespace App\Interfaces\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Interface RepositoryInterface
 * @package App\Interfaces\Repositories
 */
interface RepositoryInterface
{
    /**
     * Get all instances of model
     * @return \Illuminate\Database\Eloquent\Collection|Model[]|mixed
     */
    public function all();
    /**
     * create a new record in the database
     * @param array $data
     * @return mixed
     */
    public function create(array $data);
    /**
     * update record in the database
     * @param array $data
     * @param $id
     * @return mixed
     */
    public function update(array $data, $id);
    /**
     * remove record from the database
     * @param $id
     * @return int|mixed
     */
    public function delete($id);
    /**
     * Remove records matching params
     * @param array $params
     * @return mixed
     */
    public function deleteWhere(array $params);
    /**
     * show the record with the given id
     * @param $id
     * @return mixed
     */
    public function show($id);
    /**
     * Alias for show
     * @param $id
     * @return mixed
     */
    public function find($id);
    /**
     * Gets all records matching params
     * @param array $params
     * @return mixed
     */
    public function findBy(array $params);
    /**
     * Gets a single record matching params
     * @param array $params
     * @return mixed
     */
    public function findOneBy(array $params);
    /**
     * Gets a record with id, or throws ModelNotFound exception if record does not exist
     * @param $id
     * @return mixed
     */
    public function findOrFail($id);
    /**
     * Gets a record matching attribute/value pairs, or creates a record if no match was found
     * @param array $attributes
     * @param array $values
     * @return mixed
     */
    public function firstOrCreate(array $attributes, array $values = []);
    /**
     * Updates a record matching attribute/value pairs, or creates a record if no match was found
     * @param array $attributes
     * @param array $values
     * @return mixed
     */
    public function updateOrCreate(array $attributes, array $values = []);
    /**
     * Get the associated model
     * @return Model
     */
    public function getModel();
    /**
     * Set the associated model
     * @param $model
     * @return $this
     */
    public function setModel($model);
    /**
     * Eager load database relationships
     * @param $relations
     * @return \Illuminate\Database\Eloquent\Builder|Model
     */
    public function with($relations);
    /**
     * @return Builder
     */
    public function getQuery(): Builder;
    /**
     * @return Model
     */
    public function makeNewInstance(): Model;
}
