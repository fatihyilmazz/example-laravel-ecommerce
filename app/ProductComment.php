<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\ProductComment
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property string $locale
 * @property int $score
 * @property string|null $comment
 * @property int|null $is_approved
 * @property \Illuminate\Support\Carbon|null $processed_at
 * @property int|null $processed_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductComment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductComment newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\ProductComment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductComment query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductComment whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductComment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductComment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductComment whereIsApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductComment whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductComment whereProcessedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductComment whereProcessedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductComment whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductComment whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductComment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductComment whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductComment withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\ProductComment withoutTrashed()
 * @mixin \Eloquent
 */
class ProductComment extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'product_comments';

    /**
     * @var array
     */
    protected $dates = [
        'processed_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
