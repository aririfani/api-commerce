<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * abstract class EloquentAbstractRepository
 * @package App\Repositories
 */
abstract class EloquentAbstractRepository implements RepositoryInterface
{
    /**
     * @var $model
     */
    protected $model;

    /**
     * @param Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function __construct(Model $model)
    {
        $this->model = $model;    
    }

    /**
     * @param array $param
     * @return Model
     */
    public function create(array $params) : Model
    {
        return $this->model->create($params);
    }

    /**
     * @param array $param
     * @param int $id
     * @return Model
     */
    public function update(array $params, int $id) : Model
    {
        $this->model->where('id', '=', $id)->update($params);

        return $this->model->find($id);
    }

    /**
     * @param int $id
     * @return Model
     */
    public function findById(int $id) : ?Model
    {
        return $this->model->where('id','=', $id)->first();
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id) : bool
    {
        return $this->model->where('id', '=', $id)->delete();
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->model->all();
    }

    /**
     * @param int $limit
     * @return LeenghtAwarePaginator
     */
    public function getAllWithPaginate(int $limit): LengthAwarePaginator
    {
        return $this->model->paginate($limit);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function insert(array $data): bool
    {
        return $this->model->insert($data);
    }
}