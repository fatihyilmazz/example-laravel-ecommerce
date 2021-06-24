<?php

namespace App\Http\Controllers\Admin\Product;

use App\Filters\ProductFilter;
use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\Product\FilterProduct;
use App\Http\Requests\Admin\Product\StoreProduct;
use App\Product;
use App\Services\BrandService;
use App\Services\CategoryService;
use App\Services\CurrencyService;
use App\Services\LocaleService;
use App\Services\ProductService;
use App\Services\TaxRateService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class ProductController extends BaseController
{
    /**
     * @var ProductService
     */
    protected $productService;

    /**
     * @var CategoryService
     */
    protected $categoryService;

    /**
     * @var BrandService
     */
    protected $brandService;

    /**
     * @param ProductService $productService
     * @param CategoryService $categoryService
     * @param BrandService $brandService
     */
    public function __construct(
        ProductService $productService,
        CategoryService $categoryService,
        BrandService $brandService
    ) {
        $this->productService   = $productService;
        $this->categoryService  = $categoryService;
        $this->brandService     = $brandService;
    }

    /**
     * @param FilterProduct $request
     *
     * @return View
     */
    public function index(FilterProduct $request): View
    {
        $request->validated();

        $productFilter = $this->productService->prepareProductFilter($request);
        if (!($productFilter instanceof ProductFilter)) {
            abort(Response::HTTP_NOT_FOUND);
        }

        $productFilter->setPaginateRoute(route('admin.categories.index'));
        $productFilter->setFetchType(ProductFilter::FETCH_TYPE_PAGINATE);

        $products   = $this->productService->getProductsByProductFilter($productFilter);
        $categories = $this->categoryService->pluckAllCategoriesIdAndName();
        $brands     = $this->brandService->pluckAllBrandsIdAndName();

        return view('admin.product.index')
            ->with(compact('products', 'categories', 'brands'));
    }

    /**
     * @param BrandService $brandService
     * @param CurrencyService $currencyService
     * @param TaxRateService $taxRateService
     * @param CategoryService $categoryService
     * @param LocaleService $localeService
     *
     * @return View
     */
    public function create(
        BrandService $brandService,
        CurrencyService $currencyService,
        TaxRateService $taxRateService,
        CategoryService $categoryService,
        LocaleService $localeService
    ): View {
        //$productTypes = $this->productService->pluckAllActiveProductTypes();
        $brands     = $brandService->pluckAllActiveBrandsIdAndName();
        $currencies = $currencyService->pluckAllActiveCurrencies();
        $taxRates   = $taxRateService->pluckAllActiveTaxRates();
        $categories = $categoryService->pluckActiveCategoriesIdAndName();
        //$suppliers = $supplierService->pluckAllActiveSuppliers();
        $locales    = $localeService->getSupportedLocales();

        return view('admin.product.form')
            ->with(compact('brands', 'currencies', 'taxRates', 'categories', 'locales'));
    }

    /**
     * @param StoreProduct $request
     *
     * @return RedirectResponse
     *
     * @throws Throwable
     */
    public function store(StoreProduct $request): RedirectResponse
    {
        $validatedAttributes = $request->validated();

        $product = $this->productService->create($validatedAttributes);
        if ($product instanceof Product) {
            $notifyStatus   = 'success';
            $notifyTitle    = __('messages.info.operation.successful');
            $notifyMessage  = __('messages.info.operation.saved');

            return redirect(route('admin.products.index'))
                ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
        }

        $notifyStatus   = 'danger';
        $notifyTitle    = __('messages.info.operation.failed');
        $notifyMessage  = __('messages.info.operation.saving_failed');

        return back()->withInput()
            ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
    }

    /**
     * @param int $productId
     * @param BrandService $brandService
     * @param CurrencyService $currencyService
     * @param TaxRateService $taxRateService
     * @param CategoryService $categoryService
     * @param LocaleService $localeService
     *
     * @return View
     */
    public function edit(
        int $productId,
        BrandService $brandService,
        CurrencyService $currencyService,
        TaxRateService $taxRateService,
        CategoryService $categoryService,
        LocaleService $localeService
    ): View {
        //$productTypes = $this->productService->pluckAllActiveProductTypes();
        $brands     = $brandService->pluckAllActiveBrandsIdAndName();
        $currencies = $currencyService->pluckAllActiveCurrencies();
        $taxRates   = $taxRateService->pluckAllActiveTaxRates();
        $categories = $categoryService->pluckActiveCategoriesIdAndName();
        //$suppliers  = $supplierService->pluckAllActiveSuppliers();
        $locales    = $localeService->getSupportedLocales();
        $product    = $this->productService->getProductById($productId);

        html()->model($product);

        return view('admin.product.form')
            ->with(compact('brands', 'currencies', 'taxRates', 'categories', 'locales', 'product'));
    }

    /**
     * @param StoreProduct $request
     * @param int $productId
     *
     * @return RedirectResponse
     *
     * @throws Throwable
     */
    public function update(StoreProduct $request, int $productId): RedirectResponse
    {
        $validatedAttributes = $request->validated();

        $updateStatus = $this->productService->update($validatedAttributes, $productId);
        if ($updateStatus) {
            $notifyStatus   = 'success';
            $notifyTitle    = __('messages.info.operation.successful');
            $notifyMessage  = __('messages.info.operation.saved');

            return redirect(route('admin.products.index'))
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
     * @param int $productId
     *
     * @return bool|null
     */
    public function destroy(int $productId): ?bool
    {
        return $this->productService->destroy($productId);
    }
}
