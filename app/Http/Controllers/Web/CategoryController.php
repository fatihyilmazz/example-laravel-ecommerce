<?php

namespace App\Http\Controllers\Web;

use App\Category;
use App\Filters\ProductFilter;
use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends BaseController
{
    /**
     * @var CategoryService
     */
    protected $categoryService;

    /**
     * @var ProductService
     */
    protected $productService;

    /**
     * @param CategoryService $categoryService
     * @param ProductService $productService
     */
    public function __construct(
        CategoryService $categoryService,
        ProductService $productService
    ) {
        parent::__construct();

        $this->categoryService = $categoryService;
        $this->productService = $productService;
    }

    /**
     * @param Request $request
     * @param string $slug
     *
     * @return View
     */
    public function index(Request $request, string $slug): View
    {
        $category = $this->categoryService->getCategoryBySlug($slug);
        if (!($category instanceof Category)) {
            abort(Response::HTTP_NOT_FOUND);
        }

        $productFilter = $this->productService->prepareProductFilter($request, $category);
        if (!($productFilter instanceof ProductFilter)) {
            abort(Response::HTTP_NOT_FOUND);
        }

        $mainCategories = $this->categoryService->pluckActiveMainCategoriesSlugAndName();
        if (!($mainCategories instanceof Collection)) {
            abort(Response::HTTP_NOT_FOUND);
        }

        $productFilter->setPaginateRoute(route('web.categories.index', ['slug' => $slug]))
            ->setFetchType(ProductFilter::FETCH_TYPE_PAGINATE);


        $products = $this->productService->getProductsByProductFilter($productFilter);
        if (!($products instanceof LengthAwarePaginator)) {
            abort(Response::HTTP_NOT_FOUND);
        }

        return view($this->generateView('category.index'))
            ->with(compact(
                'products',
                'mainCategories',
                'category'
            ));
    }
}
