<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Module
 *
 * @property int $id
 * @property string $translation_key
 * @property int|null $parent_id
 * @property mixed $usable_system_type_ids
 * @property int $is_active
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Module active()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Module newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Module newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Module query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Module whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Module whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Module whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Module whereTranslationKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Module whereUsableSystemTypeIds($value)
 * @mixin \Eloquent
 */
class Module extends Model
{
    public const ID_LOCALE_MANAGEMENT      = 1;

    public const ID_CONTENT_MANAGEMENT     = 2;
    public const ID_MENU_MANAGEMENT        = 3;
    public const ID_SLIDER_MANAGEMENT      = 4;
    public const ID_PAGE_MANAGEMENT        = 5;

    public const ID_PRODUCT_MANAGEMENT     = 6;
    public const ID_BRAND_MANAGEMENT       = 7;
    public const ID_CATEGORY_MANAGEMENT    = 8;
    public const ID_TAX_RATE_MANAGEMENT    = 9;
    public const ID_CURRENCY_MANAGEMENT    = 10;

    public const ID_USER_MANAGEMENT        = 11;
    public const ID_CUSTOMER_MANAGEMENT    = 12;
    public const ID_ADMIN_MANAGEMENT       = 13;
    public const ID_ROLE_MANAGEMENT        = 14;

    protected $table = 'modules';
    public $timestamps = false;

    protected $casts = [
        'id'                        => 'int',
        'translation_key'           => 'string',
        'parent_id'                 => 'int',
        'usable_system_type_ids'    => 'array',
        'is_active'                 => 'boolean'
    ];

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
