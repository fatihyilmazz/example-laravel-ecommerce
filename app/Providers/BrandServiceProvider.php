<?php

namespace App\Providers;

use App\Brand;
use App\Repositories\BrandRepository;
use App\Services\BrandService;
use Illuminate\Support\ServiceProvider;

class BrandServiceProvider extends ServiceProvider
{
    /**
     * Register BrandService.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(BrandService::class, function () {
            return new BrandService(
                new BrandRepository(new Brand())
            );
        });
    }
}
