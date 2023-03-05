<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\CategoryProduct;
use Carbon\Carbon;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductImage;

class InitialSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'categories 1',
                'enable' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'categories 2',
                'enable' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        Category::insert($categories);

        $image = [
            [
                'name' => 'image 1',
                'file' => '/uploads/example.jpg',
                'enable'=> true,
            ],
            [
                'name' => 'image 2',
                'file' => '/uploads/example.jpg',
                'enable'=> true,
            ]
        ];

        Image::insert($image);

        $product = [
            [
                'name' => 'product 1',
                'description' => 'example product description',
                'enable' => true
            ],
            [
                'name' => 'product 2',
                'description' => 'example product description',
                'enable' => true
            ]
        ];

        Product::insert($product);

        $categoryProduct = [
            [
                'product_id' => 1,
                'category_id' => 1,
            ],
            [
                'product_id' => 1,
                'category_id' => 2,
            ],
            [
                'product_id' => 2,
                'category_id' => 1,
            ],
            [
                'product_id' => 2,
                'category_id' => 2,
            ],
        ];

        CategoryProduct::insert($categoryProduct);

        $productImage = [
            [
                'product_id' => 1,
                'image_id' => 1
            ],
            [
                'product_id' => 2,
                'image_id' => 1
            ]
        ];

        ProductImage::insert($productImage);
    }
}
