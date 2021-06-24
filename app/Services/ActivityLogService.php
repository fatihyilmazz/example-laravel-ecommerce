<?php

namespace App\Services;

use App\Repositories\ActivityLogRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class ActivityLogService
{
    /**
     * @var ActivityLogRepository
     */
    protected $activityLogRepository;

    /**
     * @param ActivityLogRepository $activityLogRepository
     */
    public function __construct(ActivityLogRepository $activityLogRepository)
    {
        $this->activityLogRepository = $activityLogRepository;
    }

    /**
     * @param Request $request
     *
     * @return LengthAwarePaginator|null
     */
    public function getActivitiesByFilter(Request $request): ?LengthAwarePaginator
    {
        try {
            return $this->activityLogRepository->getActivitiesByFilter($request);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }

    /**
     * @return Collection|null
     */
    public function getAllSubjectsFromActivityLog(): ?Collection
    {
        try {
            return $this->activityLogRepository->getAllSubjectsFromActivityLog();
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }

    /**
     * @param Request $request
     * @param string $modelClass
     * @param string $modelName
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator|null
     */
    public function getTransactionHistoriesByModel(Request $request, string $modelClass, string $modelName): ?LengthAwarePaginator
    {
        try {
            return $this->activityLogRepository->getActivitiesByModel($request, $modelClass, $modelName);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }
}
