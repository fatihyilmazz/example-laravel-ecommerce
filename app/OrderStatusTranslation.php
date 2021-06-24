<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\OrderStatusTranslation
 *
 * @property int $id
 * @property int $order_status_id
 * @property string $locale
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderStatusTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderStatusTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderStatusTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderStatusTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderStatusTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderStatusTranslation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderStatusTranslation whereOrderStatusId($value)
 * @mixin \Eloquent
 */
class OrderStatusTranslation extends Model
{
    /**
     * @var string
     */
    protected $table = 'order_status_translations';

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
