<?php

namespace App\View\Composers;

use App\Services\PackageService;
use Illuminate\View\View;

class PackageComposer
{
    /**
     * @var PackageService
     */
    protected $packageService;

    /**
     * @param PackageService $packageService
     */
    public function __construct(PackageService $packageService)
    {
        $this->packageService = $packageService;
    }

    /**
     * @param View $view
     */
    public function compose(View $view): void
    {
        $view->with('moduleIds', $this->packageService->getActivePackageModules());
    }
}
