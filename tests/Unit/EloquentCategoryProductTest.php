<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Product;
use App\Repositories\CategoryProduct\EloquentCategoryProductRepository;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class EloquentCategoryProductTest extends TestCase
{
    protected $categoryProduct;
    protected $repository;

    public function setUp(): void
    {
        parent::setUp();

        $this->categoryProduct  = app(CategoryProduct::class);
        $this->repository       = app(EloquentCategoryProductRepository::class, [$this->categoryProduct]);
        Artisan::call('migrate:refresh');
    }

    /**
     * test create category product success
     */
    public function test_create_category_product_success(): void
    {
        $categoryModel  = Category::factory()->create();
        $productModel   = Product::factory()->create();

        $data = $this->repository->create([
            'category_id' => $categoryModel->id,
            'product_id' => $productModel->id
        ]);

        $this->assertEquals($categoryModel->id, $data->category_id);
        $this->assertEquals($productModel->id, $data->product_id);
    }

    /**
     * test insert category product success
     */
    public function test_insert_category_product_success(): void
    {
        $categoryModel = Category::factory()->count(4)->create();
        $productModel = Product::factory()->create();

        $categoryProduct = [];
        foreach($categoryModel as $category) {
            $categoryProduct[] = [
                'product_id'    => $productModel->id,
                'category_id'   => $category->id
            ];
        }

        $data = $this->repository->insert($categoryProduct);

        $this->assertEquals(true, $data);
    }
}
 