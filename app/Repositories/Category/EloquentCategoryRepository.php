<?php

namespace App\Repositories\Category;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EloquentCategoryRepository
 * @package \App\Repositories\Category
 */
class EloquentCategoryRepository implements CategoryRepository
{
    /**
     * @var $model
     */
    protected $model;

    /**
     * @param \App\Models\Category
     * @return void
     */
    public function __construct(Category $model)
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
    public function findById(int $id) : Model
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
}