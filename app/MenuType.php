<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\MenuType
 *
 * @property int $id
 * @property string $translation_key
 * @property int|null $order
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuType whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuType whereTranslationKey($value)
 * @mixin \Eloquent
 */
class MenuType extends Model
{
    public const ID_MAIN_PAGE              = 1;
    public const ID_PAGE                   = 2;
    public const ID_EXTERNAL_LINK          = 3;
    public const ID_MAIN_CATEGORY          = 4;
    public const ID_SELECTED_CATEGORIES    = 5;
    public const ID_BRANDS                 = 6;
    public const ID_STATIC_PAGE            = 7;

    protected $table = 'menu_types';

    public $timestamps = false;

    protected $casts = [
        'id'                => 'int',
        'translation_key'   => 'string',
        'order'             => 'int',
    ];
}
