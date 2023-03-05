<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * interface RepositoryInterface
 * @package \App\Repositories
 */
interface RepositoryInterface
{
    /**
     * @param array $param
     * @return Model
     */
    public function create(array $params): Model;
    
    /**
     * @param array $param
     * @param int $id
     * @return Model
     */
    public function update(array $params, int $id): Model;

    /**
     * @return Collection
     */
    public function getAll(): ?Collection;

    /**
     * @param int $id
     * @return Model
     */
    public function findById(int $id): ?Model;

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id) : bool;

    /**
     * @param int $id
     */
    public function getAllWithPaginate(int $limit): LengthAwarePaginator;

    /**
     * @param array $data
     * @return bool
     */
    public function insert(array $data): bool;
}