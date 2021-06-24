<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\UserAddresses
 *
 * @property int $id
 * @property int $user_id
 * @property int $country_id
 * @property int $province_id
 * @property int $district_id
 * @property string $title
 * @property string $first_name
 * @property string $last_name
 * @property string|null $company_name
 * @property string $address
 * @property string $phone_number
 * @property string $zip_code
 * @property string|null $tax_office
 * @property string $tax_number
 * @property int|null $is_billing_address
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read string $full_name
 * @property-read \App\User $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserAddress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserAddress newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\UserAddress onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserAddress query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserAddress whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserAddress whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserAddress whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserAddress whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserAddress whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserAddress whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserAddress whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserAddress whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserAddress whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserAddress whereIsBillingAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserAddress whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserAddress wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserAddress whereProvinceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserAddress whereTaxNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserAddress whereTaxOffice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserAddress whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserAddress whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserAddress whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserAddress whereZipCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserAddress withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\UserAddress withoutTrashed()
 * @mixin \Eloquent
 */
class UserAddress extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'user_addresses';

    protected $casts = [
        'id'                    => 'int',
        'user_id'               => 'int',
        'country_id'            => 'int',
        'province_id'           => 'int',
        'district_id'           => 'int',
        'title'                 => 'string',
        'first_name'            => 'string',
        'last_name'             => 'string',
        'company_name'          => 'string',
        'address'               => 'string',
        'phone_number'          => 'string',
        'zip_code'              => 'string',
        'tax_office'            => 'string',
        'tax_number'            => 'string',
        'is_billing_address'    => 'boolean',
        'is_active'             => 'boolean',
        'created_at'            => 'datetime',
        'updated_at'            => 'datetime',
        'deleted_at'            => 'datetime',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param string $value
     *
     * @return string
     */
    public function getTitleAttribute(string $value): string
    {
        return mb_convert_case($value, MB_CASE_TITLE, "UTF_8");
    }

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

    /**
     * @param string $value
     */
    public function setAddressAttribute(string $value): void
    {
        $this->attributes['address'] = mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
    }

    /**
     * @param string $value
     */
    public function setTaxOfficeAttribute(string $value): void
    {
        $this->attributes['tax_office'] = mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
    }

    /**
     * @param string $value
     */
    public function setCompanyNameAttribute(string $value): void
    {
        $this->attributes['company_name'] = mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
    }
}
