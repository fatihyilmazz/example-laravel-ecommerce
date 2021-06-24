<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\CountryTranslation
 *
 * @property int $id
 * @property int $country_id
 * @property string $locale
 * @property string $name
 * @property-read \App\Country $country
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CountryTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CountryTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CountryTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CountryTranslation whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CountryTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CountryTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CountryTranslation whereName($value)
 * @mixin \Eloquent
 */
class CountryTranslation extends Model
{
    protected $table = 'country_translations';

    protected $touches = ['country'];

    public $timestamps = false;

    protected $fillable = [
        'locale',
        'name',
    ];

    protected $casts = [
        'id'        => 'int',
        'county_id' => 'int',
        'locale'    => 'string',
        'name'      => 'string',
    ];

    /**
     * @return BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * @param string $value
     */
    public function setNameAttribute(string $value): void
    {
        $this->attributes['name'] = mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
    }
}
