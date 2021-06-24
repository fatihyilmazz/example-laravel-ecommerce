@extends('admin.layouts.app')

@php
    $pageTitle = __('text.locale.management');

    $subHeaderTitle = __('text.locale.management');
    $subHeaderBreadcrumbs = [['name' => __('text.locale.name_plural'), 'url' => route('admin.locales.index'), 'is_active' => false]];

    if (isset($locale)) {
        $subHeaderBreadcrumbs = array_merge($subHeaderBreadcrumbs, [['name' => __('text.crud.edit'), 'url' => $locale->editLink(), 'is_active' => true]]);
    }

    $userCanCreateOrUpdate = false;
    if ((auth()->user()->can('create-locales') && Request::routeIs('admin.locales.create')) || (auth()->user()->can('update-locales') && Request::routeIs('admin.locales.edit'))) {
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
                    {{ __('text.locale.edit') }}
                </h3>
            </div>
        </div>

        {{ html()->form('PUT', $locale->updateLink())->open() }}

        <div class="kt-portlet__body">

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
                    <label class="col-lg-2 col-form-label">{{ __('text.locale.english_name') }}</label>
                    <div class="col-lg-4">
                        <span>{{ $locale->english_name }}</span>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-2 col-form-label">{{ __('text.common.name') }}</label>
                    <div class="col-lg-4">
                        <span>{{ $locale->native_name }}</span>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-2 col-form-label">{{ __('text.locale.code') }}</label>
                    <div class="col-lg-4">
                        <span>{{ $locale->code }} / {{ $locale->regional }}</span>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="is_default_for_admin" class="col-lg-2 col-form-label">
                        {{ __('text.locale.default_for_staff') }}
                        <span class="kt-badge kt-badge--brand" data-toggle="kt-popover" title="" data-content="" data-original-title="{{ __('text.common.attention') }}">?</span>
                    </label>
                    <div class="col-lg-4">
                        @if($userCanCreateOrUpdate)
                            <input type="hidden" name="is_default_for_admin" value="0">

                            {{ html()->checkbox('is_default_for_admin')->class(['form-control'])
                                ->attributes(['data-toggle' => 'toggle', 'data-on' => __('text.crud.active'), 'data-off' => __('text.crud.passive'),
                                'data-width' => '200', 'data-onstyle' => 'success', 'data-offstyle' => 'danger'])}}
                            @error('is_default_for_admin') <x-alert type="error" :message="$message"/> @enderror
                        @else
                            {{ html()->checkbox('is_default_for_admin')->class(['form-control'])
                                ->attributes(['data-toggle' => 'toggle', 'data-on' => __('text.crud.active'), 'data-off' => __('text.crud.passive'),
                                'data-width' => '200', 'data-onstyle' => 'success', 'data-offstyle' => 'danger', 'disabled' => 'disabled'])}}
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="is_default_for_customer" class="col-lg-2 col-form-label">
                        {{ __('text.locale.default_for_customer') }}
                        <span class="kt-badge kt-badge--brand" data-toggle="kt-popover" title="" data-content="" data-original-title="{{ __('text.common.attention') }}">?</span>
                    </label>
                    <div class="col-lg-4">
                        @if($userCanCreateOrUpdate)
                            <input type="hidden" name="is_default_for_customer" value="0">

                            {{ html()->checkbox('is_default_for_customer')->class(['form-control'])
                                ->attributes(['data-toggle' => 'toggle', 'data-on' => __('text.crud.active'), 'data-off' => __('text.crud.passive'),
                                'data-width' => '200', 'data-onstyle' => 'success', 'data-offstyle' => 'danger'])}}
                            @error('is_default_for_customer') <x-alert type="error" :message="$message"/> @enderror
                        @else
                            {{ html()->checkbox('is_default_for_customer')->class(['form-control'])
                                ->attributes(['data-toggle' => 'toggle', 'data-on' => __('text.crud.active'), 'data-off' => __('text.crud.passive'),
                                'data-width' => '200', 'data-onstyle' => 'success', 'data-offstyle' => 'danger', 'disabled' => 'disabled'])}}
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="is_usable_for_users" class="col-lg-2 col-form-label">
                        {{ __('text.crud.status') }}
                        <span class="kt-badge kt-badge--brand" data-toggle="kt-popover" title="" data-content="" data-original-title="{{ __('text.common.attention') }}">?</span>
                    </label>
                    <div class="col-lg-4">
                        @if($userCanCreateOrUpdate)
                            <input type="hidden" name="is_usable_for_users" value="0">

                            {{ html()->checkbox('is_usable_for_users')->class(['form-control'])->attributes(['data-toggle' => 'toggle', 'data-on' => __('text.crud.active'),
                                'data-off' => __('text.crud.passive'),'data-width' => '200', 'data-onstyle' => 'success', 'data-offstyle' => 'danger'])}}
                            @error('is_usable_for_users') <x-alert type="error" :message="$message"/> @enderror
                        @else
                            {{ html()->checkbox('is_usable_for_users')->class(['form-control'])->attributes(['data-toggle' => 'toggle', 'data-on' => __('text.crud.active'),
                                'data-off' => __('text.crud.passive'),'data-width' => '200', 'data-onstyle' => 'success', 'data-offstyle' => 'danger', 'disabled' => 'disabled'])}}
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-1"></div>
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
