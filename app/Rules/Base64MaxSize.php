<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Base64MaxSize implements Rule
{
    /**
     * @var string
     */
    protected $max;

    /**
     * @param string $max
     */
    public function __construct(string $max)
    {
        $this->max = $max;
    }

    /**
     * @param  string  $attribute
     * @param  mixed  $base64StringValue
     * @return bool
     */
    public function passes($attribute, $base64StringValue)
    {
        $sizeInBytes = (int) (strlen(rtrim($base64StringValue, '=')) * 3 / 4);
        $sizeInKb    = $sizeInBytes / 1024;

        if ($sizeInKb <= $this->max) {
            return true;
        }

        return false;
    }

    /**
     * @return string
     */
    public function message()
    {
        return __('messages.errors.invalid_max_size', ['max' => $this->max]);
    }
}
