<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\CreditCardInstallment
 *
 * @property int $id
 * @property int $credit_card_id
 * @property float|null $min_price
 * @property float|null $max_price
 * @property int $installment
 * @property float|null $commission
 * @property int $gateway_id
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditCardInstallment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditCardInstallment newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\CreditCardInstallment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditCardInstallment query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditCardInstallment whereCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditCardInstallment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditCardInstallment whereCreditCardId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditCardInstallment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditCardInstallment whereGatewayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditCardInstallment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditCardInstallment whereInstallment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditCardInstallment whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditCardInstallment whereMaxPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditCardInstallment whereMinPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditCardInstallment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\CreditCardInstallment withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\CreditCardInstallment withoutTrashed()
 * @mixin \Eloquent
 */
class CreditCardInstallment extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'credit_card_installments';
}
