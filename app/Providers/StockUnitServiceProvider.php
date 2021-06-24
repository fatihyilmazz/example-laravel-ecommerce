<?php

namespace App\Providers;

use App\Repositories\StockUnitRepository;
use App\Services\StockUnitService;
use App\StockUnit;
use Illuminate\Support\ServiceProvider;

class StockUnitServiceProvider extends ServiceProvider
{
    /**
     * Register StockUnitService.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(StockUnitService::class, function () {
            return new StockUnitService(
                new StockUnitRepository(new StockUnit())
            );
        });
    }
}
