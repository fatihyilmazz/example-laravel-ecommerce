<?php

namespace App\Repositories;

use App\Filters\ProductFilter;
use App\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductRepository extends BaseRepository
{
    /**
     * @var Product
     */
    protected $product;

    /**
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        parent::__construct($product);

        $this->product = $product;
    }

    /**
     * @param int $productId
     *
     * @return Product|Model|null
     */
    public function getProductById(int $productId): ?Product
    {
        return $this->product
            ->with([
                'categories:category_id,is_main',
                'images',
                'files',
                'translations',
            ])
            ->find($productId);
    }

    /**
     * @param ProductFilter $productFilter
     *
     * @return LengthAwarePaginator|Collection|Product|Model
     */
    public function getProductsByProductFilter(ProductFilter $productFilter)
    {
        //TODO Ürünün hangi bilgilerinin geleceğine kadar verecek bir özellik eklenecek.
        $product = $this->product;

        if ($productFilter->getProductIds()->isNotEmpty()) {
            $product = $product->whereIn('id', $productFilter->getProductIds());
        }

        if (!empty($productFilter->getName())) {
            $product = $product->whereHas('translations', static function (Builder $query) use ($productFilter) {
                $query->where('name', 'LIKE', "%{$productFilter->getName()}%")
                    ->where('locale', '=', app()->getLocale());
            });
        }

        if (!empty($productFilter->getSlug())) {
            $product = $product->whereHas('translations', static function (Builder $query) use ($productFilter) {
                $query->where('slug', '=', $productFilter->getSlug())
                    ->where('locale', '=', app()->getLocale());
            });
        }

        if ($productFilter->getCategoryIds()->isNotEmpty()) {
            $product = $product->whereHas('categories', static function (Builder $query) use ($productFilter) {
                $query->whereIn('category_id', $productFilter->getCategoryIds());
            });
        }

        if ($productFilter->getBrandIds()->isNotEmpty()) {
            $product = $product->whereIn('brand_id', $productFilter->getBrandIds());
        }

        if ($productFilter->getRowNumbers()->isNotEmpty()) {
            $product = $product->whereIn('row', $productFilter->getRowNumbers());
        }

        if (!is_null($productFilter->isActive())) {
            $product = $product->where('is_active', $productFilter->isActive());
        }

        $product = $product->with(['translationForCurrentLocale']);

        $product = $product->orderBy($productFilter->getOrderBy(), $productFilter->getSortBy());

        if ($productFilter->getFetchType() === ProductFilter::FETCH_TYPE_PAGINATE) {
            return $product
                ->paginate($productFilter->getPerPage())
                ->setPath($productFilter->getPaginateRoute());
        } elseif ($productFilter->getFetchType() === ProductFilter::FETCH_TYPE_COLLECT) {
            return $product->get();
        }

        return $product->first();
    }
}
