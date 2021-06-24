<?php

namespace App\Repositories;

use App\Facades\Setting;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class SupplierRepository extends BaseRepository
{
    /**
     * @var Supplier
     */
    protected $supplier;

    /**
     * @param Supplier $supplier
     */
    public function __construct(Supplier $supplier)
    {
        parent::__construct($supplier);

        $this->supplier = $supplier;
    }

    /**
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getSuppliersByFilter(Request $request): LengthAwarePaginator
    {
        $supplier = $this->supplier;

        if ($request->has('id') && !empty($request->request->getInt('id'))) {
            $supplier = $supplier->where('id', $request->request->getInt('id'));
        }

        if ($request->has('name') && !empty($request->request->get('name'))) {
            $supplier = $supplier->where('name', 'LIKE', "%{$request->request->get('name')}%");
        }

        if ($request->has('order') && !empty($request->request->getInt('order'))) {
            $supplier = $supplier->where('order', $request->request->getInt('order'));
        }

        if ($request->has('is_active') && !is_null($request->get('is_active'))) {
            $supplier = $supplier->where('is_active', $request->request->getBoolean('is_active'));
        }

        return $supplier->orderBy('id', 'DESC')
        ->paginate($request->has('per_page') ?
            $request->request->getInt('per_page') :
            Setting::get('pagination_item_per_page', \App\Setting::PAGINATION_ITEM_PER_PAGE))
        ->setPath(route('admin.suppliers.index'));
    }

    /**
     * @return Collection
     */
    public function pluckAllActiveSuppliers(): Collection
    {
        return $this->supplier->active()->orderBy('name', 'ASC')->pluck('name', 'id');
    }
}
