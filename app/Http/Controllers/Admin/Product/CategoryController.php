<?php

namespace App\Http\Controllers\Admin\Product;

use App\Category;
use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\Product\FilterCategory;
use App\Http\Requests\Admin\Product\StoreCategory;
use App\Services\LocaleService;
use App\Services\CategoryService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends BaseController
{
    /**
     * @var CategoryService
     */
    protected $categoryService;

    /**
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * @param FilterCategory $request
     *
     * @return View
     */
    public function index(FilterCategory $request): View
    {
        $request->validated();

        $categories     = $this->categoryService->getCategoriesByFilter($request);
        $allCategories  = $this->categoryService->pluckAllCategoriesIdAndName();

        return view('admin.category.index')
            ->with(compact('categories', 'allCategories'));
    }

    /**
     * @param LocaleService $localeService
     *
     * @return View
     */
    public function create(LocaleService $localeService): View
    {
        $categories = $this->categoryService->pluckActiveCategoriesIdAndName();
        $locales    = $localeService->getSupportedLocales();

        return view('admin.category.form')
            ->with(compact('categories', 'locales'));
    }

    /**
     * @param StoreCategory $request
     *
     * @return RedirectResponse
     *
     * @throws \Throwable
     */
    public function store(StoreCategory $request): RedirectResponse
    {
        $validatedAttributes = $request->validated();

        $category = $this->categoryService->create($validatedAttributes);
        if ($category instanceof Category) {
            $notifyStatus   = 'success';
            $notifyTitle    = __('messages.info.operation.successful');
            $notifyMessage  = __('messages.info.operation.saved');

            return redirect(route('admin.categories.index'))
                ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
        }

        $notifyStatus   = 'danger';
        $notifyTitle    = __('messages.info.operation.failed');
        $notifyMessage  = __('messages.info.operation.saving_failed');

        return back()->withInput()
            ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
    }

    /**
     * @param int $categoryId
     * @param LocaleService $localeService
     *
     * @return View
     */
    public function edit(int $categoryId, LocaleService $localeService): View
    {
        $category   = $this->categoryService->getCategoryById($categoryId);
        $categories = $this->categoryService->pluckActiveCategoriesIdAndName();
        $locales    = $localeService->getSupportedLocales();

        html()->model($category);

        return view('admin.category.form')
            ->with(compact('category', 'categories', 'locales'));
    }

    /**
     * @param StoreCategory $request
     * @param int $categoryId
     *
     * @return RedirectResponse
     *
     * @throws \Throwable
     */
    public function update(StoreCategory $request, int $categoryId): RedirectResponse
    {
        $validatedAttributes = $request->validated();

        $updateStatus = $this->categoryService->update($validatedAttributes, $categoryId);
        if ($updateStatus) {
            $notifyStatus   = 'success';
            $notifyTitle    = __('messages.info.operation.successful');
            $notifyMessage  = __('messages.info.operation.saved');

            return redirect(route('admin.categories.index'))
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
     * @param int $categoryId
     *
     * @return bool|null
     */
    public function destroy(int $categoryId): ?bool
    {
        return $this->categoryService->destroy($categoryId);
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
//        return view('admin.common.transaction-history-for-translation', [
//            'modelName' => 'category',
//            'transactions' => $activityLogService->getTransactionHistoriesByModel($request, Category::class, 'category'),
//            'causers' => $userService->getAllPanelUsersIdAndNameWithTrashed()->toArray(),
//            'subjects' => $this->categoryService->getPluckAllCategoriesWithTrashed()->toArray(),
//        ]);
//    }
}
