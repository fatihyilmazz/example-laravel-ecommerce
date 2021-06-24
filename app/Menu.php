<?php

namespace App;

use App\Observers\MenuObserver;
use App\Traits\Linkable;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Menu
 *
 * @property int $id
 * @property int $menu_group_id
 * @property int|null $parent_id
 * @property int|null $order
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\MenuGroup $menuGroup
 * @property-read \App\Menu|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Menu[] $subMenus
 * @property-read int|null $sub_menus_count
 * @property-read \App\MenuTranslation $translationForCurrentLocale
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\MenuTranslation[] $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Menu active()
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Menu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Menu newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Menu onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Menu query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Menu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Menu whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Menu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Menu whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Menu whereMenuGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Menu whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Menu whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Menu whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Menu withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Menu withoutTrashed()
 * @mixin \Eloquent
 * @property int $menu_type_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Menu whereMenuTypeId($value)
 * @property int|null $page_id
 * @property string|null $external_link
 * @property int|null $main_category_id
 * @property array $category_ids
 * @property array $brand_ids
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Menu whereBrandIds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Menu whereCategoryIds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Menu whereExternalLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Menu whereMainCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Menu wherePageId($value)
 * @property array $value
 * @property int|null $row
 * @property-read \App\MenuType|null $menuType
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Menu whereRow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Menu whereValue($value)
 */
class Menu extends Model
{
    use SoftDeletes, Linkable, Translatable;

    public const CACHE_EXPIRATION_TIME          = 60 * 15; // Second * Minute
    public const CACHE_KEY_HEADER_MENU_LOCALE   = 'header_menu-';
    public const CACHE_KEY_FOOTER_MENU          = 'footer_menu';

    protected $table = 'menus';

    protected $with = ['translationForCurrentLocale:menu_id,name'];

    protected $fillable = [
        'menu_group_id',
        'parent_id',
        'menu_type_id',
        'value',
        'row',
        'is_active',
    ];

    protected $casts = [
        'menu_group_id' => 'int',
        'parent_id'     => 'int',
        'menu_type_id'  => 'int',
        'row'           => 'int',
        'is_active'     => 'boolean',
    ];

    //public $translatedAttributes = ['name', 'slug'];

    protected static $logName = '[Menu]';

    protected static $logAttributes = ['menu_group_id', 'parent_id', 'order', 'is_active'];

    protected static $recordEvents = ['created', 'updated', 'deleted'];

    protected static $logOnlyDirty = true;

    protected static $submitEmptyLogs = false;

    protected static function booted()
    {
        parent::booted();
        self::observe(MenuObserver::class);
    }

    /**
     * @return BelongsTo
     */
    public function menuGroup(): BelongsTo
    {
        return $this->belongsTo(MenuGroup::class);
    }

    /**
     * @return BelongsTo
     */
    public function menuType(): BelongsTo
    {
        return $this->belongsTo(MenuType::class);
    }

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    /**
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', '=', true);
    }

    /**
     * @return HasMany
     */
    public function subMenus(): HasMany
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }

    /**
     * @param mixed $value
     */
    public function setValueAttribute($value): void
    {
        if (is_array($value)) {
            $this->attributes['value'] = json_encode($value);
        } else {
            $this->attributes['value'] = json_encode([$value]);
        }
    }

    /**
     * @param mixed $value
     *
     * @return array
     */
    public function getValueAttribute($value): ?array
    {
        return json_decode($value);
    }
}
