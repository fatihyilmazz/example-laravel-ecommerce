<?php

namespace App\Http\Controllers\Admin\Configuration;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\Configuration\UpdateLocale;
use App\Locale;
use App\Services\LocaleService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class LocaleController extends BaseController
{
    /**
     * @var LocaleService
     */
    protected $localeService;

    /**
     * @param LocaleService $localeService
     */
    public function __construct(LocaleService $localeService)
    {
        $this->localeService = $localeService;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $locales = $this->localeService->getActiveLocales();

        return view('admin.locale.index')
            ->with(compact('locales'));
    }

    /**
     * @param Locale $locale
     *
     * @return View
     */
    public function edit(Locale $locale): View
    {
        html()->model($locale);

        return view('admin.locale.form')
            ->with(compact('locale'));
    }

    /**
     * @param UpdateLocale $request
     * @param int $localeId
     *
     * @return RedirectResponse
     */
    public function update(UpdateLocale $request, int $localeId): RedirectResponse
    {
        $validatedAttributes = $request->validated();

        $updateStatus = $this->localeService->update($validatedAttributes, $localeId);
        if ($updateStatus) {
            $notifyStatus   = 'success';
            $notifyTitle    = __('messages.info.operation.successful');
            $notifyMessage  = __('messages.info.operation.saved');

            return redirect(route('admin.locales.index'))
                ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
        }

        $notifyStatus   = 'danger';
        $notifyTitle    = __('messages.info.operation.failed');
        $notifyMessage  = __('messages.info.operation.saving_failed');

        return back()->withInput()
            ->setStatusCode(Response::HTTP_NOT_FOUND)
            ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
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
//        return view('admin.common.transaction-history', [
//            'modelName' => 'locale',
//            'transactions' => $activityLogService->getTransactionHistoriesByModel($request, Locale::class, 'locale'),
//            'causers' => $userService->getAllPanelUsersIdAndNameWithTrashed()->toArray(),
//            'subjects' => $this->localeService->getAllIdAndNameWithTrashed()->toArray(),
//        ]);
//    }
}
