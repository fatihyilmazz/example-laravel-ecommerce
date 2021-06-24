<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\View\Composers\MenuComposer;
use App\View\Composers\PackageComposer;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Admin
        View::composer(
            [
                'admin.layouts.inc.sidebar',
                'admin.role.form',
                'admin.setting.image',
                'admin.setting.file',
            ],
            PackageComposer::class
        );

        // Web
        View::composer(
            sprintf(
                '%s.%s.%s.%s.%s',
                'web',
                setting('theme_path', 'steel'),
                'layouts',
                'inc',
                'header'
            ),
            MenuComposer::class
        );
        View::composer(
            sprintf(
                '%s.%s.%s',
                'web',
                setting('theme_path', 'steel'),
                'index'
            ),
            MenuComposer::class
        );
    }
}
