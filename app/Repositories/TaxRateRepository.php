<?php

namespace App\Repositories;

use App\Facades\Setting;
use App\TaxRate;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class TaxRateRepository extends BaseRepository
{
    /**
     * @var TaxRate
     */
    protected $taxRate;

    /**
     * @param TaxRate $taxRate
     */
    public function __construct(TaxRate $taxRate)
    {
        parent::__construct($taxRate);

        $this->taxRate = $taxRate;
    }

    /**
     * @param Request $request
     *
     * @return LengthAwarePaginator
     */
    public function getTaxRatesByFilter(Request $request): LengthAwarePaginator
    {
        $taxRate = $this->taxRate;

        if ($request->has('id') && !empty($request->request->getInt('id'))) {
            $taxRate = $taxRate->where('id', $request->request->getInt('id'));
        }

        if ($request->has('name') && !empty($request->request->get('name'))) {
            $taxRate = $taxRate->where('name', 'LIKE', "%{$request->request->get('name')}%");
        }

        if ($request->has('order') && !empty($request->request->getInt('order'))) {
            $taxRate = $taxRate->where('order', $request->request->getInt('order'));
        }

        if ($request->has('is_active') && !is_null($request->get('is_active'))) {
            $taxRate = $taxRate->where('is_active', $request->request->getBoolean('is_active'));
        }

        return $taxRate->orderBy('id', 'DESC')
        ->paginate($request->has('per_page') ?
            $request->request->getInt('per_page') :
            Setting::get('pagination_item_per_page', \App\Setting::PAGINATION_ITEM_PER_PAGE))
        ->setPath(route('admin.tax_rates.index'));
    }

    /**
     * @return Collection
     */
    public function pluckAllActiveTaxRates(): Collection
    {
        return $this->taxRate->active()->orderBy('name', 'ASC')->pluck('name', 'id');
    }
}
