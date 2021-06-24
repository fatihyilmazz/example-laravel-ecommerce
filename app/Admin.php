<?php

namespace App;

use App\Traits\Linkable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

/**
 * App\Admin
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string|null $phone_number
 * @property string $password
 * @property int $is_active
 * @property int|null $is_sms_allowed
 * @property int|null $is_mail_allowed
 * @property \Illuminate\Support\Carbon|null $last_login_at
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Admin onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereIsMailAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereIsSmsAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereLastLoginAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Admin withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Admin withoutTrashed()
 * @mixin \Eloquent
 * @property-read string $full_name
 */
class Admin extends Authenticatable
{
    use Notifiable, HasRoles, SoftDeletes, Linkable;

    public const ID_SYSTEM_USER        = 1;
    public const ID_SUPER_ADMIN_USER   = 2;
    public const ID_ADMIN_USER         = 3;

    public const ROLE_NAME_ADMIN       = 'admin';
    public const ROLE_NAME_SUPER_ADMIN = 'super-admin';

    protected $table = 'admins';

    protected $guard = 'admin';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'password',
        'is_active',
        'is_sms_allowed',
        'is_mail_allowed',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'id'                => 'int',
        'first_name'        => 'string',
        'last_name'         => 'string',
        'email'             => 'string',
        'phone_number'      => 'string',
        'is_active'         => 'boolean',
        'is_sms_allowed'    => 'boolean',
        'is_mail_allowed'   => 'boolean',
        'last_login_at'     => 'datetime',
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime',
        'deleted_at'        => 'datetime',
    ];

    protected $dates = [
        'last_login_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * @param string $value
     */
    public function setFirstNameAttribute(string $value): void
    {
        $this->attributes['first_name'] = mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
    }

    /**
     * @param string $value
     */
    public function setLastNameAttribute(string $value): void
    {
        $this->attributes['last_name'] = mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
    }
}
