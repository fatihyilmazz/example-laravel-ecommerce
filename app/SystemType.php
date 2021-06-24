<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\SystemType
 *
 * @property int $id
 * @property string $name
 * @property int $is_active
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SystemType active()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SystemType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SystemType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SystemType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SystemType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SystemType whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SystemType whereName($value)
 * @mixin \Eloquent
 */
class SystemType extends Model
{
    public const ID_ECOMMERCE  = 1;
    public const ID_CORPORATE  = 2;
    public const ID_NEWS       = 3;
    public const ID_PROPERTY   = 4;
    public const ID_CAR        = 5;

    protected $table = 'system_types';

    public $timestamps = false;

    protected $casts = [
        'id' => 'int',
        'name' => 'string',
        'is_active' => 'boolean',
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
}
