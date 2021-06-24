<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait Translatable
{
    /**
     * @return string
     */
    public function getTableName(): string
    {
        return 'App\\'. class_basename($this).'Translation';
    }

    /**
     * @return HasMany
     */
    public function translations(): HasMany
    {
        return $this->hasMany($this->getTableName());
    }

    /**
     * @return HasOne
     */
    public function translationForCurrentLocale(): HasOne
    {
        return $this->hasOne($this->getTableName())->where('locale', app()->getLocale());
    }
}
