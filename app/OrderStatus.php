<?php

namespace App;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

/**
 * App\OrderStatus
 *
 * @property-read \App\OrderStatusTranslation $translation
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\OrderStatusTranslation[] $translations
 * @property-read int|null $translations_count
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderStatus listsTranslations($translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderStatus notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderStatus onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderStatus orWhereTranslation($translationField, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderStatus orWhereTranslationLike($translationField, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderStatus orderByTranslation($translationField, $sortMethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderStatus query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderStatus translated()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderStatus translatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderStatus whereTranslation($translationField, $value, $locale = null, $method = 'whereHas', $operator = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderStatus whereTranslationLike($translationField, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderStatus withTranslation()
 * @method static \Illuminate\Database\Query\Builder|\App\OrderStatus withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\OrderStatus withoutTrashed()
 * @mixin \Eloquent
 */
class OrderStatus extends Model implements TranslatableContract
{
    use SoftDeletes, Translatable;

    /**
     * @var string
     */
    protected $table = 'order_statues';

    /**
     * @var array
     */
    public $translatedAttributes = ['name'];
}
