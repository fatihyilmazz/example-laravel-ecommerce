<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\ProvinceTranslation
 *
 * @property int $id
 * @property int $province_id
 * @property string $locale
 * @property string $name
 * @property-read \App\Province $province
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProvinceTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProvinceTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProvinceTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProvinceTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProvinceTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProvinceTranslation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProvinceTranslation whereProvinceId($value)
 * @mixin \Eloquent
 */
class ProvinceTranslation extends Model
{
    protected $table = 'province_translations';

    protected $touches = ['province'];

    public $timestamps = false;

    protected $fillable = [
        'locale',
        'name',
    ];

    protected $casts = [
        'id'            => 'int',
        'province_id'   => 'int',
        'locale'        => 'string',
        'name'          => 'string',
    ];

    /**
     * @return BelongsTo
     */
    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    /**
     * @param string $value
     */
    public function setNameAttribute($value): void
    {
        $this->attributes['name'] = mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
    }
}
