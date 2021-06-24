<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Base64 implements Rule
{
    /**
     * @var array
     */
    protected $allowedMimeTypes;

    /**
     * @param array $allowedMimeTypes
     */
    public function __construct(array $allowedMimeTypes)
    {
        $this->allowedMimeTypes = $allowedMimeTypes;
    }

    /**
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $image = base64_decode($value);

        $fInfo = finfo_open();
        $fileMimeType = finfo_buffer($fInfo, $image, FILEINFO_MIME_TYPE);

        return in_array($fileMimeType, $this->allowedMimeTypes);
    }

    /**
     * @return string
     */
    public function message()
    {
        return __('messages.errors.file_type_not_allowed');
    }
}
