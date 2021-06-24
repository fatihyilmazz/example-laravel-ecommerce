<?php

namespace App\Services;

use App\Repositories\PackageRepository;
use Illuminate\Support\Facades\Log;

class PackageService
{
    /**
     * @var PackageRepository
     */
    protected $packageRepository;

    /**
     * @param PackageRepository $packageRepository
     */
    public function __construct(PackageRepository $packageRepository)
    {
        $this->packageRepository = $packageRepository;
    }

    /**
     * @return array
     */
    public function getActivePackageModules(): array
    {
        try {
            return $this->packageRepository->getActivePackageModules();
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return [];
    }
}
