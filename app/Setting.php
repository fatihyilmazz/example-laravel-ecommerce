<?php

namespace App;

use App\Observers\SettingObserver;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Setting
 *
 * @property string $key
 * @property mixed $value
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Setting whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Setting whereValue($value)
 * @mixin \Eloquent
 */
class Setting extends Model
{
    public const CACHE_EXPIRATION_TIME = 60 * 15; // Second * Minute

    public const CACHE_KEY_ALL = 'settings-all';

    public const PAGINATION_ITEM_PER_PAGE = 10;
    public const PAGINATION_PER_PAGE_LIST = '10,30,50,70,100';

    public const DEFAULT_MAX_SIZE = 1024; //kb

    public const IMAGE_SLIDER_MAX_SIZE = self::DEFAULT_MAX_SIZE;
    public const IMAGE_SLIDER_WIDTH    = 1920; //pixel
    public const IMAGE_SLIDER_HEIGHT   = 752; //pixel

    public const IMAGE_PRODUCT_MAX_SIZE = self::DEFAULT_MAX_SIZE;
    public const IMAGE_PRODUCT_WIDTH    = 1920; //pixel
    public const IMAGE_PRODUCT_HEIGHT   = 752; //pixel

    public const FILE_PRODUCT_MAX_SIZE              = self::DEFAULT_MAX_SIZE;
    public const FILE_PRODUCT_ALLOWED_FILE_TYPES    = 'application/pdf,application/vnd.ms-excel,application/msword,application/vnd.ms-powerpoint,text/plain';

    public const SECURITY_PASSWORD_LENGTH = 6;

    protected $table        = 'settings';
    protected $primaryKey   = 'key';
    protected $keyType      = 'string';
    public $incrementing    = false;
    public $timestamps      = false;

    protected $fillable     = [
        'key',
        'value',
    ];

    protected static function booted()
    {
        parent::booted();
        self::observe(SettingObserver::class);
    }

    /**
     * @param mixed $value
     */
    public function setValueAttribute($value): void
    {
        $this->attributes['value'] = \Opis\Closure\serialize($value);
    }

    /**
     * @param string $value
     *
     * @return mixed
     */
    public function getValueAttribute(string $value)
    {
        return \Opis\Closure\unserialize($value);
    }

    /**
     * @param mixed $value
     */
    public function setOptionsAttribute($value): void
    {
        $this->attributes['options'] = \Opis\Closure\serialize($value);
    }

    /**
     * @param string|null $value
     *
     * @return mixed
     */
    public function getOptionsAttribute(?string $value)
    {
        if (!empty($value)) {
            return \Opis\Closure\unserialize($value);
        }

        return $value;
    }
}
