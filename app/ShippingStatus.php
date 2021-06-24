<?php

namespace App;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

/**
 * App\ShippingStatus
 *
 * @property-read string $name
 * @property-read \App\ShippingStatusTranslation $translation
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ShippingStatusTranslation[] $translations
 * @property-read int|null $translations_count
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ShippingStatus listsTranslations($translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ShippingStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ShippingStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ShippingStatus notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\ShippingStatus onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ShippingStatus orWhereTranslation($translationField, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ShippingStatus orWhereTranslationLike($translationField, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ShippingStatus orderByTranslation($translationField, $sortMethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ShippingStatus query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ShippingStatus translated()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ShippingStatus translatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ShippingStatus whereTranslation($translationField, $value, $locale = null, $method = 'whereHas', $operator = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ShippingStatus whereTranslationLike($translationField, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ShippingStatus withTranslation()
 * @method static \Illuminate\Database\Query\Builder|\App\ShippingStatus withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\ShippingStatus withoutTrashed()
 * @mixin \Eloquent
 */
class ShippingStatus extends Model implements TranslatableContract
{
    use SoftDeletes, Translatable;

    /**
     * @var string
     */
    protected $table = 'shipping_statues';

    /**
     * @var array
     */
    public $translatedAttributes = ['name'];
}
