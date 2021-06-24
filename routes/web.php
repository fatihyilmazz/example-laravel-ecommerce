<?php
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localize', 'localeSessionRedirect' ]], function() {
    Route::namespace('Web')->name('web.')->group(function () {
        Route::get(__('routes.web.login'), 'Auth\LoginController@showLoginForm')
            ->name('show_login');
        Route::post(__('routes.web.login'), 'Auth\LoginController@login')
            ->name('login');

        Route::get(__('routes.web.index'), 'HomeController')
            ->name('index');

        Route::get(__('routes.web.categories') . '/{slug}', 'CategoryController@index')
            ->name('categories.index');

        Route::get(__('routes.web.brands') . '/{brand:name}', 'BrandController@index')
            ->name('brands.index');

        Route::get(__('routes.web.products') . '/{slug}', 'ProductController@detail')
            ->name('products.detail');

        Route::match(['GET', 'POST'], __('routes.web.static_page.contact'), 'StaticPageController@contact')
            ->name('static_pages.contact');

        Route::get(__('routes.web.pages') . '/{slug}', 'PageController')->name('pages');

        Route::middleware('auth:web')->group(function () {
            Route::post(__('routes.web.logout'), 'Auth\LoginController@logout')
                ->name('logout');
        });
    });
});

//TODO oturum açmış kullanıcı resim yükleyebilir
Route::post('file/upload/image', 'Admin\FileController@uploadImageFile')
    ->name('upload.image.file');

