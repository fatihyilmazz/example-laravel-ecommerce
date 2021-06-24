<?php

namespace App\Http\Requests\Admin\User;

use App\Facades\Setting;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class StoreUser extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $request = $this->request;

        $passwordLength = Setting::get('security_password_length', \App\Setting::SECURITY_PASSWORD_LENGTH);

        return [
            'id'            => 'nullable|numeric|exists:users,id',
            'first_name'    => 'bail|required|string|min:1|max:255',
            'last_name'     => 'bail|required|string|min:1|max:255',
            'email' => [
                'bail',
                'required',
                'email',
                Rule::unique('users', 'email')->where(function (Builder $query) use ($request) {
                    if (!empty($request->get('id')) && is_int($request->getInt('id'))) {
                        $query->where('id', '!=', $request->getInt('id'));
                    }

                    return $query;
                })
            ],
            'phone_number' => 'bail|nullable|numeric',
            'password' => [
                'nullable',
                'required_without:id',
                'confirmed',
                "min:{$passwordLength}",
            ],
            'is_active'         => 'boolean',
            'is_sms_allowed'    => 'bail|required|boolean',
            'is_mail_allowed'   => 'bail|required|boolean',
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'id'                => __('text.crud.id'),
            'first_name'        => __('text.common.first_name'),
            'last_name'         => __('text.common.last_name'),
            'email'             => __('text.common.email'),
            'phone_number'      => __('text.common.phone_number'),
            'password'          => __('text.common.password'),
            'is_active'         => __('text.crud.status'),
            'is_sms_allowed'    => __('text.common.sms_permission'),
            'is_mail_allowed'   => __('text.common.email_permission'),
        ];
    }

    /**
     * @return array
     */
    public function validated(): array
    {
        $validatedData = parent::validated();

        if (!empty($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        return $validatedData;
    }
}
