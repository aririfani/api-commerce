<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Category;
use App\Repositories\Category\EloquentCategoryRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Artisan;

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
        Artisan::call('migrate:refresh');
    }

    /**
     * test create category success
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

    /**
     * test update category success
     */
    public function test_update_category_success(): void
    {
        $category = Category::factory()->create();

        $data = $this->repository->update([
            'name'      => $category->name . ' update',
            'enable'    => $category->enable
        ], $category->id);

        $this->assertEquals($category->name . ' update', $data->name);
        $this->assertEquals($category->enable, $data->enable);
        $this->assertEquals($category->id, $data->id);
    }

    /**
     * test find by id success
     */
    public function test_find_by_id_success(): void
    {
        $category = Category::factory()->create();

        $data = $this->repository->findById($category->id);

        $this->assertEquals($category->name, $data->name);
        $this->assertEquals($category->enable, $data->enable);
        $this->assertEquals($category->id, $data->id);
    }

    /**
     * test get all category
     */
    public function test_get_all_category(): void
    {
        Category::factory()->count(2)->create();
        $data = $this->repository->getAll();

        $this->assertInstanceOf(Collection::class, $data);
        $this->assertCount(2, $data);
    }

    public function tearDown(): void
    {
        parent::tearDown();

        unset($this->category);
        unset($this->repository);
    }
}
