<?php

namespace App\Http\Controllers\Admin\Product;

use App\Brand;
use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\Product\FilterBrand;
use App\Http\Requests\Admin\Product\StoreBrand;
use App\Services\BrandService;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;

class BrandController extends BaseController
{
    /**
     * @var BrandService
     */
    protected $brandService;

    /**
     * @param BrandService $brandService
     */
    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }

    /**
     * @param FilterBrand $request
     *
     * @return View
     */
    public function index(FilterBrand $request): View
    {
        $request->validated();

        $brands = $this->brandService->getBrandsByFilter($request);

        return view('admin.brand.index')
            ->with(compact('brands'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('admin.brand.form');
    }

    /**
     * @param StoreBrand $request
     *
     * @return RedirectResponse
     */
    public function store(StoreBrand $request): RedirectResponse
    {
        $validatedAttributes = $request->validated();

        $brand = $this->brandService->create($validatedAttributes);

        if ($brand instanceof Model) {
            $notifyStatus   = 'success';
            $notifyTitle    = __('messages.info.operation.successful');
            $notifyMessage  = __('messages.info.operation.saved');

            return redirect(route('admin.brands.index'))
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
     * @param Brand $brand
     *
     * @return View
     */
    public function edit(Brand $brand): View
    {
        html()->model($brand);

        return view('admin.brand.form')
            ->with(compact('brand'));
    }

    /**
     * @param StoreBrand $request
     * @param int $brandId
     *
     * @return RedirectResponse
     */
    public function update(StoreBrand $request, int $brandId): RedirectResponse
    {
        $validatedAttributes = $request->validated();

        $updateStatus = $this->brandService->update($validatedAttributes, $brandId);
        if ($updateStatus) {
            $notifyStatus   = 'success';
            $notifyTitle    = __('messages.info.operation.successful');
            $notifyMessage  = __('messages.info.operation.saved');

            return redirect(route('admin.brands.index'))
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
     * @param int $brandId
     *
     * @return bool|null
     */
    public function destroy(int $brandId): ?bool
    {
        return $this->brandService->destroy($brandId);
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
//            'modelName' => 'brand',
//            'transactions' => $activityLogService->getTransactionHistoriesByModel($request, Brand::class, 'brand'),
//            'causers' => $userService->getAllPanelUsersIdAndNameWithTrashed()->toArray(),
//            'subjects' => $this->brandService->getAllIdAndNameWithTrashed()->toArray(),
//        ]);
//    }
}
