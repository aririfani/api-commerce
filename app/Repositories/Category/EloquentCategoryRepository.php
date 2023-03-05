<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\EloquentAbstractRepository;

/**
 * Class EloquentCategoryRepository
 * @package \App\Repositories\Category
 */
class EloquentCategoryRepository extends EloquentAbstractRepository implements CategoryRepository
{
    /**
     * @param \App\Models\Category
     * @return void
     */
    public function __construct(Category $model)
    {
        parent::__construct($model);  
    }
}