<?php

namespace App;

use App\Traits\Linkable;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\StockUnit
 *
 * @property int $id
 * @property int|null $parent_id
 * @property float|null $coefficient
 * @property string|null $code
 * @property string|null $universal_code
 * @property int|null $order
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\StockUnit|null $parent
 * @property-read \App\StockUnitTranslation $translationForCurrentLocale
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\StockUnitTranslation[] $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StockUnit active()
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StockUnit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StockUnit newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\StockUnit onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StockUnit query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StockUnit whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StockUnit whereCoefficient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StockUnit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StockUnit whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StockUnit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StockUnit whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StockUnit whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StockUnit whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StockUnit whereUniversalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StockUnit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\StockUnit withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\StockUnit withoutTrashed()
 * @mixin \Eloquent
 */
class StockUnit extends Model
{
    use SoftDeletes, Translatable, Linkable;

    protected $table = 'stock_units';

    protected $with = ['translationForCurrentLocale:stock_unit_id,name'];

    protected $fillable = [
        'parent_id',
        'coefficient',
        'code',
        'universal_code',
        'order',
        'is_active',
    ];

    protected $casts = [
        'id'                => 'int',
        'parent_id'         => 'int',
        'coefficient'       => 'float',
        'universal_code'    => 'string',
        'order'             => 'int',
        'is_active'         => 'boolean',
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime',
        'deleted_at'        => 'datetime',
    ];

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(StockUnit::class);
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
