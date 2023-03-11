<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Image;
use App\Repositories\Product\ProductRepository;
use App\Services\Product\ProductService;
use Mockery;
use Tests\TestCase;
use App\Models\Product;
use App\Repositories\CategoryProduct\CategoryProductRepository;
use App\Repositories\ProductImage\ProductImageRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductServiceTest extends TestCase
{
    private $productRepository;
    private $productService;
    private $categoryProductRepository;
    private $productImageRepository;

    public function setUp():void
    {
        parent::setUp();

        $this->productRepository            = Mockery::mock(ProductRepository::class);
        $this->categoryProductRepository    = Mockery::mock(CategoryProductRepository::class);
        $this->productImageRepository       = Mockery::mock(ProductImageRepository::class);
        $this->productService               = new ProductService(
            $this->productRepository, 
            $this->categoryProductRepository,
            $this->productImageRepository
        );
    }

    /**
     * test create product success
     */
    public function test_create_product_success(): void
    {
        $product = Product::factory()->make([
            'name'          => 'cake',
            'description'   => 'some description',
            'enable'        => true,
        ]);

        $category   = Category::factory()->create();
        $image      = Image::factory()->create();

        $categoryProduct = [
            ['id' => $category->id]
        ];

        $productImage = [
            ['id' => $image->id]
        ];

        $this->productRepository
            ->shouldReceive('create')
            ->once()
            ->with([
                'name'          => $product->name,
                'description'   => $product->description,
                'enable'        => $product->enable
            ])
        ->andReturn($product);

        $this->categoryProductRepository
            ->shouldReceive('insert')
            ->once()
            ->andReturn(true);

        $this->productImageRepository
            ->shouldReceive('insert')
            ->once()
            ->andReturn(true);

    
        $data = $this->productService->create([
            'name'          => 'cake',
            'description'   => 'some description',
            'enable'        => true,
            'categories'    => $categoryProduct,
            'images'        => $productImage,
        ]);

        $this->assertEquals('cake', $data->name);
        $this->assertEquals('some description', $data->description);
        $this->assertEquals(true, $data->enable);
    }
    
    /**
     * test update product success
     */
    public function test_update_product_success(): void
    {
        $product    = Product::factory()->create();
        $category   = Category::factory()->create();
        $image      = Image::factory()->create();

        $categoryProduct = [
            ['id' => $category->id]
        ];

        $productImage = [
            ['id' => $image->id]
        ];

        $modelMock = Mockery::mock('Illuminate\Database\Eloquent\Model');
        $modelMock->shouldReceive('getAttribute')->with('id')->andReturn(1);
        $modelMock->shouldReceive('getAttribute')->with('name')->andReturn('product update');
        $modelMock->shouldReceive('getAttribute')->with('description')->andReturn('description update');
        $modelMock->shouldReceive('getAttribute')->with('enable')->andReturn(false);
        
        $this->productRepository
            ->shouldReceive('update')
            ->once()
            ->with([
                'name'          => 'product update',
                'description'   => 'description update',
                'enable'        => false,
            ], $product->id)
            ->andReturn($modelMock);

        $this->categoryProductRepository
            ->shouldReceive('insert')
            ->once()
            ->andReturn(true);

        $this->productImageRepository
            ->shouldReceive('insert')
            ->once()
            ->andReturn(true);

        $data = $this->productService->update([
            'name'          => 'product update',
            'description'   => 'description update',
            'enable'        => false,
            'categories'    => $categoryProduct,
            'images'        => $productImage,
        ], $product->id);

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Model', $data);
        $this->assertNotEquals($product->name, $data->name);
        $this->assertNotEquals($product->description, $data->description);
        $this->assertNotEquals($product->enable, $data->enable);
    }

    /**
     * test find by id product success
     */
    public function test_find_by_id_product_success(): void
    {
        $product = Product::factory()->create();

        $this->productRepository
            ->shouldReceive('findById')
            ->once()
            ->with($product->id)
            ->andReturn($product);

        $data = $this->productService->findById($product->id);

        $this->assertEquals($product->name, $data->name);
        $this->assertEquals($product->description, $data->description);
        $this->assertEquals($product->enable, $data->enable);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Model', $data);
    }

    /**
     * test get all product success
     */
    public function test_get_all_product_success(): void
    {
        $product = Product::factory()->count(4)->create();

        $this->productRepository
            ->shouldReceive('getAll')
            ->once()
            ->andReturn($product);

        $data = $this->productService->getAll();

        $this->assertInstanceOf(Collection::class, $data);
        $this->assertCount(4, $data);
    }

    /**
     * test delete product by id
     */
    public function test_delete_product_by_id(): void
    {
        $product = Product::factory()->create();

        $this->productRepository
            ->shouldReceive('delete')
            ->once()
            ->with($product->id)
            ->andReturn(true);

        $data = $this->productService->delete($product->id);

        $this->assertEquals(true, $data);
    }

    /**
     * test get all product with paginate
     */
    public function test_get_all_product_with_paginate(): void
    {
        $products = Product::factory()->count(10)->create();

        $this->productRepository
            ->shouldReceive('getAllWithPaginate')
            ->with(5)
            ->andReturn(new LengthAwarePaginator(
                $products->slice(0,5),
                $products->count(),
                5,
                1
            ));
            
        $data = $this->productService->getAllWithPaginate(5);

        $this->assertCount(5, $data);
    }
}
