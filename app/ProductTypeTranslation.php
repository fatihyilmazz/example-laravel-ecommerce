<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\ProductTypeTranslation
 *
 * @property int $id
 * @property int $product_type_id
 * @property string $locale
 * @property string $name
 * @property-read \App\ProductType $productType
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductTypeTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductTypeTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductTypeTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductTypeTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductTypeTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductTypeTranslation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductTypeTranslation whereProductTypeId($value)
 * @mixin \Eloquent
 */
class ProductTypeTranslation extends Model
{
    protected $table = 'product_type_translations';

    protected $touches = ['productType'];

    protected $fillable = ['name'];

    public $timestamps = false;

    /**
     * @return BelongsTo
     */
    public function productType(): BelongsTo
    {
        return $this->belongsTo(ProductType::class);
    }

    /**
     * @param string $value
     */
    public function setNameAttribute(string $value): void
    {
        $this->attributes['name'] = mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
    }
}
