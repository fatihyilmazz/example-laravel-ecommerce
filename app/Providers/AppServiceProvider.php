<?php

namespace App\Providers;

use App\Product;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Laravel\Telescope\TelescopeServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->islocal()) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);

            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Relation::morphMap([
            'product' => Product::class,
        ]);

        Blade::if('isModuleActive', function (array $moduleIds, array $activeModulesIds) {
            if (!empty(array_intersect($moduleIds, $activeModulesIds))) {
                return true;
            }
            return false;
        });

        //Activity::saving(function (Activity $activity) {
        //    $activity->properties = $activity->properties->put('ip', request()->ip());
        //});
    }
}
