<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRole extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'          => 'bail|required|string|max:255',
            'permissions.*' => 'required|exists:permissions,id',
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name'          => __('text.common.name'),
            'permissions.*' => __('text.permissions.name_singular'),
        ];
    }
}
