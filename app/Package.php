<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Package
 *
 * @property int $id
 * @property int $system_type_id
 * @property string $translation_key
 * @property array $module_ids
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Package active()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Package newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Package newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Package query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Package whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Package whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Package whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Package whereModuleIds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Package whereSystemTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Package whereTranslationKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Package whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Package extends Model
{
    public const ID_ALL_PROPERTIES = 1;

    public const CACHE_EXPIRATION_TIME = 60 * 15; // Second * Minute

    public const CACHE_KEY_ALL_ACTIVE_MODULES = 'package-modules';

    protected $table = 'packages';

    protected $casts = [
        'id'                => 'int',
        'system_type_id'    => 'int',
        'translation_key'   => 'string',
        'is_active'         => 'boolean',
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime',
    ];

    /**
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * @param array $value
     */
    public function setModuleIdsAttribute(array $value): void
    {
        $this->attributes['module_ids'] = json_encode($value);
    }

    /**
     * @param string $value
     *
     * @return array
     */
    public function getModuleIdsAttribute(string $value): array
    {
        return json_decode($value);
    }
}
