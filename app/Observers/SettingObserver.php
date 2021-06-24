<?php

namespace App\Observers;

use App\Events\CacheInvalidatedEvent;
use App\Setting;

class SettingObserver
{
    /**
     * Handle the setting "created" event.
     *
     * @param \App\Setting $setting
     * @return void
     */
    public function created(Setting $setting)
    {
        $this->fireCacheInvalidationEvent($setting);
    }

    /**
     * Handle the setting "updated" event.
     *
     * @param \App\Setting $setting
     * @return void
     */
    public function updated(Setting $setting)
    {
        $this->fireCacheInvalidationEvent($setting);
    }

    /**
     * Handle the setting "deleted" event.
     *
     * @param \App\Setting $setting
     * @return void
     */
    public function deleted(Setting $setting)
    {
        $this->fireCacheInvalidationEvent($setting);
    }

    /**
     * Handle the setting "restored" event.
     *
     * @param \App\Setting $setting
     * @return void
     */
    public function restored(Setting $setting)
    {
        $this->fireCacheInvalidationEvent($setting);
    }

    /**
     * Handle the setting "force deleted" event.
     *
     * @param \App\Setting $setting
     * @return void
     */
    public function forceDeleted(Setting $setting)
    {
        $this->fireCacheInvalidationEvent($setting);
    }

    /**
     * @param Setting $setting
     */
    private function fireCacheInvalidationEvent(Setting $setting)
    {
        event(CacheInvalidatedEvent::NAME_SETTING_UPDATED, new CacheInvalidatedEvent($setting));
    }
}
