<?php

namespace App\Repositories;

use App\Facades\Setting;
use App\Slider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class SliderRepository extends BaseRepository
{
    /**
     * @var Slider
     */
    protected $slider;

    /**
     * @param Slider $slider
     */
    public function __construct(Slider $slider)
    {
        parent::__construct($slider);

        $this->slider = $slider;
    }

    /**
     * @param Request $request
     *
     * @return LengthAwarePaginator
     *
     * @throws \Exception
     */
    public function getSlidersByFilter(Request $request): LengthAwarePaginator
    {
        $slider = $this->slider;

        if ($request->has('id') && !empty($request->request->getInt('id'))) {
            $slider = $slider->where('id', $request->request->getInt('id'));
        }

        if ($request->has('name') && !empty($request->request->get('name'))) {
            $slider = $slider->where('name', 'LIKE', "%{$request->request->get('name')}%");
        }

        if ($request->has('slider_type_id') && !empty($request->request->getInt('slider_type_id'))) {
            $slider = $slider->where('slider_type_id', '=', $request->request->getInt('slider_type_id'));
        }

        if ($request->has('started_at') && !empty($request->request->get('started_at'))) {
            $slider = $slider->whereDate('started_at', '>=', (new \DateTime($request->request->get('started_at'))));
        }

        if ($request->has('end_at') && !empty($request->request->get('end_at'))) {
            $slider = $slider->whereDate('end_at', '<=', (new \DateTime($request->request->get('end_at'))));
        }

        if ($request->has('order') && !empty($request->request->getInt('order'))) {
            $slider = $slider->where('order', $request->request->getInt('order'));
        }

        if ($request->has('is_published') && !is_null($request->get('is_published'))) {
            $slider = $slider->where('is_published', $request->request->getBoolean('is_published'));
        }

        $slider = $slider->with(['sliderType']);

        return $slider->orderBy('id', 'DESC')
        ->paginate($request->has('per_page') ?
            $request->request->getInt('per_page') :
            Setting::get('pagination_item_per_page', \App\Setting::PAGINATION_ITEM_PER_PAGE))
        ->setPath(route('admin.sliders.index'));
    }

    /**
     * @param int $sliderId
     *
     * @return Slider|Model|null
     */
    public function getSliderById(int $sliderId): ?Slider
    {
        return $this->slider
            ->find($sliderId);
    }

    /**
     * @return Collection
     */
    public function pluckAllActiveSliders(): Collection
    {
        return $this->slider
            ->published()
            ->orderBy('name')
            ->pluck('name', 'id');
    }
}
