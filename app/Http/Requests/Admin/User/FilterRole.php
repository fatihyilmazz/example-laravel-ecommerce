<?php

namespace App\Http\Requests\Admin\User;

use App\Facades\Setting;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class FilterRole extends FormRequest
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
            'per_page'  => [
                Rule::in(explode(',', Setting::get('pagination.per_page_list', \App\Setting::PAGINATION_PER_PAGE_LIST)))
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
            'per_page'  => __('text.common.item_number'),
        ];
    }
}
