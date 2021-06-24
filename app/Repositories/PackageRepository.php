<?php

namespace App\Repositories;

use App\Package;
use Illuminate\Support\Facades\Cache;

class PackageRepository extends BaseRepository
{
    /**
     * @var Package
     */
    protected $package;

    /**
     * @param Package $package
     */
    public function __construct(Package $package)
    {
        parent::__construct($package);

        $this->package = $package;
    }

    /**
     * @return array
     */
    public function getActivePackageModules(): array
    {
        $moduleIds =  Cache::remember(Package::CACHE_KEY_ALL_ACTIVE_MODULES, Package::CACHE_EXPIRATION_TIME, function () {
            return $this->package->active()->value('module_ids');
        });

        if (!empty($moduleIds)) {
            return $moduleIds;
        }

        return [];
    }
}
