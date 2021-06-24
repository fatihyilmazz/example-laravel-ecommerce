<?php

namespace App;

use App\Traits\Linkable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Locale
 *
 * @property int $id
 * @property string $code
 * @property string $english_name
 * @property string $native_name
 * @property string $script
 * @property string $regional
 * @property int|null $order
 * @property int $is_default_for_admin
 * @property int $is_default_for_customer
 * @property int $is_usable_for_users
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-write mixed $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Locale active()
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Locale newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Locale newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Locale onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Locale query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Locale usableForUsers()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Locale whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Locale whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Locale whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Locale whereEnglishName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Locale whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Locale whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Locale whereIsDefaultForAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Locale whereIsDefaultForCustomer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Locale whereIsUsableForUsers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Locale whereNativeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Locale whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Locale whereRegional($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Locale whereScript($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Locale whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Locale withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Locale withoutTrashed()
 * @mixin \Eloquent
 */
class Locale extends Model
{
    public const ID_TURKISH = 1;
    public const ID_ENGLISH = 2;

    use SoftDeletes, LogsActivity, Linkable;

    protected $table = 'locales';

    protected $guarded = ['is_active'];

    protected $casts = [
        'id'                        => 'int',
        'code'                      => 'string',
        'english_name'              => 'string',
        'native_name'               => 'string',
        'script'                    => 'string',
        'regional'                  => 'string',
        'order'                     => 'int',
        'is_default_for_admin'      => 'boolean',
        'is_default_for_customer'   => 'boolean',
        'is_usable_for_users'       => 'boolean',
        'is_active'                 => 'boolean',
        'created_at'                => 'datetime',
        'updated_at'                => 'datetime',
        'deleted_at'                => 'datetime',
    ];

    protected static $logName = '[Locale]';

    protected static $logAttributes = ['*'];

    protected static $recordEvents = ['created', 'updated', 'deleted'];

    protected static $logOnlyDirty = true;

    protected static $submitEmptyLogs = false;

    /**
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeUsableForUsers(Builder $query): Builder
    {
        return $query->where('is_usable_for_users', true);
    }

    /**
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * @param string $value
     */
    public function setNameAttribute(string $value): void
    {
        $this->attributes['name'] = mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
    }
}
