<?php

if (false) {
    Route::get('/set-up', function () {
        Artisan::call('db:wipe');
        Artisan::call('migrate --seed');

        //Artisan::call('config:cache');
        //Artisan::call('route:cache');
        //Artisan::call('route:trans:cache');
        //Artisan::call('view:cache');
        //Artisan::call('event:cache');
        //Artisan::call('optimize');

        return redirect()
            ->route('web.index')
            ->with([
                'notifyStatus' => 'sucess',
                'notifyTitle' => __('messages.info.operation.successful'),
                'notifyMessage' => __('messages.info.operation.successful'),
            ]);
    });


    Route::get('/clear-all-cache', function () {
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('route:trans:clear');
        Artisan::call('view:clear');
        Artisan::call('event:clear');
        Artisan::call('permission:cache-reset');
        Artisan::call('cache:clear');
        Artisan::call('optimize:clear');

        return redirect()
            ->route('web.index')
            ->with([
                'notifyStatus' => 'sucess',
                'notifyTitle' => __('messages.info.operation.successful'),
                'notifyMessage' => __('messages.info.operation.successful'),
            ]);
    });
}
