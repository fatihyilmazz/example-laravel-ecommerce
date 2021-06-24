<?php

if (!function_exists('setting')) {

    /**
     * @param string $key
     * @param array|string $default
     *
     * @return mixed
     */
    function setting($key, $default)
    {
        $settingService = app('Setting');

        return $settingService->get($key, $default);
    }
}
