<?php

namespace App\Http\Controllers\Admin\Configuration;

use App\Http\Controllers\Admin\BaseController;
use App\TaxRate;
use App\Http\Requests\Admin\Configuration\FilterTaxRate;
use App\Http\Requests\Admin\Configuration\StoreTaxRate;
use App\Services\TaxRateService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class TaxRateController extends BaseController
{
    /**
     * @var TaxRateService
     */
    protected $taxRateService;

    /**
     * @param TaxRateService $taxRateService
     */
    public function __construct(TaxRateService $taxRateService)
    {
        $this->taxRateService = $taxRateService;
    }

    /**
     * @param FilterTaxRate $request
     *
     * @return View
     */
    public function index(FilterTaxRate $request): View
    {
        $request->validated();

        $taxRates = $this->taxRateService->getTaxRatesByFilter($request);

        return view('admin.tax_rate.index')
            ->with(compact('taxRates'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('admin.tax_rate.form');
    }

    /**
     * @param StoreTaxRate $request
     *
     * @return RedirectResponse
     */
    public function store(StoreTaxRate $request): RedirectResponse
    {
        $validatedAttributes = $request->validated();

        $taxRate = $this->taxRateService->create($validatedAttributes);
        if ($taxRate instanceof TaxRate) {
            $notifyStatus   = 'success';
            $notifyTitle    = __('messages.info.operation.successful');
            $notifyMessage  = __('messages.info.operation.saved');

            return redirect(route('admin.tax_rates.index'))
                ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
        }

        $notifyStatus   = 'danger';
        $notifyTitle    = __('messages.info.operation.failed');
        $notifyMessage  = __('messages.info.operation.saving_failed');

        return back()->withInput()
            ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
    }

    /**
     * @param TaxRate $taxRate
     *
     * @return View
     */
    public function edit(TaxRate $taxRate): View
    {
        html()->model($taxRate);

        return view('admin.tax_rate.form')
            ->with(compact('taxRate'));
    }

    /**
     * @param StoreTaxRate $request
     * @param int $taxRateId
     *
     * @return RedirectResponse
     */
    public function update(StoreTaxRate $request, int $taxRateId): RedirectResponse
    {
        $validatedAttributes = $request->validated();

        $updateStatus = $this->taxRateService->update($validatedAttributes, $taxRateId);
        if ($updateStatus) {
            $notifyStatus   = 'success';
            $notifyTitle    = __('messages.info.operation.successful');
            $notifyMessage  = __('messages.info.operation.saved');

            return redirect(route('admin.tax_rates.index'))
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
     * @param int $taxRateId
     *
     * @return bool|null
     */
    public function destroy(int $taxRateId): ?bool
    {
        return $this->taxRateService->destroy($taxRateId);
    }
}
