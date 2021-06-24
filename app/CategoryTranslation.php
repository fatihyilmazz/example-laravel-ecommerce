<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\CategoryTranslation
 *
 * @property int $id
 * @property int $category_id
 * @property string $locale
 * @property string $name
 * @property string $slug
 * @property array|null $metas key | value
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \App\Category $category
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CategoryTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CategoryTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CategoryTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CategoryTranslation whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CategoryTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CategoryTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CategoryTranslation whereMetas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CategoryTranslation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CategoryTranslation whereSlug($value)
 * @mixin \Eloquent
 */
class CategoryTranslation extends Model
{
    use LogsActivity;

    protected $table = 'category_translations';

    public $timestamps = false;

    protected $touches = ['category'];

    protected $fillable = [
        'locale',
        'name',
        'slug',
        'metas',
    ];

    protected $casts = [
        'id'            => 'int',
        'category_id'   => 'int',
        'locale'        => 'string',
        'name'          => 'string',
        'slug'          => 'string',
        'metas'         => 'array',
    ];

    protected static $logName = '[Category]';

    protected static $logAttributes = ['name', 'slug'];

    protected static $recordEvents = ['created', 'updated', 'deleted'];

    protected static $logOnlyDirty = true;

    protected static $submitEmptyLogs = false;

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @param string $value
     */
    public function setNameAttribute(string $value): void
    {
        $this->attributes['name'] = mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
    }

    /**
     * @param string $value
     */
    public function setSlugAttribute(string $value): void
    {
        $this->attributes['slug'] = mb_convert_case($value, MB_CASE_LOWER, 'UTF-8');
    }
}
