<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\DistrictTranslation
 *
 * @property int $id
 * @property int $district_id
 * @property string $locale
 * @property string $name
 * @property-read \App\District $district
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DistrictTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DistrictTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DistrictTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DistrictTranslation whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DistrictTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DistrictTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DistrictTranslation whereName($value)
 * @mixin \Eloquent
 */
class DistrictTranslation extends Model
{
    protected $table = 'district_translations';

    protected $touches = ['district'];

    public $timestamps = false;

    protected $fillable = [
        'locale',
        'name',
    ];

    protected $casts = [
        'id'            => 'int',
        'district_id'   => 'int',
        'locale'        => 'string',
        'name'          => 'string',
    ];


    /**
     * @return BelongsTo
     */
    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    /**
     * @param string $value
     */
    public function setNameAttribute(string $value): void
    {
        $this->attributes['name'] = mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
    }
}
