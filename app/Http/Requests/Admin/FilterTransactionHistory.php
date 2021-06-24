<?php

namespace App\Http\Requests\Admin;

use App\Facades\Setting;
use App\Repositories\ActivityLogRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FilterTransactionHistory extends FormRequest
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
            'log_name'      => 'nullable|min:3|max:255',
            'description'   => ['nullable', Rule::in(['created', 'updated', 'deleted'])],
            'subject_id'    => 'nullable|numeric',
            'causer_id'     => 'nullable|exists:App\User,id',
            'started_at'    => 'nullable|date',
            'end_at'        => 'nullable|date|after:started_at',
            'order_by' => [
                'nullable',
                Rule::in(
                    [
                        ActivityLogRepository::ORDER_BY_ID,
                        ActivityLogRepository::ORDER_BY_LOG_NAME,
                        ActivityLogRepository::ORDER_BY_DESCRIPTION
                    ]
                )
            ],
            'sort_by' => [
                'nullable',
                Rule::in(
                    [
                        ActivityLogRepository::SORT_BY_ASC,
                        ActivityLogRepository::SORT_BY_DESC
                    ]
                )
            ],
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
            'log_name'      => __('text.common.log_name'),
            'description'   => __('text.common.transaction_type'),
            'subject_type'  => __('text.common.modified_record'),
            'causer_id'     => __('text.common.user'),
            'started_at'    => __('text.common.start_date'),
            'end_at'        => __('text.common.end_date'),
            'order_by'      => __('text.common.order_by'),
            'sort_by'       => __('text.common.sort_by'),
            'per_page'      => __('text.common.item_number'),
        ];
    }
}
