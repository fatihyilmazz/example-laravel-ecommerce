<?php

namespace App\Providers;

use App\Brand;
use App\Category;
use App\Menu;
use App\MenuGroup;
use App\MenuType;
use App\Page;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\MenuGroupRepository;
use App\Repositories\MenuRepository;
use App\Repositories\MenuTypeRepository;
use App\Repositories\PageRepository;
use App\Services\BrandService;
use App\Services\CategoryService;
use App\Services\MenuService;
use App\Services\PageService;
use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register MenuService.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(MenuService::class, function () {
            return new MenuService(
                new MenuGroupRepository(
                    new MenuGroup()
                ),
                new MenuTypeRepository(
                    new MenuType()
                ),
                new MenuRepository(
                    new Menu()
                ),
                new PageService(
                    new PageRepository(new Page())
                ),
                new CategoryService(
                    new CategoryRepository(new Category())
                ),
                new BrandService(
                    new BrandRepository(new Brand())
                )
            );
        });
    }
}
