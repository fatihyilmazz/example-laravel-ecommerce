<?php

namespace App\Http\Requests\Admin\Configuration;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLocale extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'is_default_for_admin'      => 'boolean',
            'is_default_for_customer'   => 'boolean',
            'is_usable_for_users'       => 'boolean',
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'is_default_for_admin'      => __('text.locale.default_for_staff'),
            'is_default_for_customer'   => __('text.locale.default_for_customer'),
            'is_usable_for_users'       => __('text.crud.status'),
        ];
    }
}
