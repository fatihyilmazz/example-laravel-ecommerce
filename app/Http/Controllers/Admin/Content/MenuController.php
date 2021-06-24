<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\Content\FilterMenu;
use App\Http\Requests\Admin\Content\StoreMenu;
use App\Menu;
use App\Services\BrandService;
use App\Services\CategoryService;
use App\Services\FileService;
use App\Services\LocaleService;
use App\Services\MenuService;
use App\Services\PageService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class MenuController extends BaseController
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
     * @param FilterMenu $request
     *
     * @return View
     */
    public function index(FilterMenu $request): View
    {
        $request->validated();

        $menus          = $this->menuService->getMenusByFilter($request);
        $menuGroups     = $this->menuService->pluckAllMenuGroups();
        $menuTypes      = $this->menuService->pluckAllMenuTypes();
        $parentMenus    = $this->menuService->pluckAllParentMenus();

        return view('admin.menu.index')
            ->with(compact('menus', 'menuGroups', 'menuTypes', 'parentMenus'));
    }

    /**
     * @param LocaleService $localeService
     * @param PageService $pageService
     * @param CategoryService $categoryService
     * @param BrandService $brandService
     * @param FileService $fileService
     *
     * @return View
     */
    public function create(LocaleService $localeService, PageService $pageService, CategoryService $categoryService, BrandService $brandService, FileService $fileService): View
    {
        $menuGroups         = $this->menuService->pluckAllActiveMenuGroups();
        $parentMenus        = $this->menuService->pluckAllActiveParentMenus();
        $menuTypes          = $this->menuService->pluckAllMenuTypes();
        $locales            = $localeService->getSupportedLocales();
        $pages              = $pageService->pluckActivePagesIdAndName();
        $mainCategories     = $categoryService->pluckActiveMainCategoriesIdAndName();
        $categories         = $categoryService->pluckActiveCategoriesIdAndName();
        $brands             = $brandService->pluckAllActiveBrandsIdAndName();
        $staticPageNames    = $fileService->getWebStaticPagesNames();

        return view('admin.menu.form')
            ->with(compact('menuGroups', 'parentMenus', 'menuTypes','locales','pages', 'mainCategories', 'categories', 'brands', 'staticPageNames'));
    }

    /**
     * @param StoreMenu $request
     *
     * @return RedirectResponse
     */
    public function store(StoreMenu $request): RedirectResponse
    {
        $validatedAttributes = $request->validated();

        $menu = $this->menuService->createMenu($validatedAttributes);
        if ($menu instanceof Menu) {
            $notifyStatus   = 'success';
            $notifyTitle    = __('messages.info.operation.successful');
            $notifyMessage  = __('messages.info.operation.saved');

            return redirect(route('admin.menus.index'))
                ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
        }

        $notifyStatus   = 'danger';
        $notifyTitle    = __('messages.info.operation.failed');
        $notifyMessage  = __('messages.info.operation.saving_failed');

        return back()->withInput()
            ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
    }

    /**
     * @param int $menuId
     * @param LocaleService $localeService
     * @param PageService $pageService
     * @param CategoryService $categoryService
     * @param BrandService $brandService
     *
     * @return View
     */
    public function edit(int $menuId, LocaleService $localeService, PageService $pageService, CategoryService $categoryService, BrandService $brandService, FileService $fileService): View
    {
        $menu               = $this->menuService->getMenuById($menuId);
        $menuGroups         = $this->menuService->pluckAllActiveMenuGroups();
        $parentMenus        = $this->menuService->pluckAllActiveParentMenus();
        $menuTypes          = $this->menuService->pluckAllMenuTypes();
        $locales            = $localeService->getSupportedLocales();
        $pages              = $pageService->pluckActivePagesIdAndName();
        $mainCategories     = $categoryService->pluckActiveMainCategoriesIdAndName();
        $categories         = $categoryService->pluckActiveCategoriesIdAndName();
        $brands             = $brandService->pluckAllActiveBrandsIdAndName();
        $staticPageNames    = $fileService->getWebStaticPagesNames();

        html()->model($menu);

        return view('admin.menu.form')
            ->with(compact('menuGroups', 'parentMenus', 'menuTypes', 'locales', 'pages', 'mainCategories', 'categories', 'brands', 'staticPageNames', 'menu'));
    }

    /**
     * @param StoreMenu $request
     * @param int $menuId
     *
     * @return RedirectResponse
     */
    public function update(StoreMenu $request, int $menuId): RedirectResponse
    {
        $validatedAttributes = $request->validated();

        $updateStatus = $this->menuService->updateMenu($validatedAttributes, $menuId);
        if ($updateStatus) {
            $notifyStatus   = 'success';
            $notifyTitle    = __('messages.info.operation.successful');
            $notifyMessage  = __('messages.info.operation.saved');

            return redirect(route('admin.menus.index'))
                ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
        }

        $notifyStatus   = 'danger';
        $notifyTitle    = __('messages.info.operation.failed');
        $notifyMessage  = __('messages.info.operation.saving_failed');

        return back()->withInput()
            ->setStatusCode(Response::HTTP_NOT_FOUND)
            ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
    }

    /**
     * @param int $menuId
     *
     * @return bool|null
     */
    public function destroy(int $menuId): ?bool
    {
        return $this->menuService->destroyMenu($menuId);
    }

//    /**
//     * @param FilterTransactionHistory $request
//     * @param ActivityLogService $activityLogService
//     * @param UserService $userService
//     * @return \Illuminate\View\View
//     */
//    public function transactionHistoryList(FilterTransactionHistory $request, ActivityLogService $activityLogService, UserService $userService): View
//    {
//        $request->validated();
//
//        return view('admin.common.transaction-history-for-translation', [
//            'modelName' => 'menu',
//            'transactions' => $activityLogService->getTransactionHistoriesByModel($request, Menu::class, 'menu'),
//            'causers' => $userService->getAllPanelUsersIdAndNameWithTrashed()->toArray(),
//            'subjects' => $this->menuService->getPluckAllMenusWithTrashed()->toArray(),
//        ]);
//    }
}
