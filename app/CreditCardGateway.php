<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\CreditCardGateway
 *
 * @property int $id
 * @property string $name
 * @property mixed $credentials
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditCardGateway newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditCardGateway newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\CreditCardGateway onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditCardGateway query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditCardGateway whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditCardGateway whereCredentials($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditCardGateway whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditCardGateway whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditCardGateway whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditCardGateway whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditCardGateway whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\CreditCardGateway withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\CreditCardGateway withoutTrashed()
 * @mixin \Eloquent
 */
class CreditCardGateway extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'credit_card_gateways';

    /**
     * @param string $value
     */
    public function setNameAttribute(string $value): void
    {
        $this->attributes['name'] = mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
    }
}
