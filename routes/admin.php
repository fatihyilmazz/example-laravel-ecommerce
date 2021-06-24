<?php

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localize', 'localeSessionRedirect' ]], static function() {

    //Auth::routes(['register' => false, 'login' => false]);
    // Auth::routes(['verify' => true]);

    Route::prefix(__('routes.admin.prefix'))->namespace('Admin')->name('admin.')->group(static function () {
        Route::get(__('routes.admin.login'), 'Auth\LoginController@showLoginForm')->name('show_login');
        Route::post(__('routes.admin.login'), 'Auth\LoginController@login')->name('login');

        Route::middleware('auth:admin')->group(static function () {
            Route::post(__('routes.admin.logout'), 'Auth\LoginController@logout')->name('logout');

            Route::get(__('routes.admin.index'), 'HomeController')->name('index');
        });

        Route::middleware('role:'. \App\Admin::ROLE_NAME_SUPER_ADMIN)->name('super_admin')->group(static function () {
            //TODO Super Admin
        });
    });
});
