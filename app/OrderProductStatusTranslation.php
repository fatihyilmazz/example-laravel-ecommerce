<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\OrderProductStatusTranslation
 *
 * @property int $id
 * @property int $status_id
 * @property string $locale
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderProductStatusTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderProductStatusTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderProductStatusTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderProductStatusTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderProductStatusTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderProductStatusTranslation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderProductStatusTranslation whereStatusId($value)
 * @mixin \Eloquent
 */
class OrderProductStatusTranslation extends Model
{
    /**
     * @var string
     */
    protected $table = 'order_product_status_translations';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['name'];
}
