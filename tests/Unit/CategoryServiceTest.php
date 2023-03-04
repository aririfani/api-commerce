<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\EloquentCategoryRepository;
use App\Services\Category\CategoryService;
use Illuminate\Support\Facades\Artisan;
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
        Artisan::call('migrate:refresh');
    }

    /**
     * test create category success
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

    /**
     * test update category success
     */
    public function test_update_category_success(): void
    {
        // create category
        $category = Category::factory()->create();

        // create mock eloquent model
        $modelMock = Mockery::mock('Illuminate\Database\Eloquent\Model');
        $modelMock->shouldReceive('getAttribute')->with('id')->andReturn(1);
        $modelMock->shouldReceive('getAttribute')->with('name')->andReturn('category update');
        $modelMock->shouldReceive('getAttribute')->with('enable', false)->andReturn(true);
        
        $this->categoryRepository
            ->shouldReceive('update')
            ->once()
            ->with([
                'name'      => 'category update',
                'enable'    => true
            ], $modelMock->id)
            ->andReturn($modelMock);

        $data = $this->categoryService->update([
            'name'      => 'category update',
            'enable'    => true
        ], $category->id);

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Model', $data);
        $this->assertNotEquals($category->name, $data->name);
    }

    /**
     * test find by id category success
     */
    public function test_find_by_id_category_success(): void
    {
        $category = Category::factory()->create();

        $this->categoryRepository
            ->shouldReceive('findById')
            ->once()
            ->with($category->id)
            ->andReturn($category);

        $data = $this->categoryService->findById($category->id);

        $this->assertEquals($category->name, $data->name);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Model', $data);
    }
}
