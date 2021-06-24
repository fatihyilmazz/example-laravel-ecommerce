<?php

namespace App\Http\Controllers\Admin\Configuration;

use App\Currency;
use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\Configuration\FilterCurrency;
use App\Http\Requests\Admin\Configuration\StoreCurrency;
use App\Services\CurrencyService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class CurrencyController extends BaseController
{
    /**
     * @var CurrencyService
     */
    protected $currencyService;

    /**
     * @param CurrencyService $currencyService
     */
    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    /**
     * @param FilterCurrency $request
     *
     * @return View
     */
    public function index(FilterCurrency $request): View
    {
        $request->validated();

        $currencies = $this->currencyService->getCurrenciesByFilter($request);

        return view('admin.currency.index')
            ->with(compact('currencies'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('admin.currency.form');
    }

    /**
     * @param StoreCurrency $request
     *
     * @return RedirectResponse
     */
    public function store(StoreCurrency $request): RedirectResponse
    {
        $validatedAttributes = $request->validated();

        $currency = $this->currencyService->create($validatedAttributes);
        if ($currency instanceof Currency) {
            $notifyStatus   = 'success';
            $notifyTitle    = __('messages.info.operation.successful');
            $notifyMessage  = __('messages.info.operation.saved');

            return redirect(route('admin.currencies.index'))
                ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
        }

        $notifyStatus   = 'danger';
        $notifyTitle    = __('messages.info.operation.failed');
        $notifyMessage  = __('messages.info.operation.saving_failed');

        return back()->withInput()
            ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
    }

    /**
     * @param Currency $currency
     *
     * @return View
     */
    public function edit(Currency $currency): View
    {
        html()->model($currency);

        return view('admin.currency.form')
            ->with(compact('currency'));
    }

    /**
     * @param StoreCurrency $request
     * @param int $currencyId
     *
     * @return RedirectResponse
     */
    public function update(StoreCurrency $request, int $currencyId): RedirectResponse
    {
        $validatedAttributes = $request->validated();

        $updateStatus = $this->currencyService->update($validatedAttributes, $currencyId);
        if ($updateStatus) {
            $notifyStatus   = 'success';
            $notifyTitle    = __('messages.info.operation.successful');
            $notifyMessage  = __('messages.info.operation.saved');

            return redirect(route('admin.currencies.index'))
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
     * @param int $currencyId
     *
     * @return bool|null
     */
    public function destroy(int $currencyId): ?bool
    {
        return $this->currencyService->destroy($currencyId);
    }
}
