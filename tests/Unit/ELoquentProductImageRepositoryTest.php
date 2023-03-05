<?php

namespace Tests\Unit;

use App\Models\Image;
use App\Models\Product;
use App\Models\ProductImage;
use App\Repositories\ProductImage\EloquentProductImageRepository;
use Tests\TestCase;

class ELoquentProductImageRepositoryTest extends TestCase
{
    protected $repository;
    protected $productImage;

    public function setUp():void
    {
        parent::setUp();

        $this->productImage = app(ProductImage::class);
        $this->repository   = app(EloquentProductImageRepository::class,[$this->productImage]);
    }

    /**
     * test create product image
     */
    public function test_create_product_image():void
    {
        $productModel   = Product::factory()->create();
        $imageModel     = Image::factory()->create();

        $data = $this->repository->create([
            'product_id'    => $productModel->id,
            'image_id'      => $imageModel->id,
        ]);

        $this->assertEquals($productModel->id, $data->product_id);
        $this->assertEquals($imageModel->id, $data->image_id);
    }

    /**
     * test insert product image
     */
    public function test_insert_product_image(): void
    {
        $productModel   = Product::factory()->create();
        $imageModel     = Image::factory()->count(4)->create();

        $productImage = [];
        foreach($imageModel as $image) {
            $productImage[] = [
                'product_id' => $productModel->id,
                'image_id' => $image->id
            ];
        }

        $data = $this->repository->insert($productImage);

        $this->assertTrue($data);
    }
}
