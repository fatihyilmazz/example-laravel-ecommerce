<?php

namespace App\Services;

use App\Currency;
use App\Repositories\CurrencyRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class CurrencyService
{
    /**
     * @var CurrencyRepository
     */
    protected $currencyRepository;

    /**
     * @param CurrencyRepository $currencyRepository
     */
    public function __construct(CurrencyRepository $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;
    }

    /**
     * @param Request $request
     *
     * @return LengthAwarePaginator|null
     */
    public function getCurrenciesByFilter(Request $request): ?LengthAwarePaginator
    {
        try {
            return $this->currencyRepository->getCurrenciesByFilter($request);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }

    /**
     * @param array $data
     *
     * @return Currency|Model|null
     */
    public function create(array $data): ?Currency
    {
        try {
            return $this->currencyRepository->create($data);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }

    /**
     * @param array $data
     * @param int $currencyId
     *
     * @return bool|null
     */
    public function update(array $data, int $currencyId): ?bool
    {
        try {
            return $this->currencyRepository->update($data, $currencyId);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }

    /**
     * @param int $currencyId
     *
     * @return bool|null
     */
    public function destroy(int $currencyId): ?bool
    {
        try {
            return $this->currencyRepository->destroy($currencyId);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }

    /**
     * @return Collection|null
     */
    public function pluckAllActiveCurrencies(): ?Collection
    {
        try {
            return $this->currencyRepository->pluckAllActiveCurrenciesWithCode();
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }
}
