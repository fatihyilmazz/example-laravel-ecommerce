<?php

namespace App\Http\Requests\Admin\Content;

use App\Facades\Setting;
use App\SliderType;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreSlider extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $sliderMaxSize  = Setting::get('image_slider_max_size', \App\Setting::IMAGE_SLIDER_MAX_SIZE);
        $sliderWidth    = Setting::get('image_slider_width', \App\Setting::IMAGE_SLIDER_WIDTH);
        $sliderHeight   = Setting::get('image_slider_height', \App\Setting::IMAGE_SLIDER_HEIGHT);

        return  [
            'name'              => 'bail|required|min:1|max:255',
            'slider_type_id'    => 'bail|nullable|exists:slider_types,id',
            'page_id' => [
                'bail',
                'nullable',
                'required_if:slider_type_id,' . SliderType::ID_TYPE_PAGE,
                'exists:pages,id',
            ],
            'link' => [
                'bail',
                'nullable',
                'required_if:slider_type_id,' . SliderType::ID_TYPE_LINK,
                'url',
            ],
            'category_id' => [
                'bail',
                'nullable',
                'distinct',
                'required_if:slider_type_id,' . SliderType::ID_TYPE_CATEGORY,
                'exists:categories,id',
            ],
            'brand_id' => [
                'bail',
                'nullable',
                'distinct',
                'required_if:slider_type_id,' . SliderType::ID_TYPE_BRAND,
                'exists:brands,id',
            ],
            'started_at'        => 'nullable|date',
            'end_at'            => 'nullable|date|after:started_at|after:now',
            'order'             => 'nullable|digits_between:0,32767',
            'is_published'      => 'required|boolean',
            'is_image_exists'   => 'bail|nullable|digits_between:0,1',
            'image'             => "bail|required_if:is_image_exists,0|image|max:{$sliderMaxSize}|dimensions:width={$sliderWidth},height={$sliderHeight}",
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return  [
            'name'              => __('text.common.name'),
            'slider_type_id'    => __('text.slider_type.name_singular'),
            'page_id'           => __('text.page.name_singular'),
            'link'              => __('text.menu_type.external_link'),
            'category_id'       => __('text.category.name'),
            'brand_id'          => __('text.brand.name_singular'),
            'started_at'        => __('text.common.start_at'),
            'end_at'            => __('text.common.end_at'),
            'order'             => __('text.common.order'),
            'is_published'      => __('text.crud.status'),
            'image'             => __('text.setting.image'),
        ];
    }
}
