<?php

namespace App\Providers;

use App\Package;
use App\Repositories\PackageRepository;
use App\Services\PackageService;
use Illuminate\Support\ServiceProvider;

class PackageServiceProvider extends ServiceProvider
{
    /**
     * Register PackageService.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PackageService::class, function () {
            return new PackageService(
                new PackageRepository(new Package())
            );
        });
    }
}
