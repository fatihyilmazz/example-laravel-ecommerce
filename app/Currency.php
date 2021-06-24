<?php

namespace App;

use App\Traits\Linkable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Currency
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string $symbol
 * @property int $use_constant
 * @property float|null $constant_price
 * @property int|null $order
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency active()
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Currency onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency whereConstantPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency whereSymbol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency whereUseConstant($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Currency withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Currency withoutTrashed()
 * @mixin \Eloquent
 */
class Currency extends Model
{
    use SoftDeletes, Linkable;

    public const ID_TL  = 1;
    public const ID_USD = 2;
    public const ID_EUR = 3;

    protected $table = 'currencies';

    protected $fillable = [
        'name',
        'code',
        'symbol',
        'use_constant',
        'constant_price',
        'order',
        'is_active',
    ];

    protected $casts = [
        'id'                => 'int',
        'name'              => 'string',
        'code'              => 'string',
        'symbol'            => 'string',
        'use_constant'      => 'boolean',
        'constant_price'    => 'float',
        'order'             => 'int',
        'is_active'         => 'boolean',
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime',
        'deleted_at'        => 'datetime',
    ];

    /**
     * @param string $value
     */
    public function setNameAttribute(string $value): void
    {
        $this->attributes['name'] = mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
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
