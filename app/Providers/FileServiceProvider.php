<?php

namespace App\Providers;

use App\Services\FileService;
use Illuminate\Support\ServiceProvider;

class FileServiceProvider extends ServiceProvider
{
    /**
     * Register FilerService.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('File', function () {
            return new FileService();
        });
    }
}
