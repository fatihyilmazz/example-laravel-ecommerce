<?php

namespace App\Services;

use App\Repositories\SettingRepository;
use App\Setting;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SettingService
{
    /**
     * @var SettingRepository
     */
    protected $settingRepository;

    /**
     * @param SettingRepository $settingRepository
     */
    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function getCachedSetting(): \Illuminate\Database\Eloquent\Collection
    {
        return Cache::remember(Setting::CACHE_KEY_ALL, Setting::CACHE_EXPIRATION_TIME, function () {
            return $this->settingRepository->all();
        });
    }

    /**
     * @param $key
     * @param $default
     *
     * @return mixed|null
     */
    public function get($key, $default)
    {
        try {
            $settings = $this->getCachedSetting();

            $setting = $settings->firstWhere('key', $key);

            if (!empty($setting)) {
                return $setting->value;
            }

            return $default;
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'key'       => $key,
                'default'   => $default,
            ]);
        }

        return null;
    }

    /**
     * @return Collection|null
     */
    public function pluckAllSettings(): ?Collection
    {
        try {
            $settings = $this->getCachedSetting();

            return $settings->pluck('value', 'key');
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }

    /**
     * @param string $key
     *
     * @return array|null
     */
    public function getKeyOptions(string $key): ?array
    {
        try {
            $settingOptions =  $this->getCachedSetting()->firstWhere('key', $key)->options;

            return array_combine($settingOptions, $settingOptions);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }

    /**
     * @param array $settings
     *
     * @return bool|null
     */
    public function update(array $settings): ?bool
    {
        try {
            return DB::transaction(function () use ($settings) {
                foreach ($settings as $key => $value) {
                    $result = $this->settingRepository->update(['value' => $value], $key);

                    if (!$result) {
                        return false;
                    }
                }

                return true;
            });
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'settings' => $settings,
            ]);
        }

        return null;
    }
}
