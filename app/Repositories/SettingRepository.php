<?php

namespace App\Repositories;

use App\Setting;

class SettingRepository extends BaseRepository
{
    /**
     * @var Setting
     */
    protected $setting;

    /**
     * @param Setting $setting
     */
    public function __construct(Setting $setting)
    {
        parent::__construct($setting);

        $this->setting = $setting;
    }
}
