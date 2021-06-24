<?php

namespace App\Http\Requests\Admin;

use App\Media;
use Illuminate\Foundation\Http\FormRequest;

class FileDownload extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'          => 'bail|nullable|string',
            'path'          => 'bail|required|string',
            'media_type'    => sprintf('bail|required|in:%s', Media::TYPE_ID_FILE),
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name'          => __('text.common.name'),
            'media_type'    => __('text.common.media_type'),
        ];
    }
}
