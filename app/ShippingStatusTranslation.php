<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ShippingStatusTranslation
 *
 * @property-read string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ShippingStatusTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ShippingStatusTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ShippingStatusTranslation query()
 * @mixin \Eloquent
 */
class ShippingStatusTranslation extends Model
{
    /**
     * @var string
     */
    protected $table = 'shipping_statues_translations';

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
