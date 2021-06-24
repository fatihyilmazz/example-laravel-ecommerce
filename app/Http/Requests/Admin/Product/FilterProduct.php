<?php

namespace App\Http\Requests\Admin\Product;

use App\Facades\Setting;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FilterProduct extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'ids'           => 'nullable|numeric',
            'name'          => 'nullable|min:1|max:255',
            'brand_id'      => 'nullable|exists:brands,id',
            'category_id'   => 'nullable|exists:categories,id',
            'row_numbers'   => 'nullable|digits_between:0,32767',
            'is_active'     => 'nullable|boolean',
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
            'ids'           => __('text.crud.id'),
            'name'          => __('text.common.name'),
            'brand_id'      => __('text.brand.name_singular'),
            'category_id'   => __('text.category.name'),
            'row_numbers'   => __('text.common.order'),
            'is_active'     => __('text.crud.status'),
            'per_page'      => __('text.common.item_number'),
        ];
    }
}
