<?php

namespace App\Services;

use App\Brand;
use App\Repositories\BrandRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class BrandService
{
    /**
     * @var BrandRepository
     */
    protected $brandRepository;

    /**
     * @param BrandRepository $brandRepository
     */
    public function __construct(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    /**
     * @param Request $request
     *
     * @return LengthAwarePaginator|null
     */
    public function getBrandsByFilter(Request $request): ?LengthAwarePaginator
    {
        try {
            return $this->brandRepository->getBrandsByFilter($request);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'id'        => $request->get('id'),
                'name'      => $request->get('name'),
                'order'     => $request->get('order'),
                'is_active' => $request->get('is_active'),
            ]);
        }

        return null;
    }

    /**
     * @param array $data
     *
     * @return Brand|Model|null
     */
    public function create(array $data): ?Brand
    {
        try {
            return $this->brandRepository->create($data);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'data' => $data,
            ]);
        }

        return null;
    }

    /**
     * @param array $data
     * @param int $brandId
     *
     * @return bool|null
     */
    public function update(array $data, int $brandId): ?bool
    {
        try {
            return $this->brandRepository->update($data, $brandId);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'data'      => $data,
                'brandId'   => $brandId,
            ]);
        }

        return null;
    }

    /**
     * @param int $brandId
     *
     * @return bool|null
     */
    public function destroy(int $brandId): ?bool
    {
        try {
            return $this->brandRepository->destroy($brandId);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'brandId' => $brandId,
            ]);
        }

        return null;
    }

    /**
     * @return Collection|null
     */
    public function pluckAllActiveBrandsIdAndName(): ?Collection
    {
        try {
            return $this->brandRepository->pluckAllActiveBrandsIdAndName();
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }

    /**
     * @param array $brandIds
     *
     * @return Collection|null
     */
    public function getSelectedBrandsByIds(array $brandIds): ?Collection
    {
        try {
            return $this->brandRepository->getSelectedBrandsByIds($brandIds);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'brandIds' => $brandIds,
            ]);
        }

        return null;
    }

    /**
     * @return Collection|null
     */
    public function pluckAllBrandsIdAndName(): ?Collection
    {
        try {
            return $this->brandRepository->pluckAllBrandsIdAndName();
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }
}
