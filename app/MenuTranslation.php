<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\MenuLocalization
 *
 * @property int $id
 * @property int $menu_id
 * @property string $locale
 * @property string $name
 * @property string $slug
 * @property-read \App\Menu $menu
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuTranslation whereMenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuTranslation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuTranslation whereSlug($value)
 * @mixin \Eloquent
 */
class MenuTranslation extends Model
{
    protected $table = 'menu_translations';

    protected $touches = ['menu'];

    public $timestamps = false;

    protected $fillable = [
        'locale',
        'name',
        'slug',
    ];

    protected $casts = [
        'id'        => 'int',
        'menu_id'   => 'int',
        'locale'    => 'string',
        'name'      => 'string',
        'slug'      => 'string',
    ];

    //protected static $logName = '[Menu]';
//
    //protected static $logAttributes = ['name', 'slug'];
//
    //protected static $recordEvents = ['created', 'updated', 'deleted'];
//
    //protected static $logOnlyDirty = true;
//
    //protected static $submitEmptyLogs = false;

    /**
     * @return BelongsTo
     */
    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    /**
     * @param string $value
     */
    public function setNameAttribute(string $value): void
    {
        $this->attributes['name'] = mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
    }

    /**
     * @param string|null $value
     */
    public function setSlugAttribute(?string $value): void
    {
        if (!empty($value)) {
            $this->attributes['slug'] = mb_convert_case($value, MB_CASE_LOWER, 'UTF-8');
        }
    }
}
