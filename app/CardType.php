<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\CardType
 *
 * @property int $id
 * @property string $name
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CardType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CardType newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\CardType onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CardType query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CardType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CardType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CardType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CardType whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CardType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CardType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\CardType withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\CardType withoutTrashed()
 * @mixin \Eloquent
 */
class CardType extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'card_types';

    /**
     * @param string $value
     */
    public function setNameAttribute(string $value): void
    {
        $this->attributes['name'] = mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
    }
}
