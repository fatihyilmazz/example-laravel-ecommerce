<?php

namespace App;

use App\Traits\Linkable;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Country
 *
 * @property int $id
 * @property int|null $order
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\CountryTranslation $translationForCurrentLocale
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\CountryTranslation[] $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Country active()
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Country newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Country onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Country query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Country whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Country whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Country whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Country whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Country whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Country whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Country withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Country withoutTrashed()
 * @mixin \Eloquent
 */
class Country extends Model
{
    use SoftDeletes, Linkable, Translatable;

    public const ID_TURKEY = 1;

    protected $table = 'countries';

    protected $fillable = [
        'iso_code',
        'order',
        'is_active'
    ];

    protected $casts = [
        'id'            => 'int',
        'order'         => 'int',
        'is_active'     => 'boolean',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];

    protected $with = ['translationForCurrentLocale:country_id,name'];

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
