<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CacheInvalidatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    const NAME_SETTING_UPDATED  = 'setting.updated';
    const NAME_MENU_UPDATED     = 'menu.updated';

    /**
     * @var Model|null
     */
    protected $model;

    /**
     *
     * @param Model|null $model
     */
    public function __construct(?Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return Model|null
     */
    public function getModel()
    {
        return $this->model;
    }
}
