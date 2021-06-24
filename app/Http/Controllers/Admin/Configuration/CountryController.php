<?php

namespace App\Http\Controllers\Admin\Configuration;

use App\Country;
use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\Configuration\FilterCountry;
use App\Http\Requests\Admin\Configuration\StoreCountry;
use App\Services\LocaleService;
use App\Services\LocationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CountryController extends BaseController
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
     * @param FilterCountry $request
     *
     * @return View
     */
    public function index(FilterCountry $request): View
    {
        $request->validated();

        $countries = $this->locationService->getCountriesByFilter($request);

        return view('admin.country.index')
            ->with(compact('countries'));
    }

    /**
     * @param LocaleService $localeService
     *
     * @return View
     */
    public function create(LocaleService $localeService): View
    {
        $locales = $localeService->getSupportedLocales();

        return view('admin.country.form')
            ->with(compact('locales'));
    }

    /**
     * @param StoreCountry $request
     *
     * @return RedirectResponse
     *
     * @throws \Throwable
     */
    public function store(StoreCountry $request): RedirectResponse
    {
        $validatedAttributes = $request->validated();

        $country = $this->locationService->createCountry($validatedAttributes);
        if ($country instanceof Country) {
            $notifyStatus   = 'success';
            $notifyTitle    = __('messages.info.operation.successful');
            $notifyMessage  = __('messages.info.operation.saved');

            return redirect(route('admin.countries.index'))
                ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
        }

        $notifyStatus   = 'danger';
        $notifyTitle    = __('messages.info.operation.failed');
        $notifyMessage  = __('messages.info.operation.saving_failed');

        return back()
            ->withInput()
            ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
    }

    /**
     * @param int $countryId
     * @param LocaleService $localeService
     *
     * @return View
     */
    public function edit(int $countryId, LocaleService $localeService): View
    {
        $country = $this->locationService->getCountryById($countryId);
        $locales = $localeService->getSupportedLocales();

        html()->model($country);

        return view('admin.country.form')
            ->with(compact('locales', 'country'));
    }

    /**
     * @param StoreCountry $request
     * @param int $countryId
     *
     * @return RedirectResponse
     *
     * @throws \Throwable
     */
    public function update(StoreCountry $request, int $countryId): RedirectResponse
    {
        $validatedAttributes = $request->validated();

        $updateStatus = $this->locationService->updateCountry($validatedAttributes, $countryId);
        if ($updateStatus) {
            $notifyStatus   = 'success';
            $notifyTitle    = __('messages.info.operation.successful');
            $notifyMessage  = __('messages.info.operation.saved');

            return redirect(route('admin.countries.index'))
                ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
        }

        $notifyStatus   = 'danger';
        $notifyTitle    = __('messages.info.operation.failed');
        $notifyMessage  = __('messages.info.operation.saving_failed');

        return back()
            ->withInput()
            ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
    }

    /**
     * @param int $countryId
     *
     * @return bool|null
     */
    public function destroy(int $countryId): ?bool
    {
        return $this->locationService->destroyCountry($countryId);
    }
}
