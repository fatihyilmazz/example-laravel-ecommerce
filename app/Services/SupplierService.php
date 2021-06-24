<?php

namespace App\Services;

use App\Supplier;
use App\Repositories\SupplierRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class SupplierService
{
    /**
     * @var SupplierRepository
     */
    protected $supplierRepository;

    /**
     * @param SupplierRepository $supplierRepository
     */
    public function __construct(SupplierRepository $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    /**
     * @param Request $request
     *
     * @return LengthAwarePaginator|null
     */
    public function getSuppliersByFilter(Request $request): ?LengthAwarePaginator
    {
        try {
            return $this->supplierRepository->getSuppliersByFilter($request);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }

    /**
     * @param array $data
     *
     * @return Supplier|Model|null
     */
    public function create(array $data): ?Supplier
    {
        try {
            return $this->supplierRepository->create($data);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }

    /**
     * @param array $data
     * @param int $supplierId
     *
     * @return bool|null
     */
    public function update(array $data, int $supplierId): ?bool
    {
        try {
            return $this->supplierRepository->update($data, $supplierId);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }

    /**
     * @param int $supplierId
     *
     * @return bool|null
     */
    public function destroy(int $supplierId): ?bool
    {
        try {
            return $this->supplierRepository->destroy($supplierId);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }

    /**
     * @return Collection|null
     */
    public function pluckAllActiveSuppliers(): ?Collection
    {
        try {
            return $this->supplierRepository->pluckAllActiveSuppliers();
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }
}
