<?php

namespace App\Services\Category;

use App\Repositories\Category\CategoryRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CategoryService
 * @package App\Services\Category
 */
class CategoryService
{
    /**
     * @var CategoryRepository $categoryRepository
     */
    private $categoryRepository;
    
    /**
     * @param \App\Repositories\Category\CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data) : Model
    {
        return $this->categoryRepository->create([
            'name'      => $data['name'],
            'enable'    => $data['enable']
        ]);
    }
}