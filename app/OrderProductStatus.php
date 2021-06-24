<?php

namespace App;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

/**
 * App\OrderProductStatus
 *
 * @property-read \App\OrderProductStatusTranslation $translation
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\OrderProductStatusTranslation[] $translations
 * @property-read int|null $translations_count
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderProductStatus listsTranslations($translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderProductStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderProductStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderProductStatus notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderProductStatus onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderProductStatus orWhereTranslation($translationField, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderProductStatus orWhereTranslationLike($translationField, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderProductStatus orderByTranslation($translationField, $sortMethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderProductStatus query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderProductStatus translated()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderProductStatus translatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderProductStatus whereTranslation($translationField, $value, $locale = null, $method = 'whereHas', $operator = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderProductStatus whereTranslationLike($translationField, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderProductStatus withTranslation()
 * @method static \Illuminate\Database\Query\Builder|\App\OrderProductStatus withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\OrderProductStatus withoutTrashed()
 * @mixin \Eloquent
 */
class OrderProductStatus extends Model implements TranslatableContract
{
    use SoftDeletes, Translatable;

    /**
     * @var string
     */
    protected $table = 'order_product_statues';

    /**
     * @var array
     */
    public $translatedAttributes = ['name'];
}
