<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Admin\BaseController;
use App\Services\RoleService;
use App\Http\Requests\Admin\User\StoreRole;
use App\Http\Requests\Admin\User\FilterRole;
use Spatie\Permission\Models\Role;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends BaseController
{
    /**
     * @var RoleService
     */
    protected $roleService;

    /**
     * @param RoleService $roleService
     */
    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    /**
     * @param FilterRole $request
     *
     * @return View
     */
    public function index(FilterRole $request): View
    {
        $request->validated();

        $roles = $this->roleService->getRolesByFilter($request);

        return view('admin.role.index')
            ->with(compact('roles'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('admin.role.form');
    }

    /**
     * @param StoreRole $request
     *
     * @return RedirectResponse
     */
    public function store(StoreRole $request): RedirectResponse
    {
        $validatedAttributes = $request->validated();

        $role = $this->roleService->create($validatedAttributes);
        if ($role instanceof Role) {
            $notifyStatus   = 'success';
            $notifyTitle    = __('messages.info.operation.successful');
            $notifyMessage  = __('messages.info.operation.saved');

            return redirect(route('admin.roles.index'))
                ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
        }

        $notifyStatus   = 'danger';
        $notifyTitle    = __('messages.info.operation.failed');
        $notifyMessage  = __('messages.info.operation.saving_failed');

        return back()->withInput()
            ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
    }

    /**
     * @param Role $role
     *
     * @return View
     */
    public function edit(Role $role): View
    {
        $rolePermissions = $role->getAllPermissions()->pluck('name')->toArray();

        html()->model($role);

        return view('admin.role.form')
            ->with(compact('role', 'rolePermissions'));
    }

    /**
     * @param StoreRole $request
     * @param int $roleId
     *
     * @return RedirectResponse
     */
    public function update(StoreRole $request, int $roleId): RedirectResponse
    {
        $validatedAttributes = $request->validated();

        $updateStatus = $this->roleService->update($validatedAttributes, $roleId);
        if ($updateStatus) {
            $notifyStatus   = 'success';
            $notifyTitle    = __('messages.info.operation.successful');
            $notifyMessage  = __('messages.info.operation.saved');

            return redirect(route('admin.roles.index'))
                ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
        }

        $notifyStatus   = 'danger';
        $notifyTitle    = __('messages.info.operation.failed');
        $notifyMessage  = __('messages.info.operation.saving_failed');

        return back()->withInput()->setStatusCode(Response::HTTP_NOT_FOUND)
            ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
    }

    /**
     * @param int $roleId
     *
     * @return bool|null
     */
    public function destroy(int $roleId): ?bool
    {
        return $this->roleService->destroy($roleId);
    }
}
