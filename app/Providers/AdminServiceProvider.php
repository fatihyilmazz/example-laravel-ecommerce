<?php

namespace App\Providers;

use App\Admin;
use App\Repositories\AdminRepository;
use App\Services\AdminService;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Register AdminService.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(AdminService::class, function () {
            return new AdminService(
                new AdminRepository(new Admin())
            );
        });
    }
}
