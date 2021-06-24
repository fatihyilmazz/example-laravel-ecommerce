<?php

namespace App\Providers;

use App\Locale;
use App\Repositories\LocaleRepository;
use App\Services\LocaleService;
use Illuminate\Support\ServiceProvider;

class LocaleServiceProvider extends ServiceProvider
{
    /**
     * Register LocaleService.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(LocaleService::class, function () {
            return new LocaleService(
                new LocaleRepository(new Locale())
            );
        });
    }
}
