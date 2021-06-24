<?php

namespace App;

use App\Traits\Linkable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\MenuGroup
 *
 * @property int $id
 * @property string $name
 * @property int|null $order
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuGroup active()
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuGroup newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\MenuGroup onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuGroup query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuGroup whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuGroup whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuGroup whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuGroup whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MenuGroup withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\MenuGroup withoutTrashed()
 * @mixin \Eloquent
 */
class MenuGroup extends Model
{
    use SoftDeletes, LogsActivity, Linkable;

    public const ID_HEADER = 1;
    public const ID_FOOTER = 2;

    /**
     * @var string
     */
    protected $table = 'menu_groups';

    protected $guarded = [];

    protected $casts = [
        'id'            => 'int',
        'name'          => 'string',
        'order'         => 'int',
        'is_active'     => 'boolean',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];

    protected static $logName = '[MenuGroup]';

    protected static $logAttributes = ['name', 'order', 'is_active'];

    protected static $recordEvents = ['created', 'updated', 'deleted'];

    protected static $logOnlyDirty = true;

    protected static $submitEmptyLogs = false;

    /**
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
