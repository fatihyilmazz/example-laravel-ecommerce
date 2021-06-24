<?php

namespace App\Http\Controllers\Admin\Configuration;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\Configuration\FilterProvince;
use App\Http\Requests\Admin\Configuration\StoreProvince;
use App\Province;
use App\Services\LocaleService;
use App\Services\LocationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class ProvinceController extends BaseController
{
    /**
     * @var LocationService
     */
    protected $locationService;

    /**
     * @param LocationService $locationService
     */
    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
    }

    /**
     * @param FilterProvince $request
     *
     * @return View
     */
    public function index(FilterProvince $request): View
    {
        $request->validated();

        $provinces = $this->locationService->getProvincesByFilter($request);

        return view('admin.province.index')
            ->with(compact('provinces'));
    }

    /**
     * @param LocaleService $localeService
     *
     * @return View
     */
    public function create(LocaleService $localeService): View
    {
        $countries  = $this->locationService->getAllActiveCountries();
        $locales    = $localeService->getSupportedLocales();

        return view('admin.province.form')
            ->with(compact('countries', 'locales'));
    }

    /**
     * @param StoreProvince $request
     *
     * @return RedirectResponse
     *
     * @throws \Throwable
     */
    public function store(StoreProvince $request): RedirectResponse
    {
        $validatedAttributes = $request->validated();

        $province = $this->locationService->createProvince($validatedAttributes);
        if ($province instanceof Province) {
            $notifyStatus   = 'success';
            $notifyTitle    = __('messages.info.operation.successful');
            $notifyMessage  = __('messages.info.operation.saved');

            return redirect(route('admin.provinces.index'))
                ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
        }

        $notifyStatus   = 'danger';
        $notifyTitle    = __('messages.info.operation.failed');
        $notifyMessage  = __('messages.info.operation.saving_failed');

        return back()->withInput()
            ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
    }

    /**
     * @param int $provinceId
     * @param LocaleService $localeService
     *
     * @return View
     */
    public function edit(int $provinceId, LocaleService $localeService): View
    {
        $province   = $this->locationService->getProvinceById($provinceId);
        $countries  = $this->locationService->getAllActiveCountries();
        $locales    = $localeService->getSupportedLocales();

        html()->model($province);

        return view('admin.province.form')
            ->with(compact('province', 'countries', 'locales'));
    }

    /**
     * @param StoreProvince $request
     * @param int $provinceId
     *
     * @return RedirectResponse
     *
     * @throws \Throwable
     */
    public function update(StoreProvince $request, int $provinceId): RedirectResponse
    {
        $validatedAttributes = $request->validated();

        $updateStatus = $this->locationService->updateProvince($validatedAttributes, $provinceId);
        if ($updateStatus) {
            $notifyStatus   = 'success';
            $notifyTitle    = __('messages.info.operation.successful');
            $notifyMessage  = __('messages.info.operation.saved');

            return redirect(route('admin.provinces.index'))
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
     * @param int $provinceId
     *
     * @return bool|null
     */
    public function destroy(int $provinceId): ?bool
    {
        return $this->locationService->destroyProvince($provinceId);
    }
}
