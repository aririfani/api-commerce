<?php

namespace App\Repositories\ProductImage;

use App\Models\ProductImage;
use App\Repositories\EloquentAbstractRepository;

/**
 * class EloquentProductImageRepository
 * @package \App\Repositories\ProductImage
 */
class EloquentProductImageRepository extends EloquentAbstractRepository implements ProductImageRepository
{
    /**
     * @param \App\Models\ProductImage $model
     */
    public function __construct(ProductImage $model)
    {
        parent::__construct($model);
    }
}