<?php

namespace App\Http\Controllers\Admin\Configuration;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\Configuration\UpdateGeneral;
use App\Services\SettingService;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class GeneralController extends BaseController
{
    /**
     * @var SettingService
     */
    protected $settingService;

    /**
     * @param SettingService $settingService
     */
    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $settings = $this->settingService->pluckAllSettings();
        if ($settings instanceof Collection) {
            abort(Response::HTTP_NOT_FOUND);
        }

        return view('admin.configuration.index')
            ->with(compact('settings'));
    }

    /**
     * @param UpdateGeneral $request
     *
     * @return RedirectResponse
     */
    public function update(UpdateGeneral $request): RedirectResponse
    {
        $validatedAttributes = $request->validated();

        $updateStatus = $this->settingService->update($validatedAttributes);
        if ($updateStatus) {
            $notifyStatus   = 'success';
            $notifyTitle    = __('messages.info.operation.successful');
            $notifyMessage  = __('messages.info.operation.saved');

            return redirect(route('admin.configuration.general.index'))
                ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
        }

        $notifyStatus   = 'danger';
        $notifyTitle    = __('messages.info.operation.failed');
        $notifyMessage  = __('messages.info.operation.saving_failed');

        return back()->withInput()
            ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
    }
}
