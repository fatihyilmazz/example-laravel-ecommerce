<?php

namespace App\Providers;

use App\Category;
use App\Repositories\CategoryRepository;
use App\Services\CategoryService;
use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{
    /**
     * Register CategoryService.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CategoryService::class, function () {
            return new CategoryService(
                new CategoryRepository(new Category())
            );
        });
    }
}
