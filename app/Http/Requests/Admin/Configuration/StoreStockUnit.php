<?php

namespace App\Http\Requests\Admin\Configuration;

use Illuminate\Foundation\Http\FormRequest;

class StoreStockUnit extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return  [
            'parent_id'             => 'nullable|exists:stock_units,id',
            'coefficient'           => 'nullable|numeric',
            'code'                  => 'nullable|string|max:255',
            'universal_code'        => 'nullable|string|max:255',
            'order'                 => 'bail|nullable|digits_between:0,32767',
            'is_active'             => 'boolean',
            'translations.*.id'     => 'bail|nullable|int|exists:stock_unit_translations,id',
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
            'parent_id'             => __('text.stock_unit.parent_stock_unit'),
            //'coefficient'           => , //TODO
            //'code'                  => , //TODO
            //'universal_code'        => , //TODO
            'order'                 => __('text.common.order'),
            'is_active'             => __('text.crud.status'),
            'translations.*.id'     => __('text.crud.id'),
            'translations.*.locale' => __('text.locale.name_singular'),
            'translations.*.name'   => __('text.common.name'),
        ];
    }
}
