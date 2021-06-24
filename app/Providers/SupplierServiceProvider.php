<?php

namespace App\Providers;

use App\Repositories\SupplierRepository;
use App\Services\SupplierService;
use App\Supplier;
use Illuminate\Support\ServiceProvider;

class SupplierServiceProvider extends ServiceProvider
{
    /**
     * Register SupplierService.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SupplierService::class, function () {
            return new SupplierService(
                new SupplierRepository(new Supplier())
            );
        });
    }
}
