<?php

namespace App\Http\Requests\Admin\User;

use App\Facades\Setting;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FilterAdmin extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'id'            => 'nullable|numeric',
            'name'          => 'nullable|min:1|max:255',
            'email'         => 'nullable|email',
            'phone_number'  => 'nullable|numeric',
            'is_active'     => 'nullable|boolean',
            'per_page' => [
                Rule::in(
                    explode(',', Setting::get('pagination_per_page_list', \App\Setting::PAGINATION_PER_PAGE_LIST))
                )
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'id'            => __('text.crud.id'),
            'name'          => __('text.common.name'),
            'email'         => __('text.common.email'),
            'phone_number'  => __('text.common.phone_number'),
            'is_active'     => __('text.crud.status'),
            'per_page'      => __('text.common.item_number'),
        ];
    }
}
