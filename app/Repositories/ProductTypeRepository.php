<?php

namespace App\Repositories;

use App\Product;
use App\ProductType;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Collection;

class ProductTypeRepository extends BaseRepository
{
    /**
     * @var Product
     */
    protected $productType;

    /**
     * @param ProductType $productType
     */
    public function __construct(ProductType $productType)
    {
        parent::__construct($productType);

        $this->productType = $productType;
    }

    /**
     * @return Collection
     */
    public function pluckAllActiveProductTypes(): Collection
    {
        return $this->productType
            ->active()
            ->join('product_type_translations', static function (JoinClause $join) {
                $join->on('product_types.id', '=', 'product_type_translations.product_type_id')
                    ->where('product_type_translations.locale', '=', app()->getLocale());
            })
            ->orderBy('name')
            ->select('product_types.id', 'product_type_translations.name')
            ->pluck('name', 'id');
    }
}
