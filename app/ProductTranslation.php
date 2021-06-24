<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\ProductTranslation
 *
 * @property int $id
 * @property int $product_id
 * @property string $locale
 * @property string $name
 * @property string $slug
 * @property string|null $short_description
 * @property string|null $content
 * @property array|null $metas key | value
 * @property-read \App\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductTranslation whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductTranslation whereMetas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductTranslation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductTranslation whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductTranslation whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductTranslation whereSlug($value)
 * @mixin \Eloquent
 */
class ProductTranslation extends Model
{
    protected $table = 'product_translations';

    protected $touches = ['product'];

    protected $fillable = [
        'locale',
        'name',
        'slug',
        'short_description',
        'content',
        'metas',
    ];

    protected $casts = [
        'id'                => 'int',
        'product_id'        => 'int',
        'locale'            => 'string',
        'name'              => 'string',
        'slug'              => 'string',
        'short_description' => 'string',
        'content'           => 'string',
        'metas'             => 'array',
    ];

    public $timestamps = false;

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @param string $value
     */
    public function setNameAttribute(string $value): void
    {
        $this->attributes['name'] = mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
    }
}
