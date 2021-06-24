<?php

namespace App\Services;

use App\Repositories\AdminRepository;
use App\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class AdminService
{
    /**
     * @var AdminRepository
     */
    protected $adminRepository;

    /**
     * @param AdminRepository $adminRepository
     */
    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    /**
     * @param Request $request
     *
     * @return LengthAwarePaginator|null
     */
    public function getAdminsByFilter(Request $request): ?LengthAwarePaginator
    {
        try {
            return $this->adminRepository->getAdminsByFilter($request);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'request' => $request,
            ]);
        }

        return null;
    }

    /**
     * @param array $data
     *
     * @return Admin|Model|null
     */
    public function create(array $data): ?Admin
    {
        try {
            return $this->adminRepository->create($data);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'data' => $data,
            ]);
        }

        return null;
    }

    /**
     * @param array $data
     * @param int $userId
     *
     * @return bool|null
     */
    public function update(array $data, int $userId): ?bool
    {
        try {
            return $this->adminRepository->update($data, $userId);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'data'      => $data,
                'userId'    => $userId,
            ]);
        }

        return null;
    }

    /**
     * @param int $userId
     *
     * @return bool|null
     */
    public function destroy(int $userId): ?bool
    {
        try {
            return $this->adminRepository->destroy($userId);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'userId' => $userId,
            ]);
        }

        return null;
    }

    /**
     * @return Collection|null
     */
    public function getAllPanelAdminsIdAndNameWithTrashed(): ?Collection
    {
        try {
            return $this->adminRepository->getAllPanelAdminsIdAndNameWithTrashed();
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }
}
