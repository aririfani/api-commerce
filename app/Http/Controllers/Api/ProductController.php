<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Services\Product\ProductService;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * class ProductController
 * @package App\Http\Controllers\Api
 */
class ProductController extends Controller
{
    /**
     * @var $service
     */
    private $service;

    /**
     * @param \App\Services\Product\ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->service = $productService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = $this->service->getAllWithPaginate($request->get('limit') ?: 10);

        return ProductResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     * @param \App\Http\Requests\ProductRequest $request
     * @return \App\Http\Resources\ProductResource
     */
    public function store(ProductRequest $request)
    {
        $data = $this->service->create($request->only('name','description','enable','categories','images'));

        return new ProductResource($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->service->findById($id);

        if (!$data) {
            throw new NotFoundHttpException();
        }

        return new ProductResource($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $this->service->update($request->only('name','description','enable','categories','images'), $id);

        return new ProductResource($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->service->delete($id);

        return response()->json(['message' => 'success', 'status_code' => 200]);
    }
}
