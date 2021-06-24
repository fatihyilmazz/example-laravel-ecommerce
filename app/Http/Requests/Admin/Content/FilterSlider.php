<?php

namespace App\Http\Requests\Admin\Content;

use App\Facades\Setting;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FilterSlider extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'id'                => 'nullable|numeric',
            'name'              => 'nullable|min:1|max:255',
            'slider_type_id'    => 'nullable|exists:slider_types,id',
            'started_at'        => 'nullable|date',
            'end_at'            => 'nullable|date',
            'order'             => 'nullable|digits_between:0,32767',
            'is_published'      => 'nullable|boolean',
            'per_page' => [
                Rule::in(
                    explode(',', Setting::get('pagination_per_page_list', \App\Setting::PAGINATION_PER_PAGE_LIST))
                )
            ],
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'id'                => __('text.crud.id'),
            'name'              => __('text.common.name'),
            'slider_type_id'    => __('text.slider_type.name_singular'),
            'started_at'        => __('text.common.start_at'),
            'end_at'            => __('text.common.end_at'),
            'order'             => __('text.common.order'),
            'is_published'      => __('text.crud.status'),
            'per_page'          => __('text.common.item_number'),
        ];
    }
}
