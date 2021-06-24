<?php

namespace App\Http\Requests\Admin\Configuration;

use Illuminate\Foundation\Http\FormRequest;

class StoreCurrency extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'              => 'bail|required|min:1|max:255',
            'code'              => 'bail|required|string|min:1|max:255',
            'symbol'            => 'bail|required|string|min:1|max:255',
            'order'             => 'bail|nullable|digits_between:0,32767',
            'use_constant'      => 'boolean',
            'constant_price'    => 'bail|nullable|required_unless:use_constant,0|numeric',
            'is_active'         => 'boolean',
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name'              => __('text.common.name'),
            'code'              => __('text.currency.code'),
            'symbol'            => __('text.currency.symbol'),
            'order'             => __('text.common.order'),
            'use_constant'      => __('text.currency.use_constant'),
            'constant_price'    => __('text.currency.constant_price'),
            'is_active'         => __('text.crud.status'),
        ];
    }
}
