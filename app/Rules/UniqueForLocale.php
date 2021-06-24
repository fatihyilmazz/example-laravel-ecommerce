<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniqueForLocale implements Rule
{
    /**
     * @var string
     */
    protected $searchTable;

    /**
     * @var array
     */
    protected $requestData;

    /**
     * @param string $searchTable
     * @param array $requestData
     */
    public function __construct(string $searchTable, array $requestData)
    {
        $this->searchTable = $searchTable;
        $this->requestData = $requestData;
    }

    /**
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $attributeArray = explode('.', $attribute);

        $translationsIndex = $attributeArray[1];
        $searchColumn = $attributeArray[2];

        $query = DB::table($this->searchTable)
            ->where('locale', $this->requestData['translations'][$translationsIndex]['locale'])
            ->where($searchColumn, $value);

        if (empty($this->requestData['translations'][$translationsIndex]['id'])) {
            $isExists = $query->exists();
        } else {
            $isExists = $query->whereNotIn('id', [$this->requestData['translations'][$translationsIndex]['id']])->exists();
        }

        return !$isExists;
    }

    /**
     * @return string
     */
    public function message()
    {
        return __('messages.errors.unique_for_locale');
    }
}
