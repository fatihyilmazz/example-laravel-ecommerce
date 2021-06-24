<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrand extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'      => 'bail|required|min:1|max:255',
            'order'     => 'bail|nullable|digits_between:0,32767',
            'is_active' => 'boolean',
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name'      => __('text.category.name'),
            'order'     => __('text.common.order'),
            'is_active' => __('text.crud.status'),
        ];
    }
}
