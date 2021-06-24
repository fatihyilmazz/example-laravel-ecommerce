<?php

namespace App;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

/**
 * App\PaymentStatus
 *
 * @property-read \App\PaymentStatusTranslation $translation
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\PaymentStatusTranslation[] $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentStatus listsTranslations($translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentStatus notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentStatus orWhereTranslation($translationField, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentStatus orWhereTranslationLike($translationField, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentStatus orderByTranslation($translationField, $sortMethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentStatus translated()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentStatus translatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentStatus whereTranslation($translationField, $value, $locale = null, $method = 'whereHas', $operator = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentStatus whereTranslationLike($translationField, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentStatus withTranslation()
 * @mixin \Eloquent
 */
class PaymentStatus extends Model implements TranslatableContract
{
    use Translatable;

    /**
     * @var string
     */
    protected $table = 'payment_statues';

    /**
     * @var array
     */
    public $translatedAttributes = ['name'];
}
