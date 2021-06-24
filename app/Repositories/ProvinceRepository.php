<?php

namespace App\Repositories;

use App\Facades\Setting;
use App\Province;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ProvinceRepository extends BaseRepository
{
    /**
     * @var Province
     */
    protected $province;

    /**
     * @param Province $province
     */
    public function __construct(Province $province)
    {
        parent::__construct($province);

        $this->province = $province;
    }

    /**
     * @param Request $request
     *
     * @return LengthAwarePaginator
     */
    public function getProvincesByFilter(Request $request): LengthAwarePaginator
    {
        $province = $this->province;

        if ($request->has('id') && !empty($request->request->getInt('id'))) {
            $province = $province->where('id', $request->request->getInt('id'));
        }

        if ($request->has('name') && !empty($request->request->get('name'))) {
            $province = $province->whereHas('translations', static function (Builder $query) use ($request) {
                $query->where('name', 'LIKE', "%{$request->request->get('name')}%")
                    ->where('locale', '=', app()->getLocale());
            });
        }

        if ($request->has('order') && !empty($request->request->getInt('order'))) {
            $province = $province->where('order', $request->request->getInt('order'));
        }

        if ($request->has('is_active') && !is_null($request->get('is_active'))) {
            $province = $province->where('is_active', $request->request->getBoolean('is_active'));
        }

        $province = $province->with([
            'country',
        ]);

        return $province->orderBy('id', 'DESC')
            ->paginate($request->has('per_page') ?
                $request->request->getInt('per_page') :
                Setting::get('pagination_item_per_page', \App\Setting::PAGINATION_ITEM_PER_PAGE))
            ->setPath(route('admin.provinces.index'));
    }

    /**
     * @param int $provinceId
     *
     * @return Province|Model|null
     */
    public function getProvinceById(int $provinceId): ?Province
    {
        return $this->province
            ->without(['translationForCurrentLocale'])
            ->with(['translations'])
            ->find($provinceId);
    }

    /**
     * @return Collection
     */
    public function pluckAllActiveProvinces(): Collection
    {
        return $this->province
            ->active()
            ->join('province_translations', static function (JoinClause $join) {
                $join->on('provinces.id', '=', 'province_translations.province_id')
                    ->where('province_translations.locale', '=', app()->getLocale());
            })
            ->orderBy('name')
            ->select('provinces.id', 'province_translations.name')
            ->pluck('name', 'id');
    }
}
