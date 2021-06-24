<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PaymentTypeTranslation
 *
 * @property int $id
 * @property int $payment_type_id
 * @property string $locale
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentTypeTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentTypeTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentTypeTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentTypeTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentTypeTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentTypeTranslation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentTypeTranslation wherePaymentTypeId($value)
 * @mixin \Eloquent
 */
class PaymentTypeTranslation extends Model
{
    /**
     * @var string
     */
    protected $table = 'payment_type_translations';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @param string $value
     *
     * @return string
     */
    public function getNameAttribute(string $value): string
    {
        return mb_convert_case($value, MB_CASE_TITLE, "UTF_8");
    }
}
