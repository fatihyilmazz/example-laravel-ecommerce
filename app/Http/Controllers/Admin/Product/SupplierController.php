<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Admin\BaseController;
use App\Supplier;
use App\Http\Requests\Admin\Product\FilterSupplier;
use App\Http\Requests\Admin\Product\StoreSupplier;
use App\Services\SupplierService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class SupplierController extends BaseController
{
    /**
     * @var SupplierService
     */
    protected $supplierService;

    /**
     * @param SupplierService $supplierService
     */
    public function __construct(SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    /**
     * @param FilterSupplier $request
     *
     * @return View
     */
    public function index(FilterSupplier $request): View
    {
        $request->validated();

        $suppliers = $this->supplierService->getSuppliersByFilter($request);

        return view('admin.supplier.index')
            ->with(compact('suppliers'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('admin.supplier.form');
    }

    /**
     * @param StoreSupplier $request
     *
     * @return RedirectResponse
     */
    public function store(StoreSupplier $request): RedirectResponse
    {
        $validatedAttributes = $request->validated();

        $supplier = $this->supplierService->create($validatedAttributes);
        if ($supplier instanceof Supplier) {
            $notifyStatus   = 'success';
            $notifyTitle    = __('messages.info.operation.successful');
            $notifyMessage  = __('messages.info.operation.saved');

            return redirect(route('admin.suppliers.index'))
                ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
        }

        $notifyStatus   = 'danger';
        $notifyTitle    = __('messages.info.operation.failed');
        $notifyMessage  = __('messages.info.operation.saving_failed');

        return back()->withInput()
            ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
    }

    /**
     * @param Supplier $supplier
     *
     * @return View
     */
    public function edit(Supplier $supplier): View
    {
        html()->model($supplier);

        return view('admin.supplier.form')
            ->with(compact('supplier'));
    }

    /**
     * @param StoreSupplier $request
     * @param int $supplierId
     *
     * @return RedirectResponse
     */
    public function update(StoreSupplier $request, int $supplierId): RedirectResponse
    {
        $validatedAttributes = $request->validated();

        $updateStatus = $this->supplierService->update($validatedAttributes, $supplierId);
        if ($updateStatus) {
            $notifyStatus   = 'success';
            $notifyTitle    = __('messages.info.operation.successful');
            $notifyMessage  = __('messages.info.operation.saved');

            return redirect(route('admin.suppliers.index'))
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
     * @param int $supplierId
     *
     * @return bool|null
     */
    public function destroy(int $supplierId): ?bool
    {
        return $this->supplierService->destroy($supplierId);
    }
}
