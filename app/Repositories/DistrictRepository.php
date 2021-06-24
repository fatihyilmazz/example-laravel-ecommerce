<?php

namespace App\Repositories;

use App\District;
use App\Facades\Setting;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class DistrictRepository extends BaseRepository
{
    /**
     * @var District
     */
    protected $district;

    /**
     * @param District $district
     */
    public function __construct(District $district)
    {
        parent::__construct($district);

        $this->district = $district;
    }

    /**
     * @param Request $request
     *
     * @return LengthAwarePaginator
     */
    public function getDistrictsByFilter(Request $request): LengthAwarePaginator
    {
        $district = $this->district;

        if ($request->has('id') && !empty($request->request->getInt('id'))) {
            $district = $district->where('id', $request->request->getInt('id'));
        }

        if ($request->has('name') && !empty($request->request->get('name'))) {
            $district = $district->whereHas('translations', static function (Builder $query) use ($request) {
                $query->where('name', 'LIKE', "%{$request->request->get('name')}%")
                    ->where('locale', '=', app()->getLocale());
            });
        }

        if ($request->has('order') && !empty($request->request->getInt('order'))) {
            $district = $district->where('order', $request->request->getInt('order'));
        }

        if ($request->has('is_active') && !is_null($request->get('is_active'))) {
            $district = $district->where('is_active', $request->request->getBoolean('is_active'));
        }

        $district = $district->with([
            'province',
        ]);

        return $district->orderBy('id', 'DESC')
            ->paginate($request->has('per_page') ?
                $request->request->getInt('per_page') :
                Setting::get('pagination_item_per_page', \App\Setting::PAGINATION_ITEM_PER_PAGE))
            ->setPath(route('admin.districts.index'));
    }

    /**
     * @param int $districtId
     *
     * @return District|Model|null
     */
    public function getDistrictById(int $districtId): ?District
    {
        return $this->district
            ->without(['translationForCurrentLocale'])
            ->with(['translations'])
            ->find($districtId);
    }

    /**
     * @return Collection
     */
    public function pluckAllActiveDistricts(): Collection
    {
        return $this->district
            ->active()
            ->join('district_translations', function (JoinClause $join) {
                $join->on('districts.id', '=', 'district_translations.district_id')
                    ->where('district_translations.locale', '=', app()->getLocale());
            })
            ->orderBy('name')
            ->select('districts.id', 'district_translations.name')
            ->pluck('name', 'id');
    }
}
