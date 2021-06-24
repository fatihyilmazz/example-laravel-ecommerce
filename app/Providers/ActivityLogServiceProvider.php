<?php

namespace App\Providers;

use App\Repositories\ActivityLogRepository;
use App\Services\ActivityLogService;
use Illuminate\Support\ServiceProvider;
use Spatie\Activitylog\Models\Activity;

class ActivityLogServiceProvider extends ServiceProvider
{
    /**
     * Register ActivityService.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ActivityLogService::class, function () {
            return new ActivityLogService(new ActivityLogRepository(new Activity()));
        });
    }
}
