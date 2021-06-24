<?php

namespace App\Repositories;

use App\Currency;
use App\Facades\Setting;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CurrencyRepository extends BaseRepository
{
    /**
     * @var Currency
     */
    protected $currency;

    /**
     * @param Currency $currency
     */
    public function __construct(Currency $currency)
    {
        parent::__construct($currency);

        $this->currency = $currency;
    }

    /**
     * @param Request $request
     *
     * @return LengthAwarePaginator
     */
    public function getCurrenciesByFilter(Request $request): LengthAwarePaginator
    {
        $currency = $this->currency;

        if ($request->has('id') && !empty($request->request->getInt('id'))) {
            $currency = $currency->where('id', $request->request->getInt('id'));
        }

        if ($request->has('name') && !empty($request->request->get('name'))) {
            $currency = $currency->where('name', 'LIKE', "%{$request->request->get('name')}%");
        }

        if ($request->has('order') && !empty($request->request->getInt('order'))) {
            $currency = $currency->where('order', $request->request->getInt('order'));
        }

        if ($request->has('is_active') && !is_null($request->get('is_active'))) {
            $currency = $currency->where('is_active', $request->request->getBoolean('is_active'));
        }

        return $currency->orderBy('id', 'DESC')
        ->paginate($request->has('per_page') ?
            $request->request->getInt('per_page') :
            Setting::get('pagination_item_per_page', \App\Setting::PAGINATION_ITEM_PER_PAGE))
        ->setPath(route('admin.currencies.index'));
    }

    /**
     * @return Collection
     */
    public function pluckAllActiveCurrenciesWithCode(): Collection
    {
        return $this->currency->active()->orderBy('code', 'ASC')->pluck('code', 'id');
    }
}
