<?php

namespace App\Repositories\CategoryProduct;

use App\Repositories\EloquentAbstractRepository;
use App\Models\CategoryProduct;

/**
 * class EloqeuntCategoryProductRepository
 * @package App\Repositories\CategoryProduct
 */
class EloquentCategoryProductRepository extends EloquentAbstractRepository implements CategoryProductRepository
{
    /**
     * @param \App\Models\CategoryProduct $categoryProduct
     */
    public function __construct(CategoryProduct $categoryProduct)
    {
        parent::__construct($categoryProduct);
    }
}