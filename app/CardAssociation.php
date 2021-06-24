<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\CardAssociation
 *
 * @property int $id
 * @property string $name
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CardAssociation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CardAssociation newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\CardAssociation onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CardAssociation query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CardAssociation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CardAssociation whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CardAssociation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CardAssociation whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CardAssociation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CardAssociation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\CardAssociation withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\CardAssociation withoutTrashed()
 * @mixin \Eloquent
 */
class CardAssociation extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'card_associations';

    /**
     * @param string $value
     */
    public function setNameAttribute(string $value): void
    {
        $this->attributes['name'] = mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
    }
}
