<?php

namespace Tests\Unit;

use App\Repositories\Product\ProductRepository;
use App\Services\Product\ProductService;
use Mockery;
use Tests\TestCase;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductServiceTest extends TestCase
{
    private $productRepository;
    private $productService;

    public function setUp():void
    {
        parent::setUp();

        $this->productRepository    = Mockery::mock(ProductRepository::class);
        $this->productService       = new ProductService($this->productRepository);
    }

    /**
     * test create product success
     */
    public function test_create_product_success(): void
    {
        $product = Product::factory()->make([
            'name'          => 'cake',
            'description'   => 'some description',
            'enable'        => true
        ]);

        $this->productRepository
        ->shouldReceive('create')
        ->once()
        ->with([
            'name'          => $product->name,
            'description'   => $product->description,
            'enable'        => $product->enable
        ])
        ->andReturn($product);
    
        $data = $this->productService->create([
            'name'          => 'cake',
            'description'   => 'some description',
            'enable'        => true
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
        $product = Product::factory()->create();

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
                'enable'        => false
            ], $product->id)
            ->andReturn($modelMock);

        $data = $this->productService->update([
            'name'          => 'product update',
            'description'   => 'description update',
            'enable'        => false
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
}
