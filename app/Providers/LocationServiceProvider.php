<?php

namespace App\Providers;

use App\Country;
use App\District;
use App\Province;
use App\Repositories\CountryRepository;
use App\Repositories\DistrictRepository;
use App\Repositories\ProvinceRepository;
use App\Services\LocationService;
use Illuminate\Support\ServiceProvider;

class LocationServiceProvider extends ServiceProvider
{
    /**
     * Register LocationService.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(LocationService::class, function () {
            return new LocationService(
                new CountryRepository(new Country()),
                new ProvinceRepository(new Province()),
                new DistrictRepository(new District())
            );
        });
    }
}
