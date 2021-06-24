<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\Content\FilterMenuGroup;
use App\Http\Requests\Admin\Content\StoreMenuGroup;
use App\MenuGroup;
use App\Services\MenuService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class MenuGroupController extends BaseController
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
     * @param FilterMenuGroup $request
     *
     * @return View
     */
    public function index(FilterMenuGroup $request): View
    {
        $request->validated();

        $menuGroups = $this->menuService->getMenuGroupsByFilter($request);

        return view('admin.menu_group.index')
            ->with(compact('menuGroups'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('admin.menu_group.form');
    }

    /**
     * @param StoreMenuGroup $request
     *
     * @return RedirectResponse
     */
    public function store(StoreMenuGroup $request): RedirectResponse
    {
        $validatedAttributes = $request->validated();

        $menuGroup = $this->menuService->createMenuGroup($validatedAttributes);
        if ($menuGroup instanceof MenuGroup) {
            $notifyStatus   = 'success';
            $notifyTitle    = __('messages.info.operation.successful');
            $notifyMessage  = __('messages.info.operation.saved');

            return redirect(route('admin.menu_groups.index'))
                ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
        }

        $notifyStatus   = 'danger';
        $notifyTitle    = __('messages.info.operation.failed');
        $notifyMessage  = __('messages.info.operation.saving_failed');

        return back()->withInput()
            ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));

    }

    /**
     * @param MenuGroup $menuGroup
     *
     * @return View
     */
    public function edit(MenuGroup $menuGroup): View
    {
        html()->model($menuGroup);

        return view('admin.menu_group.form')
            ->with(compact('menuGroup'));
    }

    /**
     * @param StoreMenuGroup $request
     * @param int $menuGroupId
     *
     * @return RedirectResponse
     */
    public function update(StoreMenuGroup $request, int $menuGroupId): RedirectResponse
    {
        $validatedAttributes = $request->validated();

        $updateStatus = $this->menuService->updateMenuGroup($validatedAttributes, $menuGroupId);
        if ($updateStatus) {
            $notifyStatus   = 'success';
            $notifyTitle    = __('messages.info.operation.successful');
            $notifyMessage  = __('messages.info.operation.saved');

            return redirect(route('admin.menu_groups.index'))
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
     * @param int $menuGroupId
     *
     * @return bool|null
     */
    public function destroy(int $menuGroupId): ?bool
    {
        return $this->menuService->destroyMenuGroup($menuGroupId);
    }

//    /**
//     * @param FilterTransactionHistory $request
//     * @param ActivityLogService $activityLogService
//     * @param UserService $userService
//     * @param MenuService $menuService
//     * @return View
//     */
//    public function transactionHistoryList(FilterTransactionHistory $request, ActivityLogService $activityLogService, UserService $userService, MenuService $menuService): View
//    {
//        $request->validated();
//
//        return view('admin.common.transaction-history', [
//            'modelName' => 'menu_group',
//            'transactions' => $activityLogService->getTransactionHistoriesByModel($request, MenuGroup::class, 'menu_group'),
//            'causers' => $userService->getAllPanelUsersIdAndNameWithTrashed()->toArray(),
//            'subjects' => $this->menuService->getAllIdAndNameWithTrashed()->toArray(),
//        ]);
//    }
}
