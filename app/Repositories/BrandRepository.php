<?php

namespace App\Repositories;

use App\Brand;
use App\Facades\Setting;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class BrandRepository extends BaseRepository
{
    /**
     * @var Brand
     */
    protected $brand;

    /**
     * @param Brand $brand
     */
    public function __construct(Brand $brand)
    {
        parent::__construct($brand);

        $this->brand = $brand;
    }

    /**
     * @param Request $request
     *
     * @return LengthAwarePaginator
     */
    public function getBrandsByFilter(Request $request): LengthAwarePaginator
    {
        $brand = $this->brand;

        if ($request->has('id') && !empty($request->request->getInt('id'))) {
            $brand = $brand->where('id', $request->request->getInt('id'));
        }

        if ($request->has('name') && !empty($request->request->get('name'))) {
            $brand = $brand->where('name', 'LIKE', "%{$request->request->get('name')}%");
        }

        if ($request->has('order') && !empty($request->request->getInt('order'))) {
            $brand = $brand->where('order', $request->request->getInt('order'));
        }

        if ($request->has('is_active') && !is_null($request->get('is_active'))) {
            $brand = $brand->where('is_active', $request->request->getBoolean('is_active'));
        }

        return $brand->orderBy('id', 'DESC')
            ->paginate($request->has('per_page') ?
                $request->request->getInt('per_page') :
                Setting::get('pagination_item_per_page', \App\Setting::PAGINATION_ITEM_PER_PAGE))
            ->setPath(route('admin.brands.index'));
    }

    /**
     * @return Collection
     */
    public function pluckAllActiveBrandsIdAndName(): Collection
    {
        return $this->brand->active()->orderBy('name', 'ASC')->pluck('name', 'id');
    }

    /**
     * @param array $brandIds
     *
     * @return Collection
     */
    public function getSelectedBrandsByIds(array $brandIds): Collection
    {
        return $this->brand
            ->whereIn('id', $brandIds)
            ->get();
    }

    /**
     * @return Collection
     */
    public function pluckAllBrandsIdAndName(): Collection
    {
        return $this->brand->orderBy('name', 'ASC')->pluck('name', 'id');
    }
}
