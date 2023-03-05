<?php

namespace Tests\Unit;

use App\Models\Image;
use Tests\TestCase;
use App\Repositories\Image\EloquentImageRepository;
use Illuminate\Support\Facades\Artisan;

class EloquentImageRepositoryTest extends TestCase
{
    protected $repository;

    protected $image;

    public function setUp(): void
    {
        parent::setUp();

        $this->image            = app(Image::class);
        $this->repository       = app(EloquentImageRepository::class,[$this->image]);
        Artisan::call('migrate:refresh');
    }

    /**
     * test create image success
     */
    public function test_create_image_success(): void
    {
        $image = Image::factory()->make();
        $data = $this->repository->create([
            'name'      => $image->name,
            'file'      => $image->file,
            'enable'    => true,
        ]);

        $this->assertEquals($image->name, $data->name);
        $this->assertEquals($image->file, $data->file);
        $this->assertEquals($image->enable, $data->enable);
    }

    /**
     * test update image success
     */
    public function test_update_image_success(): void
    {
        $image = Image::factory()->create();

        $data = $this->repository->update([
            'name'      => $image->name .' update',
            'file'      => $image->file .'/update',
            'enable'    => false,
        ],$image->id);

        $this->assertNotEquals($image->name, $data->name);
        $this->assertNotEquals($image->file, $data->file);
        $this->assertEquals(false, $data->enable);
        $this->assertEquals($image->id, $data->id);
    }

    /**
     * test find by id success
     */
    public function test_find_by_id_success(): void
    {
        $image = Image::factory()->create();

        $data = $this->repository->findById($image->id);

        $this->assertEquals($image->name, $data->name);
        $this->assertEquals($image->file, $data->file);
        $this->assertEquals($image->enable, $data->enable);
        $this->assertEquals($image->id, $data->id);
    }

    /**
     * test delete product
     */
    public function test_delete_product(): void
    {
        $image    = Image::factory()->create();
        $data       = $this->repository->delete($image->id);

        $this->assertTrue($data);
    }
}
