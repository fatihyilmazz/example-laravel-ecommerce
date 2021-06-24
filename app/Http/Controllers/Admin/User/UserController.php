<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\User\FilterUser;
use App\Http\Requests\Admin\User\StoreUser;
use App\Services\UserService;
use App\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends BaseController
{
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param FilterUser $request
     *
     * @return View
     */
    public function index(FilterUser $request): View
    {
        $request->validated();

        $users = $this->userService->getUsersByFilter($request);

        return view('admin.user.index')
            ->with(compact('users'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('admin.user.form');
    }

    /**
     * @param StoreUser $request
     *
     * @return RedirectResponse
     */
    public function store(StoreUser $request): RedirectResponse
    {
        $validatedAttributes = $request->validated();

        $user = $this->userService->create($validatedAttributes);
        if ($user instanceof User) {
            $notifyStatus   = 'success';
            $notifyTitle    = __('messages.info.operation.successful');
            $notifyMessage  = __('messages.info.operation.saved');

            return redirect(route('admin.users.index'))
                ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
        }

        $notifyStatus   = 'danger';
        $notifyTitle    = __('messages.info.operation.failed');
        $notifyMessage  = __('messages.info.operation.saving_failed');

        return back()->withInput()
            ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
    }

    /**
     * @param User $user
     *
     * @return View
     */
    public function edit(User $user): View
    {
        html()->model($user);

        return view('admin.user.form')
            ->with(compact('user'));
    }

    /**
     * @param StoreUser $request
     * @param int $userId
     *
     * @return RedirectResponse
     */
    public function update(StoreUser $request, int $userId): RedirectResponse
    {
        $validatedAttributes = $request->validated();

        $updateStatus = $this->userService->update($validatedAttributes, $userId);
        if ($updateStatus) {
            $notifyStatus   = 'success';
            $notifyTitle    = __('messages.info.operation.successful');
            $notifyMessage  = __('messages.info.operation.saved');

            return redirect(route('admin.users.index'))
                ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
        }

        $notifyStatus   = 'danger';
        $notifyTitle    = __('messages.info.operation.failed');
        $notifyMessage  = __('messages.info.operation.saving_failed');

        return back()->withInput()
            ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
    }

    /**
     * @param int $userId
     *
     * @return bool|null
     */
    public function destroy(int $userId): ?bool
    {
        return $this->userService->destroy($userId);
    }
}
