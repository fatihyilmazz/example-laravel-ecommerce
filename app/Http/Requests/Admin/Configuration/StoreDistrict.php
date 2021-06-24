<?php

namespace App\Http\Requests\Admin\Configuration;

use Illuminate\Foundation\Http\FormRequest;

class StoreDistrict extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return  [
            'province_id'           => 'bail|required|exists:provinces,id',
            'order'                 => 'bail|nullable|digits_between:0,32767',
            'is_active'             => 'boolean',
            'translations.*.id'     => 'bail|nullable|int|exists:district_translations,id',
            'translations.*.locale' => 'bail|required|string|max:255|exists:locales,code',
            'translations.*.name'   => 'bail|required|string|max:255',
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return  [
            'province_id'           => __('text.crud.id'),
            'order'                 => __('text.common.order'),
            'is_active'             => __('text.crud.status'),
            'translations.*.id'     => __('text.crud.id'),
            'translations.*.locale' => __('text.locale.name_singular'),
            'translations.*.name'   => __('text.common.name'),
        ];
    }
}
