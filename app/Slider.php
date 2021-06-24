<?php

namespace App;

use App\Traits\Linkable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * App\Slider
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Media[] $medias
 * @property-read int|null $medias_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Slider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Slider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Slider query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property int $slider_type_id
 * @property string $type_value
 * @property int|null $order
 * @property \Illuminate\Support\Carbon|null $started_at
 * @property \Illuminate\Support\Carbon|null $end_at
 * @property int $is_published
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Slider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Slider whereEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Slider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Slider whereIsPublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Slider whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Slider whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Slider whereSliderTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Slider whereStartedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Slider whereTypeValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Slider whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Slider published()
 * @property-read \App\SliderType|null $sliderType
 */
class Slider extends Model
{
    use Linkable;

    protected $table = 'sliders';

    protected $fillable = [
        'name',
        'slider_type_id',
        'type_value',
        'order',
        'started_at',
        'end_at',
        'is_published'
    ];

    protected $casts = [
        'name'              => 'string',
        'slider_type_id'    => 'int',
        'type_value'        => 'string',
        'order'             => 'int',
        'started_at'        => 'datetime',
        'end_at'            => 'datetime',
        'is_published'      => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $dates = [
        'started_at',
        'end_at',
        'created_at',
        'updated_at',
    ];

    /**
     * @return BelongsTo
     */
    public function sliderType(): BelongsTo
    {
        return $this->belongsTo(SliderType::class);
    }

    /**
     * @return MorphMany
     */
    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'model');
    }

    /**
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }
}
