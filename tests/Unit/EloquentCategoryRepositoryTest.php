<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Category;
use App\Repositories\Category\EloquentCategoryRepository;

class EloquentCategoryRepositoryTest extends TestCase
{
    protected $category;
    protected $categoryRepositoryMock;
    protected $repository;

    public function setUp(): void
    {
        parent::setUp();

        $this->category     = app(Category::class);
        $this->repository   = app(EloquentCategoryRepository::class, [$this->category]);
    }

    /**
     * A basic unit test example.
     */
    public function test_create_category_success(): void
    {
        $category = Category::factory()->make();

        $data = $this->repository->create([
            'name'      => $category->name,
            'enable'    => $category->enable
        ]);

        $this->assertEquals($category->name, $data->name);
        $this->assertEquals($category->enable, $data->enable);
    }

    public function tearDown(): void
    {
        parent::tearDown();

        unset($this->category);
        unset($this->repository);
    }
}
