<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\StockUnitTranslation
 *
 * @property int $id
 * @property int $stock_unit_id
 * @property string $locale
 * @property string $name
 * @property-read \App\StockUnit $stockUnit
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StockUnitTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StockUnitTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StockUnitTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StockUnitTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StockUnitTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StockUnitTranslation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StockUnitTranslation whereStockUnitId($value)
 * @mixin \Eloquent
 */
class StockUnitTranslation extends Model
{
    protected $table = 'stock_unit_translations';

    protected $touches = ['stockUnit'];

    public $timestamps = false;

    protected $fillable = [
        'locale',
        'name',
    ];

    protected $casts = [
        'id' => 'int',
        'stock_unit_id' => 'int',
        'locale' => 'string',
        'name' => 'string',
    ];

    /**
     * @return BelongsTo
     */
    public function stockUnit(): BelongsTo
    {
        return $this->belongsTo(StockUnit::class);
    }

    /**
     * @param string $value
     */
    public function setNameAttribute(string $value): void
    {
        $this->attributes['name'] = mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
    }
}
