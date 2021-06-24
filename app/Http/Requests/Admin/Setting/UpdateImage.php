<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class UpdateImage extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'image_slider_max_size'     => 'bail|required|numeric',
            'image_slider_width'        => 'bail|required|numeric',
            'image_slider_height'       => 'bail|required|numeric',
            'image_product_max_size'    => 'bail|required|numeric',
            'image_product_width'       => 'bail|required|numeric',
            'image_product_height'      => 'bail|required|numeric',
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'image_slider_max_size'     => __('text.common.max_size_with_kb'),
            'image_slider_width'        => __('text.common.allowed_width_with_pixel'),
            'image_slider_height'       => __('text.common.allowed_height_with_pixel'),
            'image_product_max_size'    => __('text.common.max_size_with_kb'),
            'image_product_width'       => __('text.common.allowed_width_with_pixel'),
            'image_product_height'      => __('text.common.allowed_height_with_pixel'),
        ];
    }
}
