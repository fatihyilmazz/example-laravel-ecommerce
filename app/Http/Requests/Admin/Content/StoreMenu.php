<?php

namespace App\Http\Requests\Admin\Content;

use App\MenuType;
use App\Rules\UniqueForLocale;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMenu extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'menu_group_id' => 'bail|required|exists:menu_groups,id',
            'parent_id'     => 'nullable|exists:menus,id',
            'menu_type_id'  => 'bail|nullable|exists:menu_types,id',
            'page_id' => [
                'bail',
                'nullable',
                'required_if:menu_type_id,' . MenuType::ID_PAGE,
                'exists:pages,id',
            ],
            'external_link' => [
                'bail',
                'nullable',
                'required_if:menu_type_id,' . MenuType::ID_EXTERNAL_LINK,
                'url',
            ],
            'main_category_id' => [
                'bail',
                'nullable',
                'required_if:menu_type_id,' . MenuType::ID_MAIN_CATEGORY,
                'exists:categories,id',
            ],
            'category_ids.*' => [
                'bail',
                'nullable',
                'distinct',
                'required_if:menu_type_id,' . MenuType::ID_SELECTED_CATEGORIES,
                'exists:categories,id',
            ],
            'brand_ids.*' => [
                'bail',
                'nullable',
                'distinct',
                'required_if:menu_type_id,' . MenuType::ID_BRANDS,
                'exists:brands,id',
            ],
            'static_page' => [
                'bail',
                'nullable',
                'required_if:menu_type_id,' . MenuType::ID_STATIC_PAGE,
                'string',
                'max:255',
            ],
            'row'                   => 'bail|nullable|digits_between:0,32767',
            'is_active'             => 'boolean',
            'translations.*.id'     => 'bail|nullable|int|exists:menu_translations,id',
            'translations.*.locale' => 'bail|required|string|max:255|exists:locales,code',
            'translations.*.name'   => 'bail|required|string|max:255',
            'translations.*.slug'   => [
                'bail',
                'nullable',
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
        return [
            'menu_group_id'         => __('text.menu_group.name_singular'),
            'parent_id'             => __('text.menu.parent_menu'),
            'menu_type_id'          => __('text.menu_type.name_singular'),
            'page_id'               => __('text.page.name_singular'),
            'external_link'         => __('text.menu_type.external_link'),
            'main_category_id'      => __('text.menu_type.main_category'),
            'category_ids.*'        => __('text.menu_type.selected_categories'),
            'brand_ids.*'           => __('text.menu_type.brands'),
            'static_page'           => __('text.menu_type.static_page'),
            'row'                   => __('text.common.order'),
            'is_active'             => __('text.crud.status'),
            'translations.*.id'     => __('text.crud.id'),
            'translations.*.locale' => __('text.locale.name_singular'),
            'translations.*.name'   => __('text.common.name'),
            'translations.*.slug'   => __('text.common.slug'),
        ];
    }
}
