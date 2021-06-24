<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use stdClass;

/**
 * App\FeatureImage
 *
 * @property int $id
 * @property string $model_type
 * @property int $model_id
 * @property int $media_type
 * @property string $source
 * @property int|null $order
 * @property int|null $item_type
 * @property array $content
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|\App\Media newModelQuery()
 * @method static Builder|\App\Media newQuery()
 * @method static Builder|\App\Media query()
 * @method static Builder|\App\Media whereContent($value)
 * @method static Builder|\App\Media whereCreatedAt($value)
 * @method static Builder|\App\Media whereId($value)
 * @method static Builder|\App\Media whereItemType($value)
 * @method static Builder|\App\Media whereMediaType($value)
 * @method static Builder|\App\Media whereModelId($value)
 * @method static Builder|\App\Media whereModelType($value)
 * @method static Builder|\App\Media whereOrder($value)
 * @method static Builder|\App\Media whereSource($value)
 * @method static Builder|\App\Media whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Media extends Model
{
    public const TYPE_ID_IMAGE  = 1;
    public const TYPE_ID_FILE   = 2;

    public const DEFAULT_IMAGE_PATH_CATEGORY    = '';
    public const DEFAULT_IMAGE_PATH_MENU        = '';
    public const DEFAULT_IMAGE_PATH_PAGE        = 'images/pages/';
    public const DEFAULT_IMAGE_PATH_PRODUCT     = 'images/products/';
    public const DEFAULT_IMAGE_PATH_SLIDER      = 'images/sliders/';

    public const DEFAULT_FILE_PATH_PRODUCT      = 'files/products/';

    protected $table = 'medias';

    protected $fillable = [
        'media_type',
        'source',
        'order',
        'item_type',
        'content'
    ];

    protected $casts = [
        'id'            => 'int',
        'model_type'    => 'string',
        'model_id'      => 'int',
        'media_type'    => 'int',
        'source'        => 'string',
        'order'         => 'int',
        'item_type'     => 'int',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
    ];

    /**
     * @param array $value
     */
    public function setContentAttribute(array $value): void
    {
        $this->attributes['content'] = json_encode($value);
    }

    /**
     * @param string|null $value
     *
     * @return stdClass|null
     */
    public function getContentAttribute(?string $value): ?stdClass
    {
        return json_decode($value);
    }
}
