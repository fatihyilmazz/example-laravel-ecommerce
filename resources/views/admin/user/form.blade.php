@extends('admin.layouts.app')

@php
    $pageTitle = __('text.user.management');

    $subHeaderTitle = __('text.user.management');
    $subHeaderBreadcrumbs = [['name' => trans_choice('text.user.name_plural', 2), 'url' => route('admin.users.index'), 'is_active' => false]];

    if (isset($user)) {
        $subHeaderBreadcrumbs = array_merge($subHeaderBreadcrumbs, [['name' => __('text.crud.edit'), 'url' => $user->editLink(), 'is_active' => true]]);
    } else {
        $subHeaderBreadcrumbs = array_merge($subHeaderBreadcrumbs, [['name' => __('text.crud.add_new'), 'url' => route('admin.users.create'), 'is_active' => true]]);
    }

    $userCanCreateOrUpdate = false;
    if ((auth()->user()->can('create-users') && Request::routeIs('admin.users.create')) || (auth()->user()->can('update-users') && Request::routeIs('admin.users.edit'))) {
        $userCanCreateOrUpdate = true;
    }
@endphp

@section('pageStyle')
    <link href="{{asset('admin/assets/custom/bootstrap-toggle_v2.2.2/bootstrap-toggle.min.css')}}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')

    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    @if(isset($user))
                        {{ __('text.user.edit') }}
                    @else
                        {{ __('text.user.create') }}
                    @endif
                </h3>
            </div>
        </div>

        @if(isset($user))
            {{ html()->form('PUT', $user->updateLink())->open() }}

            <input type="hidden" name="id" value="{{ $user->id }}">
        @else
            {{ html()->form('POST', route('admin.users.store'))->open() }}
        @endif
        <div class="kt-portlet__body">

            <div class="row">
                <div class="col-lg-1"></div>

                <div class="col-lg-10">
                    @if ($errors->any())
                        <div class="alert alert-danger fade show" role="alert">
                            <div class="alert-icon"><i class="flaticon-warning-sign"></i></div>
                            <div class="alert-text">{{ __('messages.info.operation.could_not_be_completed') }}</div>
                            <div class="alert-close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="la la-close"></i></span>
                                </button>
                            </div>
                        </div>
                    @endif

                    <div class="form-group row">
                        <label for="first_name" class="col-lg-2 col-form-label">
                            {{ __('text.common.first_name') }}
                            <span class="text-danger" title="{{ __('text.common.required_field') }}">*</span>
                        </label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                {{ html()->text('first_name')
                                    ->class(['form-control', 'is-invalid' => $errors->has('first_name')])
                                    ->required()
                                    ->attributes(['min' => 1, 'max' => 255, 'autocomplete' => 'off'])
                                }}

                                @error('first_name')  <x-alert type="error" :message="$message"/> @enderror
                            @else
                                {{ html()->number('first_name')->class(['form-control'])->attributes(['disabled' => 'disabled']) }}
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="last_name" class="col-lg-2 col-form-label">
                            {{ __('text.common.last_name') }}
                            <span class="text-danger" title="{{ __('text.common.required_field') }}">*</span>
                        </label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                {{ html()->text('last_name')
                                    ->class(['form-control', 'is-invalid' => $errors->has('last_name')])
                                    ->required()
                                    ->attributes(['min' => 1, 'max' => 255, 'autocomplete' => 'off'])
                                }}

                                @error('last_name')  <x-alert type="error" :message="$message"/> @enderror
                            @else
                                {{ html()->text('last_name')->class(['form-control'])->attributes(['disabled' => 'disabled']) }}
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-lg-2 col-form-label">
                            {{ __('text.common.email') }}
                            <span class="text-danger" title="{{ __('text.common.required_field') }}">*</span>
                        </label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                {{ html()->email('email')
                                    ->class(['form-control', 'is-invalid' => $errors->has('email')])
                                    ->required()
                                    ->attributes(['min' => 1, 'max' => 255, 'autocomplete' => 'off'])
                                }}

                                @error('email')  <x-alert type="error" :message="$message"/> @enderror
                            @else
                                {{ html()->email('email')->class(['form-control'])->attributes(['disabled' => 'disabled']) }}
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone_number" class="col-lg-2 col-form-label">{{ __('text.common.phone_number') }}</label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                {{ html()->text('phone_number')
                                    ->class(['form-control', 'is-invalid' => $errors->has('phone_number')])
                                    ->attributes(['min' => 1, 'max' => 255, 'autocomplete' => 'off'])
                                }}

                                @error('phone_number')  <x-alert type="error" :message="$message"/> @enderror
                            @else
                                {{ html()->text('phone_number')->class(['form-control'])->attributes(['disabled' => 'disabled']) }}
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-lg-2 col-form-label">
                            {{ __('text.common.password') }}
                            <span class="text-danger" title="{{ __('text.common.required_field') }}">*</span>
                        </label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                {{ html()->password('password')
                                    ->class(['form-control', 'is-invalid' => $errors->has('password')])
                                    ->required()
                                    ->attributes([
                                        'min' => \App\Facades\Setting::get('security_password_length', \App\Setting::SECURITY_PASSWORD_LENGTH),
                                        'max' => 255, 'autocomplete' => 'off'
                                    ])
                                }}

                                @error('password')  <x-alert type="error" :message="$message"/> @enderror
                            @else
                                {{ html()->password('password')->class(['form-control'])->attributes(['disabled' => 'disabled']) }}
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password_confirmation" class="col-lg-2 col-form-label">
                            {{ __('text.common.password_confirmation') }}
                            <span class="text-danger" title="{{ __('text.common.required_field') }}">*</span>
                        </label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                {{ html()->password('password_confirmation')
                                    ->class(['form-control', 'is-invalid' => $errors->has('password_confirmation')])
                                    ->required()
                                    ->attributes([
                                        'min' => \App\Facades\Setting::get('security_password_length', \App\Setting::SECURITY_PASSWORD_LENGTH),
                                        'max' => 255, 'autocomplete' => 'off'
                                    ])
                                }}
                            @else
                                {{ html()->password('password')->class(['form-control'])->attributes(['disabled' => 'disabled']) }}
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="is_active" class="col-lg-2 col-form-label">
                            {{ __('text.crud.status') }}
                            <span class="text-danger" title="{{ __('text.common.required_field') }}">*</span>
                        </label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                <input type="hidden" name="is_active" value="0">

                                {{ html()->checkbox('is_active')
                                    ->class(['form-control'])
                                    ->required()
                                    ->attributes(['data-toggle' => 'toggle', 'data-on' => __('text.crud.active'), 'data-off' => __('text.crud.passive'),
                                        'data-width' => '200', 'data-onstyle' => 'success', 'data-offstyle' => 'danger'])
                                }}

                                @error('is_active') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                {{ html()->checkbox('is_active')
                                    ->class(['form-control'])
                                    ->attributes(['data-toggle' => 'toggle', 'data-on' => __('text.crud.active'), 'data-off' => __('text.crud.passive'),
                                        'data-width' => '200', 'data-onstyle' => 'success', 'data-offstyle' => 'danger', 'disabled' => 'disabled'])
                                }}
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="is_sms_allowed" class="col-lg-2 col-form-label">{{ __('text.common.sms_permission') }}</label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                <input type="hidden" name="is_sms_allowed" value="0">

                                {{ html()->checkbox('is_sms_allowed')
                                    ->class(['form-control'])
                                    ->attributes(['data-toggle' => 'toggle', 'data-on' => __('text.crud.active'), 'data-off' => __('text.crud.passive'),
                                        'data-width' => '200', 'data-onstyle' => 'success', 'data-offstyle' => 'danger'])
                                }}

                                @error('is_sms_allowed') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                {{ html()->checkbox('is_sms_allowed')
                                    ->class(['form-control'])
                                    ->attributes(['data-toggle' => 'toggle', 'data-on' => __('text.crud.active'), 'data-off' => __('text.crud.passive'),
                                        'data-width' => '200', 'data-onstyle' => 'success', 'data-offstyle' => 'danger', 'disabled' => 'disabled'])
                                }}
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="is_mail_allowed" class="col-lg-2 col-form-label">{{ __('text.common.email_permission') }}</label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                <input type="hidden" name="is_mail_allowed" value="0">

                                {{ html()->checkbox('is_mail_allowed')
                                    ->class(['form-control'])
                                    ->attributes(['data-toggle' => 'toggle', 'data-on' => __('text.crud.active'), 'data-off' => __('text.crud.passive'),
                                        'data-width' => '200', 'data-onstyle' => 'success', 'data-offstyle' => 'danger'])
                                }}

                                @error('is_mail_allowed') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                {{ html()->checkbox('is_mail_allowed')
                                    ->class(['form-control'])
                                    ->attributes(['data-toggle' => 'toggle', 'data-on' => __('text.crud.active'), 'data-off' => __('text.crud.passive'),
                                        'data-width' => '200', 'data-onstyle' => 'success', 'data-offstyle' => 'danger', 'disabled' => 'disabled'])
                                }}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-1"></div>
            </div>
        </div>

        <div class="kt-portlet__foot kt-portlet__foot--solid">
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                    <div class="form-group row">
                        <div class="col text-right">
                            <div class="kt-form__actions">
                                @if($userCanCreateOrUpdate)
                                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>{{ __('text.crud.save') }}</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1"></div>
            </div>
        </div>

        {{ html()->form()->close() }}
    </div>

@stop

@section('pageScript')
    <script src="{{asset('admin/assets/custom/bootstrap-toggle_v2.2.2/bootstrap-toggle.min.js')}}" type="text/javascript"></script>
@endsection
