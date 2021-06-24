<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class Contact extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'      => 'bail|required|string|max:255',
            'email'     => 'bail|required|email',
            'phone'     => 'bail|sometimes|max:255',
            'subject'   => 'bail|required|string|max:255',
            'message'   => 'bail|required|string|max:16777215'
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name'      => __('text.common.name'),
            'email'     => __('text.common.email'),
            'phone'     => __('text.common.phone_number'),
            //'subject'   => ,//TODO
            //'message'   => ,//TODO
        ];
    }
}
