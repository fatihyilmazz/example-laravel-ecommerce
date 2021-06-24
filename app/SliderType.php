<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\SliderType
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SliderType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SliderType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SliderType query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $translation_key
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SliderType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SliderType whereTranslationKey($value)
 */
class SliderType extends Model
{
    public const ID_TYPE_PAGE       = 1;
    public const ID_TYPE_LINK       = 2;
    public const ID_TYPE_CATEGORY   = 3;
    public const ID_TYPE_BRAND      = 4;

    protected $table = 'slider_types';

    public $timestamps = false;

    protected $casts = [
        'id' => 'int',
        'translation_key' => 'string',
    ];
}
