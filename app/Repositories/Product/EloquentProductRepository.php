<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\EloquentAbstractRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * class EloquentProductRepository
 * @package App\Repositorie\Product;
 */
class EloquentProductRepository extends EloquentAbstractRepository implements ProductRepository
{
    /**
     * @param \App\Models\Product $product
     */
    public function __construct(Product $product)
    {
        parent::__construct($product);
    }
}