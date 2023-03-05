<?php

namespace App\Providers;

use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\EloquentCategoryRepository;
use App\Repositories\CategoryProduct\CategoryProductRepository;
use App\Repositories\CategoryProduct\EloquentCategoryProductRepository;
use App\Repositories\Image\EloquentImageRepository;
use App\Repositories\Image\ImageRepository;
use App\Repositories\Product\EloquentProductRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\ProductImage\EloquentProductImageRepository;
use App\Repositories\ProductImage\ProductImageRepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CategoryRepository::class, EloquentCategoryRepository::class);
        $this->app->bind(ProductRepository::class, EloquentProductRepository::class);
        $this->app->bind(CategoryProductRepository::class, EloquentCategoryProductRepository::class);
        $this->app->bind(ProductImageRepository::class, EloquentProductImageRepository::class);
        $this->app->bind(ImageRepository::class, EloquentImageRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
