<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\User\FilterAdmin;
use App\Http\Requests\Admin\User\StoreAdmin;
use App\Services\AdminService;
use App\Admin;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;

class AdminController extends BaseController
{
    /**
     * @var AdminService
     */
    protected $adminService;

    /**
     * @param AdminService $adminService
     */
    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    /**
     * @param FilterAdmin $request
     *
     * @return View
     */
    public function index(FilterAdmin $request): View
    {
        $request->validated();

        $admins = $this->adminService->getAdminsByFilter($request);

        return view('admin.admin.index')
            ->with(compact('admins'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('admin.admin.form');
    }

    /**
     * @param StoreAdmin $request
     *
     * @return RedirectResponse
     */
    public function store(StoreAdmin $request): RedirectResponse
    {
        $validatedAttributes = $request->validated();

        $admin = $this->adminService->create($validatedAttributes);

        if ($admin instanceof Model) {
            $notifyStatus = 'success';
            $notifyTitle = __('messages.info.operation.successful');
            $notifyMessage = __('messages.info.operation.saved');

            return redirect(route('admin.admins.index'))
                ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
        }

        $notifyStatus = 'danger';
        $notifyTitle = __('messages.info.operation.failed');
        $notifyMessage = __('messages.info.operation.saving_failed');

        return back()
            ->withInput()
            ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
    }

    /**
     * @param Admin $admin
     *
     * @return View
     */
    public function edit(Admin $admin): View
    {
        html()->model($admin);

        return view('admin.admin.form')
            ->with(compact('admin'));
    }

    /**
     * @param StoreAdmin $request
     * @param int $adminId
     *
     * @return RedirectResponse
     */
    public function update(StoreAdmin $request, int $adminId): RedirectResponse
    {
        $validatedAttributes = $request->validated();

        $updateStatus = $this->adminService->update($validatedAttributes, $adminId);

        if ($updateStatus) {
            $notifyStatus = 'success';
            $notifyTitle = __('messages.info.operation.successful');
            $notifyMessage = __('messages.info.operation.saved');

            return redirect(route('admin.admins.index'))
                ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
        }

        $notifyStatus = 'danger';
        $notifyTitle = __('messages.info.operation.failed');
        $notifyMessage = __('messages.info.operation.saving_failed');

        return back()
            ->withInput()
            ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
    }

    /**
     * @param int $adminId
     *
     * @return bool|null
     */
    public function destroy(int $adminId): ?bool
    {
        return $this->adminService->destroy($adminId);
    }
}
