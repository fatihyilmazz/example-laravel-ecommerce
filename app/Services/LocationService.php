<?php

namespace App\Services;

use App\Country;
use App\CountryTranslation;
use App\District;
use App\DistrictTranslation;
use App\Province;
use App\ProvinceTranslation;
use App\Repositories\CountryRepository;
use App\Repositories\DistrictRepository;
use App\Repositories\ProvinceRepository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;

class LocationService
{
    /**
     * @var CountryRepository
     */
    protected $countryRepository;

    /**
     * @var ProvinceRepository
     */
    protected $provinceRepository;

    /**
     * @var DistrictRepository
     */
    protected $districtRepository;

    /**
     * @param CountryRepository $countryRepository
     * @param ProvinceRepository $provinceRepository
     * @param DistrictRepository $districtRepository
     */
    public function __construct(
        CountryRepository $countryRepository,
        ProvinceRepository $provinceRepository,
        DistrictRepository $districtRepository
    ) {
        $this->countryRepository    = $countryRepository;
        $this->provinceRepository   = $provinceRepository;
        $this->districtRepository   = $districtRepository;
    }

    /**
     * @param Request $request
     *
     * @return LengthAwarePaginator|null
     */
    public function getCountriesByFilter(Request $request): ?LengthAwarePaginator
    {
        try {
            return $this->countryRepository->getCountriesByFilter($request);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[LocationService][getCountriesByFilter] %s', $exception), [
                'id'        => $request->request->getInt('id'),
                'name'      => $request->request->get('name'),
                'order'     => $request->request->getInt('order'),
                'is_active' => $request->get('is_active'),
            ]);
        }

        return null;
    }

    /**
     * @return Collection|null
     */
    public function getAllActiveCountries(): ?Collection
    {
        try {
            return $this->countryRepository->pluckAllActiveCountries();
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }

    /**
     * @param int $countryId
     *
     * @return Country|null
     */
    public function getCountryById(int $countryId): ?Country
    {
        try {
            return $this->countryRepository->getCountryById($countryId);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'countryId' => $countryId,
            ]);
        }

        return null;
    }

    /**
     * @param array $data
     *
     * @return Country|null
     *
     * @throws \Throwable
     */
    public function createCountry(array $data): ?Country
    {
        try {
            return DB::transaction(function () use ($data) {
                $country = $this->countryRepository->create($data);

                $translations = collect();
                foreach ($data['translations'] as $translation) {
                    $translations->push(new CountryTranslation($translation));
                }

                $country->translations()->saveMany($translations);

                return $country;
            });
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'data' => $data,
            ]);
        }

        return null;
    }

    /**
     * @param array $data
     * @param int $countryId
     *
     * @return bool|null
     *
     * @throws \Throwable
     */
    public function updateCountry(array $data, int $countryId): ?bool
    {
        try {
            return DB::transaction(function () use ($data, $countryId) {
                $country = $this->countryRepository->find($countryId);

                $country->update($data);

                $translations = collect();
                foreach ($data['translations'] as $translation) {
                    if (isset($translation['id'])) {
                        $country->translations()->find($translation['id'])->update($translation);
                    } else {
                        $translations->push(new CountryTranslation($translation));
                    }
                }

                if ($translations->isNotEmpty()) {
                    $country->translations()->saveMany($translations);
                }

                return true;
            });
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'data'      => $data,
                'countryId' => $countryId,
            ]);
        }

        return null;
    }

    /**
     * @param int $countryId
     *
     * @return bool|null
     */
    public function destroyCountry(int $countryId): ?bool
    {
        try {
            return $this->countryRepository->destroy($countryId);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'countryId' => $countryId,
            ]);
        }

        return null;
    }

    /**
     * @param Request $request
     *
     * @return LengthAwarePaginator|null
     */
    public function getProvincesByFilter(Request $request): ?LengthAwarePaginator
    {
        try {
            return $this->provinceRepository->getProvincesByFilter($request);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'id'        => $request->request->getInt('id'),
                'order'     => $request->request->getInt('order'),
                'is_active' => $request->get('is_active'),
            ]);
        }

        return null;
    }

    /**
     * @return Collection|null
     */
    public function pluckAllActiveProvinces(): ?Collection
    {
        try {
            return $this->provinceRepository->pluckAllActiveProvinces();
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }

    /**
     * @param int $provinceId
     *
     * @return Province|null
     */
    public function getProvinceById(int $provinceId): ?Province
    {
        try {
            return $this->provinceRepository->getProvinceById($provinceId);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'provinceId' => $provinceId,
            ]);
        }

        return null;
    }

    /**
     * @param array $data
     *
     * @return Province|null
     *
     * @throws \Throwable
     */
    public function createProvince(array $data): ?Province
    {
        try {
            return DB::transaction(function () use ($data) {
                $province = $this->provinceRepository->create($data);

                $translations = collect();
                foreach ($data['translations'] as $translation) {
                    $translations->push(new ProvinceTranslation($translation));
                }

                $province->translations()->saveMany($translations);

                return $province;
            });
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'data' => $data,
            ]);
        }

        return null;
    }

    /**
     * @param array $data
     * @param int $provinceId
     *
     * @return bool|null
     *
     * @throws \Throwable
     */
    public function updateProvince(array $data, int $provinceId): ?bool
    {
        try {
            return DB::transaction(function () use ($data, $provinceId) {
                $province = $this->provinceRepository->find($provinceId);

                $province->update($data);

                $translations = collect();
                foreach ($data['translations'] as $translation) {
                    if (isset($translation['id'])) {
                        $province->translations()->find($translation['id'])->update($translation);
                    } else {
                        $translations->push(new ProvinceTranslation($translation));
                    }
                }

                if ($translations->isNotEmpty()) {
                    $province->translations()->saveMany($translations);
                }

                return true;
            });
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'data'          => $data,
                'provinceId'    => $provinceId,
            ]);
        }

        return null;
    }

    /**
     * @param int $provinceId
     *
     * @return bool|null
     */
    public function destroyProvince(int $provinceId): ?bool
    {
        try {
            return $this->provinceRepository->destroy($provinceId);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'provinceId' => $provinceId,
            ]);
        }

        return null;
    }

    /**
     * @param Request $request
     *
     * @return LengthAwarePaginator|null
     */
    public function getDistrictsByFilter(Request $request): ?LengthAwarePaginator
    {
        try {
            return $this->districtRepository->getDistrictsByFilter($request);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'id'        => $request->request->getInt('id'),
                'order'     => $request->request->getInt('order'),
                'is_active' => $request->get('is_active'),
            ]);
        }

        return null;
    }

    /**
     * @return Collection|null
     */
    public function pluckAllActiveDistricts(): ?Collection
    {
        try {
            return $this->districtRepository->pluckAllActiveDistricts();
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }

    /**
     * @param int $districtId
     *
     * @return District|null
     */
    public function getDistrictById(int $districtId): ?District
    {
        try {
            return $this->districtRepository->getDistrictById($districtId);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'districtId' => $districtId,
            ]);
        }

        return null;
    }

    /**
     * @param array $data
     *
     * @return District|null
     *
     * @throws \Throwable
     */
    public function createDistrict(array $data): ?District
    {
        try {
            return DB::transaction(function () use ($data) {
                $district = $this->districtRepository->create($data);

                $translations = collect();
                foreach ($data['translations'] as $translation) {
                    $translations->push(new DistrictTranslation($translation));
                }

                $district->translations()->saveMany($translations);

                return $district;
            });
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'data' => $data,
            ]);
        }

        return null;
    }

    /**
     * @param array $data
     * @param int $districtId
     *
     * @return bool|null
     *
     * @throws \Throwable
     */
    public function updateDistrict(array $data, int $districtId): ?bool
    {
        try {
            return DB::transaction(function () use ($data, $districtId) {
                $district = $this->districtRepository->find($districtId);

                $district->update($data);

                $translations = collect();
                foreach ($data['translations'] as $translation) {
                    if (isset($translation['id'])) {
                        $district->translations()->find($translation['id'])->update($translation);
                    } else {
                        $translations->push(new DistrictTranslation($translation));
                    }
                }

                if ($translations->isNotEmpty()) {
                    $district->translations()->saveMany($translations);
                }

                return true;
            });
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'data'          => $data,
                'districtId'    => $districtId,
            ]);
        }

        return null;
    }

    /**
     * @param int $districtId
     *
     * @return bool|null
     */
    public function destroyDistrict(int $districtId): ?bool
    {
        try {
            return $this->districtRepository->destroy($districtId);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'districtId' => $districtId,
            ]);
        }

        return null;
    }
}
