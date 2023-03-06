<?php

namespace App\Services\Product;

use App\Repositories\CategoryProduct\CategoryProductRepository;
use App\Repositories\Product\ProductRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use App\Repositories\ProductImage\ProductImageRepository;

/**
 * class ProductService
 * @package App\Service\Product
 */
class ProductService
{
    private $productRepository;

    private $categoryProductRepository;

    private $productImageRepository;

    /**
     * @param \App\Repositories\Product\ProductRepository $productRepository
     * @param \App\Repositories\CategoryProduct\CategoryProductRepository $categoryProductRepository
     * @param \App\Repositories\ProductImage\ProductImageRepository $productImageRepository
     */
    public function __construct(
        ProductRepository $productRepository, 
        CategoryProductRepository $categoryProductRepository, 
        ProductImageRepository $productImageRepository
    )
    {
        $this->productRepository            = $productRepository;
        $this->categoryProductRepository    = $categoryProductRepository;
        $this->productImageRepository       = $productImageRepository;
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data) : Model
    {
        DB::beginTransaction();

        try {
            $product = $this->productRepository->create([
                'name'          => $data['name'],
                'description'   => $data['description'],
                'enable'        => $data['enable']
            ]);
    
            if (isset($data['categories'])) {
                $categoryProduct = [];
                foreach($data['categories'] as $category) {
                    $categoryProduct[] = [
                        'product_id' => $product->id,
                        'category_id' => $category['id']
                    ];
                }
    
                $this->categoryProductRepository->insert($categoryProduct);
            }

            if (isset($data['images'])) {
                $imageProduct = [];
                foreach($data['images'] as $image) {
                    $imageProduct[] = [
                        'image_id'      => $image['id'],
                        'product_id'    => $product->id
                    ];
                }

                $this->productImageRepository->insert($imageProduct);
            }

            DB::commit();
        } catch(\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }

        return $product;
    }

    /**
     * @param array $data
     * @param int $id
     * @return Model
     */
    public function update(array $data, int $id) : Model
    {
        DB::beginTransaction();

        try {
            $product = $this->productRepository->update([
                'name'          => $data['name'],
                'description'   => $data['description'],
                'enable'        => $data['enable'],
            ], $id);
    
            if (isset($data['categories'])) {
                $categoryProduct = [];
                foreach($data['categories'] as $category) {
                    $categoryProduct[] = [
                        'product_id' => $product->id,
                        'category_id' => $category['id']
                    ];
                }
    
                $this->categoryProductRepository->insert($categoryProduct);
            }

            if (isset($data['images'])) {
                $imageProduct = [];
                foreach($data['images'] as $image) {
                    $imageProduct[] = [
                        'image_id'      => $image['id'],
                        'product_id'    => $product->id
                    ];
                }

                $this->productImageRepository->insert($imageProduct);
            }
            DB::commit();
        } catch(\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }

        return $product;
    }

    /**
     * @param int $id
     * @return Model
     */
    public function findById(int $id) : ?Model
    {
        return $this->productRepository->findById($id);
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->productRepository->getAll();
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->productRepository->delete($id);
    }

    /**
     * @param int $limit
     */
    public function getAllWithPaginate(int $limit) : LengthAwarePaginator
    {
        return $this->productRepository->getAllWithPaginate($limit);
    }
}