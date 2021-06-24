<?php

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localize', 'localeSessionRedirect' ]], static function() {
    Route::prefix(__('routes.admin.prefix'))->namespace('Admin')->name('admin.')->group(static function () {
        Route::middleware('role:'. \App\Admin::ROLE_NAME_SUPER_ADMIN)->name('super_admin')->group(static function () {
            //TODO Super Admin
        });
    });
});
