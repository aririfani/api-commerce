<?php

namespace Tests\Unit;

use App\Models\Product;
use Tests\TestCase;
use App\Repositories\Product\EloquentProductRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Artisan;

class EloquentProductRepositoryTest extends TestCase
{
    protected $product;
    protected $repository;

    public function setUp(): void
    {
        parent::setUp();

        $this->product = app(Product::class);
        $this->repository = app(EloquentProductRepository::class,[$this->product]);
        Artisan::call('migrate:refresh');
    }
    
    /**
     * test create product success.
     */
    public function test_create_product_success(): void
    {
        $product = Product::factory()->make();

        $data = $this->repository->create([
            'name'          => $product->name,
            'description'   => $product->description,
            'enable'        => $product->enable,
        ]);

        $this->assertEquals($product->name, $data->name);
        $this->assertEquals($product->description, $data->description);
        $this->assertEquals($product->enable, $data->enable);
    }

    /**
     * test update product success
     */
    public function test_update_product_sucecss(): void
    {
        $product = Product::factory()->create();

        $data = $this->repository->update([
            'name'          => $product->name . ' update',
            'description'   => $product->description . ' update',
            'enable'        => false,
        ], $product->id);

        $this->assertNotEquals($product->name, $data->name);
        $this->assertNotEquals($product->description, $data->description);
        $this->assertEquals(false, $data->enable);
        $this->assertEquals($product->id, $data->id);
    }

    /**
     * test find by id success
     */
    public function test_find_by_id_success(): void
    {
        $product = Product::factory()->create();

        $data = $this->repository->findById($product->id);

        $this->assertEquals($product->name, $data->name);
        $this->assertEquals($product->description, $data->description);
        $this->assertEquals($product->enable, $data->enable);
        $this->assertEquals($product->id, $data->id);
    }

    /**
     * test get all product
     */
    public function test_get_all_product(): void
    {
        Product::factory()->count(4)->create();

        $data = $this->repository->getAll();

        $this->assertInstanceOf(Collection::class, $data);
        $this->assertCount(4, $data);
    }

    /**
     * test delete product
     */
    public function test_delete_product(): void
    {
        $product    = Product::factory()->create();
        $data       = $this->repository->delete($product->id);

        $this->assertTrue($data);
    }

    public function tearDown(): void
    {
        parent::tearDown();

        unset($this->product);
        unset($this->repository);
    }
}
