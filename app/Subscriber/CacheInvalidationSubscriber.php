<?php

namespace App\Subscriber;

use App\Events\CacheInvalidatedEvent;
use App\Menu;
use App\Setting;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Cache;

class CacheInvalidationSubscriber
{
    /**
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe(Dispatcher $events): void
    {
        $events->listen(
            CacheInvalidatedEvent::NAME_SETTING_UPDATED,
            'App\Subscriber\CacheInvalidationSubscriber@onSettingUpdated'
        );

        $events->listen(
            CacheInvalidatedEvent::NAME_MENU_UPDATED,
            'App\Subscriber\CacheInvalidationSubscriber@onMenuUpdated'
        );
    }

    /**
     * @param CacheInvalidatedEvent $event
     */
    public function onSettingUpdated(CacheInvalidatedEvent $event): void
    {
        Cache::forget(Setting::CACHE_KEY_ALL);
    }

    /**
     * @param CacheInvalidatedEvent $event
     */
    public function onMenuUpdated(CacheInvalidatedEvent $event): void
    {
        //TODO Dil sayısına göre sorun çıkacak düzelt
        Cache::forget(Menu::CACHE_KEY_HEADER_MENU_LOCALE. 'tr');
        Cache::forget(Menu::CACHE_KEY_HEADER_MENU_LOCALE. 'en');
    }
}
