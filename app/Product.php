<?php

namespace App;

use App\Traits\Linkable;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Product
 *
 * @property int $id
 * @property int $brand_id
 * @property int $currency_id
 * @property int $tax_rate_id
 * @property int $is_tax_included
 * @property float $selling_price
 * @property string|null $sku Stock Keeping Unit
 * @property string|null $gtin Global Trade Item Number
 * @property string|null $upc Universal Product Code
 * @property string|null $ean European Article Number
 * @property string|null $jan Japan Article Number
 * @property string|null $isbn International Standard Book Number
 * @property string|null $itf_14 Interleaved 2 of 5
 * @property string|null $mpn Manufacturer Part Number
 * @property string|null $oem Original Equipment Manufacturer
 * @property string|null $non_oem non-Original Equipment Manufacturer
 * @property int|null $order
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Category[] $categories
 * @property-read int|null $categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Category[] $categoryIds
 * @property-read int|null $category_ids_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Media[] $medias
 * @property-read int|null $medias_count
 * @property-read \App\ProductTranslation $translationForCurrentLocale
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ProductTranslation[] $translations
 * @property-read int|null $translations_count
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Product onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereEan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereGtin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereIsTaxIncluded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereIsbn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereItf14($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereJan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereMpn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereNonOem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereOem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereSellingPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereTaxRateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereUpc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Product withoutTrashed()
 * @mixin \Eloquent
 * @property array $metas
 * @property int|null $row
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereRow($value)
 * @property-read \App\Brand $brand
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Media[] $files
 * @property-read int|null $files_count
 * @property-read \Category $main_category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Media[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Category[] $mainCategory
 * @property-read int|null $main_category_count
 */
class Product extends Model
{
    use SoftDeletes, Translatable, Linkable;

    protected $table = 'products';

    protected $fillable = [
        'brand_id',
        'currency_id',
        'tax_rate_id',
        'is_tax_included',
        'selling_price',
        'list_price',
        'cost_price',
        'weight',
        'width',
        'length',
        'height',
        'min_selling_quantity',
        'max_selling_quantity',
        'supplier_id',
        'sku',
        'gtin',
        'upc',
        'ean',
        'jan',
        'isbn',
        'itf_14',
        'mpn',
        'oem',
        'non_oem',
        'row',
        'is_active',
    ];

    protected $casts = [
        'id' => 'int',
        'brand_id' => 'int',
        'currency_id' => 'int',
        'tax_rate_id' => 'int',
        'is_tax_included' => 'boolean',
        'selling_price' => 'float',
        'list_price' => 'float',
        'cost_price' => 'float',
        'weight' => 'float',
        'width' => 'float',
        'length' => 'float',
        'height' => 'float',
        'min_selling_quantity' => 'float',
        'max_selling_quantity' => 'float',
        'supplier_id' => 'int',
        'sku' => 'string',
        'gtin' => 'string',
        'upc' => 'string',
        'ean' => 'string',
        'jan' => 'string',
        'isbn' => 'string',
        'itf_14' => 'string',
        'mpn' => 'string',
        'oem' => 'string',
        'non_oem' => 'string',
        'row' => 'string',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * @return BelongsTo
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'product_categories')
            ->as('product_categories')
            ->withPivot('is_main')
            ->withTimestamps();
    }

    /**
     * @return BelongsToMany
     */
    public function mainCategory(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'product_categories')
            ->as('main_categories')
            ->wherePivot('is_main', '=', true);
    }

    /**
     * @return Category
     */
    public function getMainCategoryAttribute(): Category
    {
        return $this->mainCategory()->first();
    }

    /**
     * @return MorphMany
     */
    public function images(): MorphMany
    {
        return $this->morphMany(Media::class, 'model')
            ->where('media_type', '=', Media::TYPE_ID_IMAGE)
            ->orderBy('order');
    }

    /**
     * @return MorphMany
     */
    public function files(): MorphMany
    {
        return $this->morphMany(Media::class, 'model')
            ->where('media_type', '=', Media::TYPE_ID_FILE)
            ->orderBy('order');
    }

    /**
     * @return BelongsToMany
     */
    public function categoryIds(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'product_categories')->select('category_id', 'is_main');
    }

    /**
     * @param array $value
     */
    public function setMetasAttribute(array $value): void
    {
        $this->attributes['metas'] = json_encode($value);
    }

    /**
     * @param string $value
     *
     * @return array
     */
    public function getMetasAttribute(string $value): array
    {
        return json_decode($value);
    }
}
