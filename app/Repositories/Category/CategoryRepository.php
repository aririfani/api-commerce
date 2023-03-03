<?php

namespace App\Repositories\Category;

use Illuminate\Database\Eloquent\Model;

/**
 * interface CategoryRepository
 * @package App\Repositorie\Category
 */
interface CategoryRepository
{
    /**
     * @param array $param
     * @return Model
     */
    public function create(array $params);
}