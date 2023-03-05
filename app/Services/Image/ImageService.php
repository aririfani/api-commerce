<?php

namespace App\Services\Image;

use App\Repositories\Image\ImageRepository;

class ImageService
{
    /**
     * @var ImageRepository $categoryRepository
     */
    private $imageRepository;
    
    /**
     * @param \App\Repositories\Image\ImageRepository $categoryRepository
     */
    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    /**
     * @param $file
     * @param array $image
     */
    public function create(array $image)
    {
        return $this->imageRepository->create($image);
    }
}