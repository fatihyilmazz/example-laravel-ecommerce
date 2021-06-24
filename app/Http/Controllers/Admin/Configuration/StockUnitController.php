<?php

namespace App\Http\Controllers\Admin\Configuration;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\Configuration\FilterStockUnit;
use App\Http\Requests\Admin\Configuration\StoreStockUnit;
use App\Services\LocaleService;
use App\Services\StockUnitService;
use App\StockUnit;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class StockUnitController extends BaseController
{
    /**
     * @var StockUnitService
     */
    protected $stockUnitService;

    /**
     * @param StockUnitService $stockUnitService
     */
    public function __construct(StockUnitService $stockUnitService)
    {
        $this->stockUnitService = $stockUnitService;
    }

    /**
     * @param FilterStockUnit $request
     *
     * @return View
     */
    public function index(FilterStockUnit $request): View
    {
        $request->validated();

        $stockUnits = $this->stockUnitService->getStockUnitsByFilter($request);

        return view('admin.stock_unit.index')
            ->with(compact('stockUnits'));
    }

    /**
     * @param LocaleService $localeService
     *
     * @return View
     */
    public function create(LocaleService $localeService): View
    {
        $stockUnits = $this->stockUnitService->pluckAllActiveStockUnits();
        $locales    = $localeService->getSupportedLocales();

        return view('admin.stock_unit.form')
            ->with(compact('stockUnits', 'locales'));
    }

    /**
     * @param StoreStockUnit $request
     *
     * @return RedirectResponse
     *
     * @throws \Throwable
     */
    public function store(StoreStockUnit $request): RedirectResponse
    {
        $validatedAttributes = $request->validated();

        $stockUnit = $this->stockUnitService->create($validatedAttributes);
        if ($stockUnit instanceof StockUnit) {
            $notifyStatus   = 'success';
            $notifyTitle    = __('messages.info.operation.successful');
            $notifyMessage  = __('messages.info.operation.saved');

            return redirect(route('admin.stock_units.index'))
                ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
        }

        $notifyStatus   = 'danger';
        $notifyTitle    = __('messages.info.operation.failed');
        $notifyMessage  = __('messages.info.operation.saving_failed');

        return back()->withInput()
            ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
    }

    /**
     * @param int $stockUnitId
     * @param LocaleService $localeService
     *
     * @return View
     */
    public function edit(int $stockUnitId, LocaleService $localeService): View
    {
        $stockUnit  = $this->stockUnitService->getStockUnitById($stockUnitId);
        $stockUnits = $this->stockUnitService->pluckAllActiveStockUnits();
        $locales    = $localeService->getSupportedLocales();

        html()->model($stockUnit);

        return view('admin.stock_unit.form')
            ->with(compact('stockUnit', 'stockUnits', 'locales'));
    }

    /**
     * @param StoreStockUnit $request
     * @param int $stockUnitId
     *
     * @return RedirectResponse
     *
     * @throws \Throwable
     */
    public function update(StoreStockUnit $request, int $stockUnitId): RedirectResponse
    {
        $validatedAttributes = $request->validated();

        $updateStatus = $this->stockUnitService->update($validatedAttributes, $stockUnitId);
        if ($updateStatus) {
            $notifyStatus   = 'success';
            $notifyTitle    = __('messages.info.operation.successful');
            $notifyMessage  = __('messages.info.operation.saved');

            return redirect(route('admin.stock_units.index'))
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
     * @param int $stockUnitId
     *
     * @return bool|null
     */
    public function destroy(int $stockUnitId): ?bool
    {
        return $this->stockUnitService->destroy($stockUnitId);
    }
}
