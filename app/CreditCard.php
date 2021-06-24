<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\CreditCard
 *
 * @property int $id
 * @property string $bin_number
 * @property int $type_id
 * @property int $association_id
 * @property int $bank_id
 * @property int $family_id
 * @property int $is_commercial
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditCard newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditCard newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\CreditCard onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditCard query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditCard whereAssociationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditCard whereBankId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditCard whereBinNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditCard whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditCard whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditCard whereFamilyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditCard whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditCard whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditCard whereIsCommercial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditCard whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditCard whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\CreditCard withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\CreditCard withoutTrashed()
 * @mixin \Eloquent
 */
class CreditCard extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'credit_cards';
}
