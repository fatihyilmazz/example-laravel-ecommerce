<?php

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localize', 'localeSessionRedirect' ]], static function() {
    Route::prefix(__('routes.admin.prefix'))->namespace('Admin')->name('admin.')->group(static function () {
        Route::middleware('auth:admin')->group(static function () {
            Route::prefix(__('routes.admin.setting.prefix'))->namespace('Setting')->name('setting.')->group(static function () {
                Route::get(__('routes.admin.setting.image'), 'ImageController@index')
                    ->name('image.index')
                    ->middleware('permission:list-image-settings');
                Route::put(__('routes.admin.setting.image'), 'ImageController@update')
                    ->name('image.update')
                    ->middleware('permission:update-image-settings');

                Route::get(__('routes.admin.setting.file'), 'FileController@index')
                    ->name('file.index')
                    ->middleware('permission:list-file-settings');
                Route::put(__('routes.admin.setting.file'), 'FileController@update')
                    ->name('file.update')
                    ->middleware('permission:update-file-settings');
            });
        });
    });
});
