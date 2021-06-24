<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\PageTranslation
 *
 * @property int $id
 * @property int $page_id
 * @property string $locale
 * @property string $content
 * @property string $slug
 * @property-read \App\Page $page
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PageTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PageTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PageTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PageTranslation whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PageTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PageTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PageTranslation wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PageTranslation whereSlug($value)
 * @mixin \Eloquent
 * @property array|null $metas key | value
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PageTranslation whereMetas($value)
 */
class PageTranslation extends Model
{
    protected $table = 'page_translations';

    protected $touches = ['page'];

    protected $fillable = [
        'locale',
        'content',
        'slug',
        'metas'
    ];

    public $timestamps = false;

    protected $casts = [
        'id' => 'int',
        'page_id' => 'int',
        'locale' => 'string',
        'content' => 'string',
        'slug' => 'string',
        'metas' => 'array',
    ];

    /**
     * @return BelongsTo
     */
    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }
}
