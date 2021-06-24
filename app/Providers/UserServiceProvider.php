<?php

namespace App\Providers;

use App\Repositories\UserRepository;
use App\Services\UserService;
use App\User;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register UserService.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UserService::class, function () {
            return new UserService(
                new UserRepository(new User())
            );
        });
    }
}
