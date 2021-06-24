<?php

namespace App\Http\Requests\Admin\Content;

use App\Rules\UniqueForLocale;
use Illuminate\Foundation\Http\FormRequest;

class StorePage extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return  [
            'name'                      => 'bail|required|string|max:255',
            'is_published'              => 'boolean',
            'translations.*.id'         => 'bail|nullable|int|exists:page_translations,id',
            'translations.*.locale'     => 'bail|required|string|max:255|exists:locales,code',
            'translations.*.content'    => 'bail|required|string|max:16777215',
            'translations.*.slug' => [
                'bail',
                'required',
                'string',
                'max:255',
                new UniqueForLocale('page_translations', $this->request->all())
            ],
            'translations.*.keywords'       => 'bail|nullable|string|max:255',
            'translations.*.description'    => 'bail|nullable|string|max:255',
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return  [
            'name'                          => __('text.common.name'),
            'is_published'                  => __('text.crud.status'),
            'translations.*.id'             => __('text.crud.id'),
            'translations.*.locale'         => __('text.locale.name_singular'),
            'translations.*.content'        => __('text.common.content'),
            'translations.*.slug'           => __('text.common.slug'),
            'translations.*.keywords'       => __('text.common.keywords'),
            'translations.*.description'    => __('text.common.description'),
        ];
    }
}
