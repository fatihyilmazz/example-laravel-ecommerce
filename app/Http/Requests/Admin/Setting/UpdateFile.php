<?php

namespace App\Http\Requests\Admin\Setting;

use App\Facades\Setting;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFile extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'file_product_max_size'                 => 'bail|required|numeric',
            'file_product_allowed_file_types.*'     => [
                'bail',
                'required',
                Rule::in(Setting::getKeyOptions('file_product_allowed_file_types'))
            ],
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'file_product_max_size'             => __('text.common.max_size_with_kb'),
            'file_product_allowed_file_types'   => __('text.common.allowed_file_types'),
        ];
    }

    /**
     * @return array
     */
    public function validated(): array
    {
        $validatedData = parent::validated();

        $validatedData['file_product_allowed_file_types'] = implode(',', $validatedData['file_product_allowed_file_types']);

        return $validatedData;
    }
}
