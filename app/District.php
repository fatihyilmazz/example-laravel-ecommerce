<?php

namespace App;

use App\Traits\Linkable;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\District
 *
 * @property int $id
 * @property int $province_id
 * @property int|null $order
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Province $province
 * @property-read \App\DistrictTranslation $translationForCurrentLocale
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\DistrictTranslation[] $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\District active()
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\District newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\District newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\District onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\District query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\District whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\District whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\District whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\District whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\District whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\District whereProvinceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\District whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\District withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\District withoutTrashed()
 * @mixin \Eloquent
 */
class District extends Model
{
    use SoftDeletes, Linkable, Translatable;

    protected $table = 'districts';

    protected $with = ['translationForCurrentLocale:district_id,name'];

    protected $fillable = [
        'province_id',
        'order',
        'is_active',
    ];

    protected $casts = [
        'id'            => 'int',
        'province_id'   => 'int',
        'order'         => 'int',
        'is_active'     => 'boolean',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];

    /**
     * @return BelongsTo
     */
    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
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
