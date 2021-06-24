<?php

namespace App\Providers;

use App\Currency;
use App\Repositories\CurrencyRepository;
use App\Services\CurrencyService;
use Illuminate\Support\ServiceProvider;

class CurrencyServiceProvider extends ServiceProvider
{
    /**
     * Register CurrencyService.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CurrencyService::class, function () {
            return new CurrencyService(
                new CurrencyRepository(new Currency())
            );
        });
    }
}
