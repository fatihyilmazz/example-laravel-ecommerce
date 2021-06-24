<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PaymentStatusTranslation
 *
 * @property int $id
 * @property int $payment_status_id
 * @property string $locale
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentStatusTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentStatusTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentStatusTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentStatusTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentStatusTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentStatusTranslation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentStatusTranslation wherePaymentStatusId($value)
 * @mixin \Eloquent
 */
class PaymentStatusTranslation extends Model
{
    /**
     * @var string
     */
    protected $table = 'payment_status_translations';

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
