<?php

namespace App\Http\Requests\Admin\Product;

use App\Rules\UniqueForLocale;
use Illuminate\Foundation\Http\FormRequest;

class StoreCategory extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return  [
            'parent_id'             => 'nullable|exists:categories,id',
            'order'                 => 'bail|nullable|digits_between:0,32767',
            'is_active'             => 'boolean',
            'translations.*.id'     => 'bail|nullable|int|exists:category_translations,id',
            'translations.*.locale' => 'bail|required|string|max:255|exists:locales,code',
            'translations.*.name'   => 'bail|required|string|max:255',
            'translations.*.slug' => [
                'bail',
                'required',
                'string',
                'max:255',
                new UniqueForLocale('product_translations', $this->request->all())
            ],
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return  [
            'parent_id'             => __('text.category.parent_category'),
            'order'                 => __('text.common.order'),
            'is_active'             => __('text.crud.status'),
            'translations.*.id'     => __('text.crud.id'),
            'translations.*.locale' => __('text.locale.name_singular'),
            'translations.*.name'   => __('text.common.name'),
            'translations.*.slug'   => __('text.common.slug'),
        ];
    }
}
