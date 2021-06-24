<?php

namespace App\Observers;

use App\Events\CacheInvalidatedEvent;
use App\Menu;

class MenuObserver
{
    /**
     * Handle the menu "created" event.
     *
     * @param \App\Menu $menu
     * @return void
     */
    public function created(Menu $menu)
    {
        $this->fireCacheInvalidationEvent($menu);
    }

    /**
     * Handle the menu "updated" event.
     *
     * @param \App\Menu $menu
     * @return void
     */
    public function updated(Menu $menu)
    {
        $this->fireCacheInvalidationEvent($menu);
    }

    /**
     * Handle the menu "deleted" event.
     *
     * @param \App\Menu $menu
     * @return void
     */
    public function deleted(Menu $menu)
    {
        $this->fireCacheInvalidationEvent($menu);
    }

    /**
     * Handle the menu "restored" event.
     *
     * @param \App\Menu $menu
     * @return void
     */
    public function restored(Menu $menu)
    {
        $this->fireCacheInvalidationEvent($menu);
    }

    /**
     * Handle the menu "force deleted" event.
     *
     * @param \App\Menu $menu
     *
     * @return void
     */
    public function forceDeleted(Menu $menu)
    {
        $this->fireCacheInvalidationEvent($menu);
    }

    /**
     * @param Menu $menu
     */
    private function fireCacheInvalidationEvent(Menu $menu)
    {
        event(CacheInvalidatedEvent::NAME_MENU_UPDATED, new CacheInvalidatedEvent($menu));
    }
}
