<?php

namespace App\Repositories\Category;

use Illuminate\Database\Eloquent\Collection;
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
    public function create(array $params): Model;
    
    /**
     * @param array $param
     * @param int $id
     * @return Model
     */
    public function update(array $params, int $id): Model;

    /**
     * @param Collection
     */
    public function getAll(): Collection;
}