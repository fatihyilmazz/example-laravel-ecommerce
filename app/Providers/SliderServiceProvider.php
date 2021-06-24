<?php

namespace App\Providers;

use App\Repositories\SliderRepository;
use App\Repositories\SliderTypeRepository;
use App\Services\SliderService;
use App\Slider;
use App\SliderType;
use Illuminate\Support\ServiceProvider;

class SliderServiceProvider extends ServiceProvider
{
    /**
     * Register SliderService.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SliderService::class, function () {
            return new SliderService(
                new SliderTypeRepository(new SliderType()),
                new SliderRepository(new Slider())
            );
        });
    }
}
