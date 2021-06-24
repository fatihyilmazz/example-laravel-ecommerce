<?php

namespace App;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\ProductType
 *
 * @property int $id
 * @property int|null $is_active
 * @property-read \App\ProductTypeTranslation $translationForCurrentLocale
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ProductTypeTranslation[] $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductType active()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductType whereIsActive($value)
 * @mixin \Eloquent
 */
class ProductType extends Model
{
    use Translatable;

    public const ID_BASIC = 1;

    protected $table = 'product_types';

    protected $with = ['translationForCurrentLocale:product_type_id,name'];

    public $timestamps = false;

    ///**
    // * @return HasMany
    // */
    //public function products():HasMany
    //{
    //    return $this->hasMany(Product::class);
    //}

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
