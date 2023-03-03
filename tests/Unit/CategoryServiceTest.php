<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\EloquentCategoryRepository;
use App\Services\Category\CategoryService;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class CategoryServiceTest extends TestCase
{
    protected $categoryRepository;
    protected $categoryService;

    public function setUp(): void
    {
        parent::setUp();

        $this->categoryRepository   = Mockery::mock(CategoryRepository::class);
        $this->categoryService      = new CategoryService($this->categoryRepository);
    }

    /**
     * A basic unit test example.
     */
    public function test_create_category_success(): void
    {
        $category = Category::factory()->make([
            'name'      => 'Food',
            'enable'    => true
        ]);

        $this->categoryRepository
            ->shouldReceive('create')
            ->once()
            ->with([
                'name'      => $category->name,
                'enable'    => $category->enable
            ])
            ->andReturn($category);
        
        $data = $this->categoryService->create([
            'name'      => 'Food',
            'enable'    => true
        ]);

        $this->assertEquals('Food', $data->name);
        $this->assertEquals(true, $data->enable);
    }
}
