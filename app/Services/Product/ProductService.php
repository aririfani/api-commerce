<?php

namespace App\Services\Product;

use App\Repositories\Product\ProductRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * class ProductService
 * @package App\Service\Product
 */
class ProductService
{
    private $productRepository;

    /**
     * @param \App\Repositories\Product\ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data) : Model
    {
        return $this->productRepository->create([
            'name'          => $data['name'],
            'description'   => $data['description'],
            'enable'        => $data['enable']
        ]);
    }

    /**
     * @param array $data
     * @param int $id
     * @return Model
     */
    public function update(array $data, int $id) : Model
    {
        return $this->productRepository->update([
            'name'          => $data['name'],
            'description'   => $data['description'],
            'enable'        => $data['enable'],
        ], $id);
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