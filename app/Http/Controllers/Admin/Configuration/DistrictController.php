<?php

namespace App\Http\Controllers\Admin\Configuration;

use App\District;
use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\Configuration\FilterDistrict;
use App\Http\Requests\Admin\Configuration\StoreDistrict;
use App\Services\LocaleService;
use App\Services\LocationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class DistrictController extends BaseController
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
     * @param FilterDistrict $request
     *
     * @return View
     */
    public function index(FilterDistrict $request): View
    {
        $request->validated();

        $districts = $this->locationService->getDistrictsByFilter($request);

        return view('admin.district.index')
            ->with(compact('districts'));
    }

    /**
     * @param LocaleService $localeService
     *
     * @return View
     */
    public function create(LocaleService $localeService): View
    {
        $provinces  = $this->locationService->pluckAllActiveProvinces();
        $locales    = $localeService->getSupportedLocales();

        return view('admin.district.form')
            ->with(compact('provinces', 'locales'));
    }

    /**
     * @param StoreDistrict $request
     *
     * @return RedirectResponse
     *
     * @throws \Throwable
     */
    public function store(StoreDistrict $request): RedirectResponse
    {
        $validatedAttributes = $request->validated();

        $district = $this->locationService->createDistrict($validatedAttributes);
        if ($district instanceof District) {
            $notifyStatus   = 'success';
            $notifyTitle    = __('messages.info.operation.successful');
            $notifyMessage  = __('messages.info.operation.saved');

            return redirect(route('admin.districts.index'))
                ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
        }

        $notifyStatus   = 'danger';
        $notifyTitle    = __('messages.info.operation.failed');
        $notifyMessage  = __('messages.info.operation.saving_failed');

        return back()->withInput()
            ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
    }

    /**
     * @param int $districtId
     * @param LocaleService $localeService
     *
     * @return View
     */
    public function edit(int $districtId, LocaleService $localeService): View
    {
        $district   = $this->locationService->getDistrictById($districtId);
        $provinces  = $this->locationService->pluckAllActiveProvinces();
        $locales    = $localeService->getSupportedLocales();

        html()->model($district);

        return view('admin.district.form')
            ->with(compact('district', 'provinces', 'locales'));
    }

    /**
     * @param StoreDistrict $request
     * @param int $districtId
     *
     * @return RedirectResponse
     *
     * @throws \Throwable
     */
    public function update(StoreDistrict $request, int $districtId): RedirectResponse
    {
        $validatedAttributes = $request->validated();

        $updateStatus = $this->locationService->updateDistrict($validatedAttributes, $districtId);
        if ($updateStatus) {
            $notifyStatus   = 'success';
            $notifyTitle    = __('messages.info.operation.successful');
            $notifyMessage  = __('messages.info.operation.saved');

            return redirect(route('admin.districts.index'))
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
     * @param int $districtId
     *
     * @return bool|null
     */
    public function destroy(int $districtId): ?bool
    {
        return $this->locationService->destroyDistrict($districtId);
    }
}
