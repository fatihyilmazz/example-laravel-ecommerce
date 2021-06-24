<?php

namespace App\Providers;

use App\Page;
use App\Repositories\PageRepository;
use App\Services\PageService;
use Illuminate\Support\ServiceProvider;

class PageServiceProvider extends ServiceProvider
{
    /**
     * Register PageServices.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PageService::class, function () {
            return new PageService(
                new PageRepository(new Page())
            );
        });
    }
}
