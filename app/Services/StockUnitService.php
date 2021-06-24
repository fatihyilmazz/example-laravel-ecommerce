<?php

namespace App\Services;

use App\StockUnitTranslation;
use App\Repositories\StockUnitRepository;
use App\StockUnit;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class StockUnitService
{
    /**
     * @var StockUnitRepository
     */
    protected $stockUnitRepository;

    /**
     * @param StockUnitRepository $stockUnitRepository
     */
    public function __construct(
        StockUnitRepository $stockUnitRepository
    ) {
        $this->stockUnitRepository = $stockUnitRepository;
    }

    /**
     * @param Request $request
     *
     * @return LengthAwarePaginator|null
     */
    public function getStockUnitsByFilter(Request $request): ?LengthAwarePaginator
    {
        try {
            return $this->stockUnitRepository->getStockUnitsByFilter($request);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }

    /**
     * @return Collection|null
     */
    public function pluckAllActiveStockUnits(): ?Collection
    {
        try {
            return $this->stockUnitRepository->pluckAllActiveStockUnits();
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }

    /**
     * @param int $stockUnitId
     *
     * @return StockUnit|null
     */
    public function getStockUnitById(int $stockUnitId): ?StockUnit
    {
        try {
            return $this->stockUnitRepository->getStockUnitById($stockUnitId);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }

    /**
     * @param array $data
     *
     * @return StockUnit|null
     *
     * @throws \Throwable
     */
    public function create(array $data): ?StockUnit
    {
        try {
            return DB::transaction(function () use ($data) {
                $stockUnit = $this->stockUnitRepository->create($data);

                $translations = collect();
                foreach ($data['translations'] as $translation) {
                    $translations->push(new StockUnitTranslation($translation));
                }

                $stockUnit->translations()->saveMany($translations);

                return $stockUnit;
            });
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'data' => $data,
            ]);
        }

        return null;
    }

    /**
     * @param array $data
     * @param int $stockUnitId
     *
     * @return bool|null
     *
     * @throws \Throwable
     */
    public function update(array $data, int $stockUnitId): ?bool
    {
        try {
            return DB::transaction(function () use ($data, $stockUnitId) {
                $stockUnit = $this->stockUnitRepository->find($stockUnitId);

                $stockUnit->update($data);

                $translations = collect();
                foreach ($data['translations'] as $translation) {
                    if (isset($translation['id'])) {
                        $stockUnit->translations()->find($translation['id'])->update($translation);
                    } else {
                        $translations->push(new StockUnitTranslation($translation));
                    }
                }

                if ($translations->isNotEmpty()) {
                    $stockUnit->translations()->saveMany($translations);
                }

                return true;
            });
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'data'          => $data,
                'stockUnitId'   => $stockUnitId,
            ]);
        }

        return null;
    }

    /**
     * @param int $stockUnitId
     *
     * @return bool|null
     */
    public function destroy(int $stockUnitId): ?bool
    {
        try {
            return $this->stockUnitRepository->destroy($stockUnitId);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'stockUnitId' => $stockUnitId,
            ]);
        }

        return null;
    }
}
