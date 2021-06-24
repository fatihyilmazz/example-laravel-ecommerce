<?php

namespace App\Services;

use App\Facades\FileFacade;
use App\Media;
use App\Slider;
use App\Repositories\SliderRepository;
use App\Repositories\SliderTypeRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class SliderService
{
    /**
     * @var SliderTypeRepository
     */
    protected $sliderTypeRepository;

    /**
     * @var SliderRepository
     */
    protected $sliderRepository;

    /**
     * @param SliderTypeRepository $sliderTypeRepository
     * @param SliderRepository $sliderRepository
     */
    public function __construct(
        SliderTypeRepository $sliderTypeRepository,
        SliderRepository $sliderRepository
    ) {
        $this->sliderTypeRepository = $sliderTypeRepository;
        $this->sliderRepository     = $sliderRepository;
    }

    /**
     * @param Request $request
     *
     * @return LengthAwarePaginator|null
     */
    public function getSlidersByFilter(Request $request): ?LengthAwarePaginator
    {
        try {
            return $this->sliderRepository->getSlidersByFilter($request);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'id'                => $request->get('id'),
                'name'              => $request->get('name'),
                'slider_type_id'    => $request->get('slider_type_id'),
                'started_at'        => $request->get('started_at'),
                'end_at'            => $request->get('end_at'),
                'order'             => $request->get('order'),
                'is_active'         => $request->get('is_active'),
            ]);
        }

        return null;
    }

    /**
     * @return Collection|null
     */
    public function pluckAllActiveSliders(): ?Collection
    {
        try {
            return $this->sliderRepository->pluckAllActiveSliders();
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }

    /**
     * @param int $sliderId
     *
     * @return Slider|null
     */
    public function getSliderById(int $sliderId): ?Slider
    {
        try {
            return $this->sliderRepository->getSliderById($sliderId);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'sliderId' => $sliderId,
            ]);
        }

        return null;
    }

    /**
     * @param array $data
     *
     * @return Model|null
     */
    public function createSlider(array $data): ?Slider
    {
        try {
            return DB::transaction(function () use ($data) {
                if (!empty($data['slider_type_id'])) {
                    if (isset($data['page_id'])) {
                        $data['type_value'] = $data['page_id'];
                    } elseif (isset($data['link'])) {
                        $data['type_value'] = $data['link'];
                    } elseif (isset($data['category_id'])) {
                        $data['type_value'] = $data['category_id'];
                    } elseif (isset($data['brand_id'])) {
                        $data['type_value'] = $data['brand_id'];
                    }
                }

                $slider = $this->sliderRepository->create($data);

                $source = FileFacade::upload(
                    public_path(env('IMAGE_PATH_SLIDER', Media::DEFAULT_IMAGE_PATH_SLIDER)),
                    (string)$slider->id,
                    $data['image']
                );

                if (!empty($source)) {
                    $attributes = [
                        'media_type' => Media::TYPE_ID_IMAGE,
                        'source' => $source,
                    ];

                    $slider->media()->save(new Media($attributes));
                } else {
                    return false;
                }

                return $slider;
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
     * @param int $sliderId
     *
     * @return bool|null
     */
    public function updateSlider(array $data, int $sliderId): ?bool
    {
        try {
            return DB::transaction(function () use ($data, $sliderId) {
                $slider = $this->sliderRepository->find($sliderId);

                if (!empty($data['slider_type_id'])) {
                    if (isset($data['page_id'])) {
                        $data['type_value'] = $data['page_id'];
                    } elseif (isset($data['link'])) {
                        $data['type_value'] = $data['link'];
                    } elseif (isset($data['category_id'])) {
                        $data['type_value'] = $data['category_id'];
                    } elseif (isset($data['brand_id'])) {
                        $data['type_value'] = $data['brand_id'];
                    }
                }

                if (isset($data['image'])) {
                    $oldMedia = $slider->media()->first()->source;
                    $oldMediaId = $slider->media()->first()->id;

                    $isDataDeleted = $slider->media()->find($oldMediaId)->delete();

                    if ($isDataDeleted) {
                        $isFileDeleted = File::delete(
                            public_path(env('IMAGE_PATH_SLIDER', Media::DEFAULT_IMAGE_PATH_SLIDER)).
                            $oldMedia
                        );

                        if (!$isFileDeleted) {
                            Log::error(
                                sprintf(
                                    '[%s][%s] Media could not deleted. Image: %s',
                                    __CLASS__,
                                    __FUNCTION__,
                                    $oldMedia
                                )
                            );
                        }
                    } else {
                        return false;
                    }

                    $source = FileFacade::upload(
                        public_path(env('IMAGE_PATH_SLIDER', Media::DEFAULT_IMAGE_PATH_SLIDER)),
                        (string)$slider->id,
                        $data['image']
                    );

                    if (!empty($source)) {
                        $attributes = [
                            'media_type' => Media::TYPE_ID_IMAGE,
                            'source' => $source,
                        ];

                        $slider->media()->save(new Media($attributes));
                    } else {
                        return false;
                    }
                }

                $slider->update($data);

                return true;
            });
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'data'      => $data,
                'sliderId'  => $sliderId,
            ]);
        }

        return null;
    }

    /**
     * @param int $sliderId
     *
     * @return bool|null
     */
    public function destroySlider(int $sliderId): ?bool
    {
        try {
            return $this->sliderRepository->destroy($sliderId);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'sliderId' => $sliderId,
            ]);
        }

        return null;
    }

    /**
     * @return Collection|null
     */
    public function pluckAllSliderTypes(): ?Collection
    {
        try {
            return $this->sliderTypeRepository->pluckAllSliderTypes();
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }
}
