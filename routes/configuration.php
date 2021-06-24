<?php

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localize', 'localeSessionRedirect' ]], static function() {
    Route::prefix(__('routes.admin.prefix'))->namespace('Admin')->name('admin.')->group(static function () {
        Route::middleware('auth:admin')->group(static function () {
            Route::prefix(__('routes.admin.configuration.prefix'))->namespace('Configuration')->group(static function () {
                Route::name('configuration.')->group(static function() {
                    Route::get(__('routes.admin.configuration.general'), 'GeneralController@index')
                        ->name('general.index')
                        ->middleware('permission:list-general-configurations');
                    Route::put(__('routes.admin.configuration.general'), 'GeneralController@update')
                        ->name('general.update')
                        ->middleware('permission:update-general-configurations');
                });



                $routes = [
                    ['model' => 'country', 'options' => ['index', 'create', 'store', 'edit', 'update', 'destroy']],
                    ['model' => 'currency', 'options' => ['index', 'create', 'store', 'edit', 'update', 'destroy']],
                    ['model' => 'district', 'options' => ['index', 'create', 'store', 'edit', 'update', 'destroy']],
                    ['model' => 'locale', 'options' => ['index', 'edit', 'update']],
                    ['model' => 'province', 'options' => ['index', 'create', 'store', 'edit', 'update', 'destroy']],
                    ['model' => 'tax_rate', 'options' => ['index', 'create', 'store', 'edit', 'update', 'destroy']],
                ];

                foreach ($routes as $route) {
                    Route::prefix(__('routes.admin.'. Str::plural($route['model'])))->group(static function () use ($route) {
                        if (in_array('index', $route['options'])) {
                            Route::get('/', Str::studly($route['model']). 'Controller@index')
                                ->name(Str::plural($route['model']). '.index')
                                ->middleware('permission:list-'. Str::kebab(Str::studly(Str::plural($route['model']))));
                        }

                        if (in_array('create', $route['options'])) {
                            Route::get(__('routes.common.create'), Str::studly($route['model']). 'Controller@create')
                                ->name(Str::plural($route['model']). '.create')
                                ->middleware('permission:create-'. Str::kebab(Str::studly(Str::plural($route['model']))));
                        }

                        if (in_array('store', $route['options'])) {
                            Route::post('/', Str::studly($route['model']). 'Controller@store')
                                ->name(Str::plural($route['model']). '.store')
                                ->middleware('permission:create-'. Str::kebab(Str::studly(Str::plural($route['model']))));
                        }

                        if (in_array('edit', $route['options'])) {
                            Route::get(sprintf('%s%s', '/{'. Str::camel($route['model']). '}/', __('routes.common.edit')), Str::studly($route['model']). 'Controller@edit')
                                ->name(Str::plural($route['model']). '.edit')
                                ->middleware('permission:update-'. Str::kebab(Str::studly(Str::plural($route['model']))). '|view-'. Str::kebab(Str::studly(Str::plural($route['model']))))
                                ->where($route['model'], '[0-9]+');
                        }

                        if (in_array('update', $route['options'])) {
                            Route::put('/{'. Str::camel($route['model']). '}', Str::studly($route['model']). 'Controller@update')
                                ->name(Str::plural($route['model']). '.update')
                                ->middleware('permission:update-'. Str::kebab(Str::studly(Str::plural($route['model']))))
                                ->where($route['model'], '[0-9]+');
                        }

                        if (in_array('destroy', $route['options'])) {
                            Route::delete('/{'. Str::camel($route['model']). '}', Str::studly($route['model']). 'Controller@destroy')
                                ->name(Str::plural($route['model']). '.destroy')
                                ->middleware('permission:delete-'. Str::kebab(Str::studly(Str::plural($route['model']))))
                                ->where($route['model'], '[0-9]+');
                        }

                        if (in_array('transactionHistoryList', $route['options'])) {
                            Route::get(__('routes.common.transaction_histories'), Str::studly($route['model']). 'Controller@transactionHistoryList')
                                ->name(Str::plural($route['model']). '.histories')
                                ->middleware('permission:view-'. Str::kebab(Str::studly(Str::plural($route['model']))). '-histories');
                        }
                    });
                }
            });
        });
    });
});
