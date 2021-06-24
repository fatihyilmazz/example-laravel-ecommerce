<?php

namespace App;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

/**
 * App\PaymentType
 *
 * @property int $id
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\PaymentTypeTranslation $translation
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\PaymentTypeTranslation[] $translations
 * @property-read int|null $translations_count
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentType listsTranslations($translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentType notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\PaymentType onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentType orWhereTranslation($translationField, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentType orWhereTranslationLike($translationField, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentType orderByTranslation($translationField, $sortMethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentType query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentType translated()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentType translatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentType whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentType whereTranslation($translationField, $value, $locale = null, $method = 'whereHas', $operator = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentType whereTranslationLike($translationField, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentType withTranslation()
 * @method static \Illuminate\Database\Query\Builder|\App\PaymentType withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\PaymentType withoutTrashed()
 * @mixin \Eloquent
 */
class PaymentType extends Model implements TranslatableContract
{
    use SoftDeletes, Translatable;

    /**
     * @var string
     */
    protected $table = 'payment_types';

    /**
     * @var array
     */
    public $translatedAttributes = ['name'];
}
