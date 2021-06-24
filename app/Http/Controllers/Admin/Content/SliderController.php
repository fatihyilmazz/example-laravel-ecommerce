<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\Content\FilterSlider;
use App\Http\Requests\Admin\Content\StoreSlider;
use App\Slider;
use App\Services\BrandService;
use App\Services\CategoryService;
use App\Services\SliderService;
use App\Services\PageService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class SliderController extends BaseController
{
    /**
     * @var SliderService
     */
    protected $sliderService;

    /**
     * @param SliderService $sliderService
     */
    public function __construct(SliderService $sliderService)
    {
        $this->sliderService = $sliderService;
    }

    /**
     * @param FilterSlider $request
     *
     * @return View
     */
    public function index(FilterSlider $request): View
    {
        $request->validated();

        $sliders        = $this->sliderService->getSlidersByFilter($request);
        $sliderTypes    = $this->sliderService->pluckAllSliderTypes();

        return view('admin.slider.index')
            ->with(compact('sliders', 'sliderTypes'));
    }

    /**
     * @param PageService $pageService
     * @param CategoryService $categoryService
     * @param BrandService $brandService
     *
     * @return View
     */
    public function create(PageService $pageService, CategoryService $categoryService, BrandService $brandService): View
    {
        $sliderTypes    = $this->sliderService->pluckAllSliderTypes();
        $pages          = $pageService->pluckActivePagesIdAndName();
        $categories     = $categoryService->pluckActiveCategoriesIdAndName();
        $brands         = $brandService->pluckAllActiveBrandsIdAndName();

        return view('admin.slider.form')
            ->with(compact('sliderTypes', 'pages', 'categories', 'brands'));
    }

    /**
     * @param StoreSlider $request
     *
     * @return RedirectResponse
     */
    public function store(StoreSlider $request): RedirectResponse
    {
        $validatedAttributes = $request->validated();

        $slider = $this->sliderService->createSlider($validatedAttributes);
        if ($slider instanceof Slider) {
            $notifyStatus   = 'success';
            $notifyTitle    = __('messages.info.operation.successful');
            $notifyMessage  = __('messages.info.operation.saved');

            return redirect(route('admin.sliders.index'))
                ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
        }

        $notifyStatus   = 'danger';
        $notifyTitle    = __('messages.info.operation.failed');
        $notifyMessage  = __('messages.info.operation.saving_failed');

        return back()->withInput()
            ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
    }

    /**
     * @param int $sliderId
     * @param PageService $pageService
     * @param CategoryService $categoryService
     * @param BrandService $brandService
     *
     * @return View
     */
    public function edit(int $sliderId, PageService $pageService, CategoryService $categoryService, BrandService $brandService): View
    {
        $slider         = $this->sliderService->getSliderById($sliderId);
        $sliderTypes    = $this->sliderService->pluckAllSliderTypes();
        $pages          = $pageService->pluckActivePagesIdAndName();
        $categories     = $categoryService->pluckActiveCategoriesIdAndName();
        $brands         = $brandService->pluckAllActiveBrandsIdAndName();

        html()->model($slider);

        return view('admin.slider.form')
            ->with(compact('sliderTypes', 'pages', 'categories', 'brands', 'slider'));
    }

    /**
     * @param StoreSlider $request
     * @param int $sliderId
     *
     * @return RedirectResponse
     */
    public function update(StoreSlider $request, int $sliderId): RedirectResponse
    {
        $validatedAttributes = $request->validated();

        $updateStatus = $this->sliderService->updateSlider($validatedAttributes, $sliderId);
        if ($updateStatus) {
            $notifyStatus   = 'success';
            $notifyTitle    = __('messages.info.operation.successful');
            $notifyMessage  = __('messages.info.operation.saved');

            return redirect(route('admin.sliders.index'))
                ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
        }

        $notifyStatus   = 'danger';
        $notifyTitle    = __('messages.info.operation.failed');
        $notifyMessage  = __('messages.info.operation.saving_failed');

        return back()->withInput()
            ->setStatusCode(Response::HTTP_NOT_FOUND)
            ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
    }

    /**
     * @param int $sliderId
     *
     * @return bool|null
     */
    public function destroy(int $sliderId): ?bool
    {
        return $this->sliderService->destroySlider($sliderId);
    }
}
