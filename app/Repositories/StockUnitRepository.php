<?php

namespace App\Repositories;

use App\Facades\Setting;
use App\StockUnit;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class StockUnitRepository extends BaseRepository
{
    /**
     * @var StockUnit
     */
    protected $stockUnit;

    /**
     * @param StockUnit $stockUnit
     */
    public function __construct(StockUnit $stockUnit)
    {
        parent::__construct($stockUnit);

        $this->stockUnit = $stockUnit;
    }

    /**
     * @param Request $request
     *
     * @return LengthAwarePaginator
     */
    public function getStockUnitsByFilter(Request $request): LengthAwarePaginator
    {
        $stockUnit = $this->stockUnit;

        if ($request->has('id') && !empty($request->request->getInt('id'))) {
            $stockUnit = $stockUnit->where('id', $request->request->getInt('id'));
        }

        if ($request->has('name') && !empty($request->request->get('name'))) {
            $stockUnit = $stockUnit->whereHas('translations', static function (Builder $query) use ($request) {
                $query->where('name', 'LIKE', "%{$request->request->get('name')}%")
                    ->where('locale', '=', app()->getLocale());
            });
        }

        if ($request->has('order') && !empty($request->request->getInt('order'))) {
            $stockUnit = $stockUnit->where('order', $request->request->getInt('order'));
        }

        if ($request->has('is_active') && !is_null($request->get('is_active'))) {
            $stockUnit = $stockUnit->where('is_active', $request->request->getBoolean('is_active'));
        }

        $stockUnit = $stockUnit->with([
            'parent',
        ]);

        return $stockUnit->orderBy('id', 'DESC')
        ->paginate($request->has('per_page') ?
            $request->request->getInt('per_page') :
            Setting::get('pagination_item_per_page', \App\Setting::PAGINATION_ITEM_PER_PAGE))
        ->setPath(route('admin.stock_units.index'));
    }

    /**
     * @param int $stockUnitId
     *
     * @return StockUnit|Model|null
     */
    public function getStockUnitById(int $stockUnitId): ?StockUnit
    {
        return $this->stockUnit
            ->without(['translationForCurrentLocale'])
            ->with(['translations'])
            ->find($stockUnitId);
    }

    /**
     * @return Collection
     */
    public function pluckAllActiveStockUnits(): Collection
    {
        return $this->stockUnit
            ->active()
            ->join('stock_unit_translations', static function (JoinClause $join) {
                $join->on('stock_units.id', '=', 'stock_unit_translations.stock_unit_id')
                    ->where('stock_unit_translations.locale', '=', app()->getLocale());
            })
            ->orderBy('name')
            ->select('stock_units.id', 'stock_unit_translations.name')
            ->pluck('name', 'id');
    }
}
