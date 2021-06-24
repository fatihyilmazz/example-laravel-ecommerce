<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\BasketProduct
 *
 * @property int $id
 * @property int $basket_id
 * @property int $product_id
 * @property float $quantity
 * @property string|null $transaction_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BasketProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BasketProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BasketProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BasketProduct whereBasketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BasketProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BasketProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BasketProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BasketProduct whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BasketProduct whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BasketProduct whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BasketProduct extends Model
{
    /**
     * @var string
     */
    protected $table = 'basket_products';
}
