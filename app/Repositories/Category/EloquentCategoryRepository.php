<?php

namespace App\Repositories\Category;

use App\Models\Category;
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
    public function create(array $params)
    {
        return $this->model->create($params);
    }
}