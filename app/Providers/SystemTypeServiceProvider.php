<?php

namespace App\Providers;

use App\Repositories\SystemTypeRepository;
use App\Services\SystemTypeService;
use App\SystemType;
use Illuminate\Support\ServiceProvider;

class SystemTypeServiceProvider extends ServiceProvider
{
    /**
     * Register SystemTypeService.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SystemTypeService::class, function () {
            return new SystemTypeService(
                new SystemTypeRepository(new SystemType())
            );
        });
    }
}
