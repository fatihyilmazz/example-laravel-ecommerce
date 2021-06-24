<?php

namespace App\Providers;

use App\Repositories\TaxRateRepository;
use App\Services\TaxRateService;
use App\TaxRate;
use Illuminate\Support\ServiceProvider;

class TaxRateServiceProvider extends ServiceProvider
{
    /**
     * Register TaxRateService.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(TaxRateService::class, function () {
            return new TaxRateService(
                new TaxRateRepository(new TaxRate())
            );
        });
    }
}
