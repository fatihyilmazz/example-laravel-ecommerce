<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\CardBank
 *
 * @property int $id
 * @property string $name
 * @property string $bank_code
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CardBank newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CardBank newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\CardBank onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CardBank query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CardBank whereBankCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CardBank whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CardBank whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CardBank whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CardBank whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CardBank whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CardBank whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\CardBank withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\CardBank withoutTrashed()
 * @mixin \Eloquent
 */
class CardBank extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'card_banks';

    /**
     * @param string $value
     */
    public function setNameAttribute(string $value): void
    {
        $this->attributes['name'] = mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
    }
}
