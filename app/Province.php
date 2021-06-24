<?php

namespace App;

use App\Traits\Linkable;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Province
 *
 * @property int $id
 * @property int $country_id
 * @property int|null $order
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Country $country
 * @property-read \App\ProvinceTranslation $translationForCurrentLocale
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ProvinceTranslation[] $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Province active()
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Province newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Province newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Province onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Province query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Province whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Province whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Province whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Province whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Province whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Province whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Province whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Province withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Province withoutTrashed()
 * @mixin \Eloquent
 */
class Province extends Model
{
    use SoftDeletes, Linkable, Translatable;

    protected $table = 'provinces';

    protected $fillable = [
        'country_id',
        'order',
        'is_active',
    ];

    protected $with = ['translationForCurrentLocale:province_id,name'];

    protected $casts = [
        'id'            => 'int',
        'country_id'    => 'int',
        'order'         => 'int',
        'is_active'     => 'boolean',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];

    /**
     * @return BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

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
