<?php

namespace App;

use App\Traits\Linkable;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Page
 *
 * @property int $id
 * @property string $name
 * @property int $is_published
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\PageTranslation|null $translationForCurrentLocale
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\PageTranslation[] $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Page onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereIsPublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Page withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Page withoutTrashed()
 * @mixin \Eloquent
 * @property array $metas
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page published()
 */
class Page extends Model
{
    use SoftDeletes, Linkable, Translatable;

    protected $table = 'pages';

    protected $fillable = [
        'name',
        'is_published',
    ];

    protected $casts = [
        'id'            => 'int',
        'name'          => 'name',
        'is_published'  => 'boolean',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];

    /**
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    /**
     * @param array $value
     */
    public function setMetasAttribute(array $value): void
    {
        $this->attributes['metas'] = json_encode($value);
    }

    /**
     * @param string $value
     *
     * @return array
     */
    public function getMetasAttribute(string $value): array
    {
        return json_decode($value);
    }
}
