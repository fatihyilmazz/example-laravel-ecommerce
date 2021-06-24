<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Basket
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Basket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Basket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Basket query()
 * @mixin \Eloquent
 */
class Basket extends Model
{
    /**
     * @var string
     */
    protected $table = 'basket';
}
