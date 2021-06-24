<?php

namespace App\Http\Requests\Admin\Configuration;

use App\Facades\Setting;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FilterCurrency extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'id'        => 'nullable|numeric',
            'name'      => 'nullable|min:1|max:255',
            'order'     => 'nullable|digits_between:0,32767',
            'is_active' => 'nullable|boolean',
            'per_page'  => [
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
            'id'        => __('text.crud.id'),
            'name'      => __('text.common.name'),
            'order'     => __('text.common.order'),
            'is_active' => __('text.crud.status'),
            'per_page'  => __('text.common.item_number'),
        ];
    }
}
