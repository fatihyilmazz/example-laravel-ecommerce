<?php

namespace App\Providers;

use App\Repositories\SettingRepository;
use App\Services\SettingService;
use App\Setting;
use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Register SettingService.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Setting', function () {
            return new SettingService(
                new SettingRepository(new Setting())
            );
        });
    }
}
