<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\CardFamily
 *
 * @property int $id
 * @property string $name
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CardFamily newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CardFamily newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\CardFamily onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CardFamily query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CardFamily whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CardFamily whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CardFamily whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CardFamily whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CardFamily whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CardFamily whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\CardFamily withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\CardFamily withoutTrashed()
 * @mixin \Eloquent
 */
class CardFamily extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'card_families';

    /**
     * @param string $value
     */
    public function setNameAttribute(string $value): void
    {
        $this->attributes['name'] = mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
    }
}
