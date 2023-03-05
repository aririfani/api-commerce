<?php

namespace App\Repositories\Product;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * class EloquentProductRepository
 * @package App\Repositorie\Product;
 */
class EloquentProductRepository implements ProductRepository
{
    /**
     * @var $model
     */
    private $model;

    /**
     * @param \App\Models\Product $product
     */
    public function __construct(Product $product)
    {
        $this->model = $product;
    }
    /**
     * @param array $param
     * @return Model
     */
    public function create(array $params): Model
    {
        return $this->model->create($params);
    }
    
    /**
     * @param array $param
     * @param int $id
     * @return Model
     */
    public function update(array $params, int $id): Model
    {
        $this->model->where('id','=', $id)->update($params);

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