<?php

namespace App\Services;

use App\Repositories\LocaleRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class LocaleService
{
    /**
     * @var LocaleRepository
     */
    protected $localeRepository;

    /**
     * @param LocaleRepository $localeRepository
     */
    public function __construct(LocaleRepository $localeRepository)
    {
        $this->localeRepository = $localeRepository;
    }

    /**
     * @return Collection
     */
    public function getActiveLocales(): ?Collection
    {
        try {
            return $this->localeRepository->getActiveLocales();
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }

    /**
     * @param array $data
     * @param int $localeId
     *
     * @return bool|null
     */
    public function update(array $data, int $localeId): ?bool
    {
        try {
            return $this->localeRepository->update($data, $localeId);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'data'      => $data,
                'localeId'  => $localeId,
            ]);
        }

        return null;
    }

    /**
     * @return Collection|null
     */
    public function getSupportedLocales(): ?Collection
    {
        try {
            return  $this->localeRepository->getModel()->usableForUsers()->get(['code', 'native_name']);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }

//    /**
//     * @return \Illuminate\Support\Collection
//     */
//    public function getAllIdAndNameWithTrashed(): \Illuminate\Support\Collection
//    {
//        try {
//            return $this->localeRepository->getAllIdAndNameWithTrashed();
//        } catch (\Exception $exception) {
//            Log::warning($exception);
//        } catch (\Error $exception) {
//            Log::error($exception);
//        }
//
//        return collect();
//    }
}
