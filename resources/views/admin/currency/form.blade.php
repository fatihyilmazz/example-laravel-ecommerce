@extends('admin.layouts.app')

@php
    $pageTitle = __('text.currency.management');

    $subHeaderTitle = __('text.currency.management');
    $subHeaderBreadcrumbs = [['name' => __('text.currency.name_plural'), 'url' => route('admin.currencies.index'), 'is_active' => false]];

    if (isset($currency)) {
        $subHeaderBreadcrumbs = array_merge($subHeaderBreadcrumbs, [['name' => __('text.crud.edit'), 'url' => $currency->editLink(), 'is_active' => true]]);
    } else {
        $subHeaderBreadcrumbs = array_merge($subHeaderBreadcrumbs, [['name' => __('text.crud.add_new'), 'url' => route('admin.currencies.create'), 'is_active' => true]]);
    }

    $userCanCreateOrUpdate = false;
    if ((auth()->user()->can('create-currencies') && Request::routeIs('admin.currencies.create')) || (auth()->user()->can('update-currencies') && Request::routeIs('admin.currencies.edit'))) {
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
                    @if(isset($currency))
                        {{ __('text.currency.edit') }}
                    @else
                        {{ __('text.currency.create') }}
                    @endif
                </h3>
            </div>
        </div>

        @if(isset($currency))
            {{ html()->form('PUT', $currency->updateLink())->open() }}
        @else
            {{ html()->form('POST', route('admin.currencies.store'))->open() }}
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
                        <label for="name" class="col-lg-2 col-form-label">{{ __('text.common.name') }} <span class="text-danger" title="{{ __('text.common.required_field') }}">*</span></label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                <input
                                    type="text"
                                    name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    required
                                    maxlength="255" minlength="1" autocomplete="off"
                                    value='{{ old('name', (isset($currency) ? $currency->name : null)) }}'
                                >

                                @error('name') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                <input
                                    type="text"
                                    class="form-control"
                                    disabled
                                    value='{{ (isset($currency) ? $currency->name : null) }}'
                                >
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="code" class="col-lg-2 col-form-label">{{ __('text.currency.code') }} <span class="text-danger" title="{{ __('text.common.required_field') }}">*</span></label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                <input
                                    type="text"
                                    name="code" id="code"
                                    class="form-control @error('code') is-invalid @enderror"
                                    required
                                    maxlength="255" minlength="1" autocomplete="off"
                                    value='{{ old('code', (isset($currency) ? $currency->code : null)) }}'
                                >

                                @error('code') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                <input
                                    type="text"
                                    class="form-control"
                                    disabled
                                    value='{{ (isset($currency) ? $currency->code : null) }}'
                                >
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="symbol" class="col-lg-2 col-form-label">{{ __('text.currency.symbol') }} <span class="text-danger" title="{{ __('text.common.required_field') }}">*</span></label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                <input
                                    type="text"
                                    name="symbol" id="symbol"
                                    class="form-control @error('symbol') is-invalid @enderror"
                                    required
                                    maxlength="255" minlength="1" autocomplete="off"
                                    value='{{ old('symbol', (isset($currency) ? $currency->symbol : null)) }}'
                                >

                                @error('symbol') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                <input
                                    type="text"
                                    class="form-control"
                                    disabled
                                    value='{{ (isset($currency) ? $currency->symbol : null) }}'
                                >
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="order" class="col-lg-2 col-form-label">{{ __('text.common.order') }}</label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                <input type="number"
                                       name="order" id="order"
                                       class="form-control @error('order') is-invalid @enderror"
                                       min="0" max="32767" autocomplete="off"
                                       value='{{ old('order', (isset($currency) ? $currency->order : null)) }}'
                                >
                                @error('order')  <x-alert type="error" :message="$message"/> @enderror
                            @else
                                <input
                                    type="text"
                                    class="form-control"
                                    disabled
                                    value='{{ (isset($currency) ? $currency->order : null) }}'
                                >
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="use_constant" class="col-lg-2 col-form-label">{{ __('text.currency.use_constant') }}</label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                <input type="hidden" name="use_constant" value="0">

                                {{ html()->checkbox('use_constant')
                                        ->class(['form-control'])
                                        ->attributes(['data-toggle' => 'toggle', 'data-on' => __('text.crud.active'), 'data-off' => __('text.crud.passive'),
                                        'data-width' => '200', 'data-onstyle' => 'success', 'data-offstyle' => 'danger'])
                                }}

                                @error('use_constant') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                <input type="checkbox"
                                       class="form-control"
                                       disabled
                                       data-toggle="toggle"
                                       data-on="{{ __('text.crud.active') }}"
                                       data-off="{{ __('text.crud.passive') }}"
                                       data-width="200" data-onstyle="success"
                                       data-offstyle="danger"
                                    {{ isset($currency) ? ($currency->use_constant ? 'checked' : null) : null }}

                                >
                            @endif
                        </div>
                    </div>

                    @php
                        if (old('use_constant') != null && old('use_constant') == false) {
                            $styleText = "style='display: none;'";
                        } elseif (old('use_constant') == true) {
                            $styleText = '';
                        } elseif (isset($currency) && $currency->use_constant == false) {
                            $styleText = "style='display: none;'";
                        } else {
                            $styleText = '';
                        }
                    @endphp

                    <div class="form-group row constant-price-input-section" {!! $styleText !!} >
                        <label for="constant_price" class="col-lg-2 col-form-label">{{ __('text.currency.constant_price') }}</label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                <input type="number"
                                       name="constant_price" id="constant_price"
                                       class="form-control @error('constant_price') is-invalid @enderror"
                                       autocomplete="off"
                                       value="{{ old('constant_price', (isset($currency) ? $currency->constant_price : null)) }}"
                                >

                                @error('constant_price') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                <input
                                    type="text"
                                    class="form-control"
                                    disabled
                                    value='{{ (isset($currency) ? $currency->constant_price : null) }}'
                                >
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="is_active" class="col-lg-2 col-form-label">{{ __('text.crud.status') }}</label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                <input type="hidden" name="is_active" value="0">

                                {{ html()->checkbox('is_active')
                                        ->class(['form-control'])
                                        ->attributes(['data-toggle' => 'toggle', 'data-on' => __('text.crud.active'), 'data-off' => __('text.crud.passive'),
                                        'data-width' => '200', 'data-onstyle' => 'success', 'data-offstyle' => 'danger'])
                                }}

                                @error('is_active') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                <input type="checkbox"
                                       class="form-control"
                                       disabled
                                       data-toggle="toggle" data-on="{{ __('text.crud.active') }}" data-off="{{ __('text.crud.passive') }}" data-width="200" data-onstyle="success" data-offstyle="danger"
                                    {{ isset($currency) ? ($currency->is_active ? 'checked' : null) : null }}
                                >
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
                        <div class="col-lg-12 text-right">
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

    <script>
        $( "#use_constant" ).change(function() {
            let constantPriceSection = $('.constant-price-input-section');
            let constantPriceInput = $('#constant_price');

            if ($('#use_constant').is(':checked')) {
                constantPriceSection.show();
                constantPriceInput.prop('required', true);
            } else {
                constantPriceSection.hide()
                constantPriceInput.prop('required', false);
            }
        });
    </script>
@endsection
