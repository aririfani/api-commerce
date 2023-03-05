<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImageRequest;
use App\Http\Resources\ImageResource;
use App\Services\Image\ImageService;

class ImageController extends Controller
{
    /**
     * @var $service
     */
    private $service;

    /**
     * @param \App\Services\Image\ImageService $imageService
     */
    public function __construct(ImageService $imageService)
    {
        $this->service = $imageService;
    }

    /**
     * @param \App\Http\Requests\ImageRequest $request
     */
    public function create(ImageRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['image'] = $request->file('image')->store('uploads');
        
        $data = $this->service->create([
            'file'      => $validatedData['image'],
            'name'      => $request->name,
            'enable'    => $request->enable,
        ]);

        return new ImageResource($data);
    }
}
