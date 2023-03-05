<?php

namespace App\Repositories\Image;

use App\Models\Image;
use App\Repositories\EloquentAbstractRepository;

/**
 * class EloquentImageRepository
 * @package App\Repositories\Image
 */
class EloquentImageRepository extends EloquentAbstractRepository implements ImageRepository
{
    /**
     * @param \App\Models\Image $model
     */
    public function __construct(Image $model)
    {
        parent::__construct($model);
    }
}