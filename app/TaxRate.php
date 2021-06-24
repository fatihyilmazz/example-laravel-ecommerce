<?php

namespace App;

use App\Traits\Linkable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\TaxRate
 *
 * @property int $id
 * @property string $name
 * @property float $rate
 * @property int|null $order
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TaxRate active()
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TaxRate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TaxRate newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\TaxRate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TaxRate query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TaxRate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TaxRate whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TaxRate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TaxRate whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TaxRate whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TaxRate whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TaxRate whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TaxRate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TaxRate withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\TaxRate withoutTrashed()
 * @mixin \Eloquent
 */
class TaxRate extends Model
{
    use SoftDeletes, Linkable;

    public const ID_EIGHTEEN_PERCENT    = 1;
    public const ID_EIGHT_PERCENT       = 2;
    public const ID_ONE_PERCENT         = 3;

    protected $table = 'tax_rates';

    protected $fillable = [
        'name',
        'rate',
        'order',
        'is_active',
    ];

    protected $casts = [
        'id' => 'int',
        'name' => 'rate',
        'order' => 'int',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
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
