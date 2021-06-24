<?php

namespace App\Providers;

use App\Product;
use App\ProductType;
use App\Repositories\ProductRepository;
use App\Repositories\ProductTypeRepository;
use App\Services\ProductService;
use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    /**
     * Register ProductService.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ProductService::class, function () {
            return new ProductService(
                new ProductRepository(new Product()),
                new ProductTypeRepository(new ProductType())
            );
        });
    }
}
