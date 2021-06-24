<?php

namespace App\Repositories;

use App\Country;
use App\Facades\Setting;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CountryRepository extends BaseRepository
{
    /**
     * @var Country
     */
    protected $country;

    /**
     * @param Country $country
     */
    public function __construct(Country $country)
    {
        parent::__construct($country);

        $this->country = $country;
    }

    /**
     * @param Request $request
     *
     * @return LengthAwarePaginator
     */
    public function getCountriesByFilter(Request $request): LengthAwarePaginator
    {
        $country = $this->country;

        if ($request->has('id') && !empty($request->request->getInt('id'))) {
            $country = $country->where('id', $request->request->getInt('id'));
        }

        if ($request->has('name') && !empty($request->request->get('name'))) {
            $country = $country->whereHas('translations', static function (Builder $query) use ($request) {
                $query->where('name', 'LIKE', "%{$request->request->get('name')}%")
                    ->where('locale', '=', app()->getLocale());
            });
        }

        if ($request->has('order') && !empty($request->request->getInt('order'))) {
            $country = $country->where('order', $request->request->getInt('order'));
        }

        if ($request->has('is_active') && !is_null($request->get('is_active'))) {
            $country = $country->where('is_active', $request->request->getBoolean('is_active'));
        }

        return $country->orderBy('id', 'DESC')
            ->paginate($request->has('per_page') ?
                $request->request->getInt('per_page') :
                Setting::get('pagination_item_per_page', \App\Setting::PAGINATION_ITEM_PER_PAGE))
            ->setPath(route('admin.countries.index'));
    }

    /**
     * @param int $countryId
     *
     * @return Country|Model|null
     */
    public function getCountryById(int $countryId): ?Country
    {
        return $this->country
            ->without(['translationForCurrentLocale'])
            ->with(['translations'])
            ->find($countryId);
    }

    /**
     * @return Collection
     */
    public function pluckAllActiveCountries(): Collection
    {
        return $this->country->active()
            ->join('country_translations', function (JoinClause $join) {
                $join->on('countries.id', '=', 'country_translations.country_id')
                    ->where('country_translations.locale', '=', app()->getLocale());
            })
            ->orderBy('name')
            ->select('countries.id', 'country_translations.name')
            ->pluck('name', 'id');
    }
}
