<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\ShippingCompany
 *
 * @property int $id
 * @property string $name
 * @property float|null $shipping_price
 * @property int|null $order
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ShippingCompany newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ShippingCompany newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\ShippingCompany onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ShippingCompany query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ShippingCompany whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ShippingCompany whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ShippingCompany whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ShippingCompany whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ShippingCompany whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ShippingCompany whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ShippingCompany whereShippingPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ShippingCompany whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ShippingCompany withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\ShippingCompany withoutTrashed()
 * @mixin \Eloquent
 */
class ShippingCompany extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'shipping_companies';

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
