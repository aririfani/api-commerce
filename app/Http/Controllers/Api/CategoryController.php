<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use App\Services\Category\CategoryService;

/**
 * Class CategoryController
 * @package App\Http\Controller\Api
 */
class CategoryController extends Controller
{
    /**
     * @var $service
     */
    private $service;

    /**
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->service = $categoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->service->getAll();

        return CategoryResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $data = $this->service->create($request->only('name','enable'));

        return new CategoryResource($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->service->findById($id);

        return new CategoryResource($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $this->service->update($request->only('name', 'enable'), $id);

        return new CategoryResource($data);
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
