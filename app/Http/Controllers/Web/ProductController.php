<?php

namespace App\Http\Controllers\Web;

use App\Filters\ProductFilter;
use App\Product;
use App\Services\ProductService;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends BaseController
{
    /**
     * @var ProductService
     */
    protected $productService;

    /**
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        parent::__construct();

        $this->productService = $productService;
    }

    /**
     * @param string $slug
     *
     * @return View
     */
    public function detail(string $slug): View
    {
        $productFilter = new ProductFilter();
        $productFilter->setSlug($slug);
        $productFilter->setFetchType(ProductFilter::FETCH_TYPE_MODEL);

        $product = $this->productService->getProductsByProductFilter($productFilter);
        if (!($product instanceof Product)) {
            abort(Response::HTTP_NOT_FOUND);
        }

        return view($this->generateView('product.detail'))
            ->with(compact('product'));
    }
}
