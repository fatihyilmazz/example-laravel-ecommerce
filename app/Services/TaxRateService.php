<?php

namespace App\Services;

use App\TaxRate;
use App\Repositories\TaxRateRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class TaxRateService
{
    /**
     * @var TaxRateRepository
     */
    protected $taxRateRepository;

    /**
     * @param TaxRateRepository $taxRateRepository
     */
    public function __construct(TaxRateRepository $taxRateRepository)
    {
        $this->taxRateRepository = $taxRateRepository;
    }

    /**
     * @param Request $request
     *
     * @return LengthAwarePaginator|null
     */
    public function getTaxRatesByFilter(Request $request): ?LengthAwarePaginator
    {
        try {
            return $this->taxRateRepository->getTaxRatesByFilter($request);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }

    /**
     * @param array $data
     *
     * @return TaxRate|Model|null
     */
    public function create(array $data): ?TaxRate
    {
        try {
            return $this->taxRateRepository->create($data);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }

    /**
     * @param array $data
     * @param int $taxRateId
     *
     * @return bool|null
     */
    public function update(array $data, int $taxRateId): ?bool
    {
        try {
            return $this->taxRateRepository->update($data, $taxRateId);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }

    /**
     * @param int $taxRateId
     *
     * @return bool|null
     */
    public function destroy(int $taxRateId): ?bool
    {
        try {
            return $this->taxRateRepository->destroy($taxRateId);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }

    /**
     * @return Collection|null
     */
    public function pluckAllActiveTaxRates(): ?Collection
    {
        try {
            return $this->taxRateRepository->pluckAllActiveTaxRates();
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }
}
