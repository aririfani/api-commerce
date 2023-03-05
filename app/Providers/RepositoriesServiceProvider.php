<?php

namespace App\Providers;

use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\EloquentCategoryRepository;
use App\Repositories\CategoryProduct\CategoryProductRepository;
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
        $this->app->bind(CategoryProductRepository::class, EloquentProductRepository::class);
        $this->app->bind(ProductImageRepository::class, EloquentProductImageRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
