<?php

namespace App\Http\Requests\Admin\Content;

use App\Facades\Setting;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FilterMenu extends FormRequest
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
            'menu_group_id' => 'nullable|exists:menu_groups,id',
            'menu_type_id'  => 'nullable|exists:menu_types,id',
            'parent_id'     => 'nullable|exists:menus,id',
            'order'         => 'nullable|digits_between:0,32767',
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
            'id'            => __('text.crud.id'),
            'name'          => __('text.common.name'),
            'menu_group_id' => __('text.menu_group.name_singular'),
            'menu_type_id'  => __('text.menu_type.name_singular'),
            'parent_id'     => __('text.menu.parent_menu'),
            'order'         => __('text.common.order'),
            'is_active'     => __('text.crud.status'),
            'per_page'      => __('text.common.item_number'),
        ];
    }
}
