<?php

namespace App\View\Composers;

use App\Services\MenuService;
use Illuminate\View\View;

class MenuComposer
{
    /**
     * @var MenuService
     */
    protected $menuService;

    /**
     * @param MenuService $menuService
     */
    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    /**
     * @param View $view
     */
    public function compose(View $view): void
    {
        $view->with('headerMenus', $this->menuService->getActiveHeaderMenus());
    }
}
