@extends('admin.layouts.app')

@php
    $pageTitle = __('text.setting.image');

    $subHeaderTitle = __('text.setting.image');
    $subHeaderBreadcrumbs = [['name' => __('text.setting.image'), 'url' => route('admin.setting.image.index'), 'is_active' => true]];
@endphp

@section('pageStyle')
    <link href="{{asset('admin/assets/custom/bootstrap-toggle_v2.2.2/bootstrap-toggle.min.css')}}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')

    {{ html()->form('PUT', route('admin.setting.image.update'))->open() }}

    @isModuleActive([\App\Module::ID_SLIDER_MANAGEMENT], $moduleIds)
        <div class="kt-portlet kt-portlet--head-lg kt-portlet--responsive-mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <i class="fa fa-images"></i>&nbsp;
                    <h3 class="kt-portlet__head-title">
                        {{ __('text.slider.name_singular') }}
                    </h3>
                </div>

                <div class="kt-portlet__head-toolbar">
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>{{ __('text.crud.save') }}</button>
                </div>

            </div>
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
                            <label for="image_slider_max_size" class="col-lg-2 col-form-label">
                                {{ __('text.common.max_size_with_kb') }}
                                <span class="text-danger" title="{{ __('text.common.required_field') }}">*</span>
                            </label>
                            <div class="col-lg-10">
                                {{ html()->number('image_slider_max_size')
                                    ->class(['form-control', 'is-invalid' => $errors->has('image_slider_max_size')])
                                    ->attributes(['autocomplete' => 'off'])
                                    ->value(old('image_slider_max_size', $settings['image_slider_max_size']))
                                    ->required() }}

                                @error('image_slider_max_size') <x-alert type="error" :message="$message"/> @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image_slider_width" class="col-lg-2 col-form-label">
                                {{ __('text.common.allowed_width_with_pixel') }}
                                <span class="text-danger" title="{{ __('text.common.required_field') }}">*</span>
                            </label>
                            <div class="col-lg-10">
                                {{ html()->number('image_slider_width')
                                    ->class(['form-control', 'is-invalid' => $errors->has('image_slider_width')])
                                    ->attributes(['autocomplete' => 'off'])
                                    ->value(old('image_slider_width', $settings['image_slider_width']))
                                    ->required() }}

                                @error('image_slider_width') <x-alert type="error" :message="$message"/> @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image_slider_height" class="col-lg-2 col-form-label">
                                {{ __('text.common.allowed_height_with_pixel') }}
                                <span class="text-danger" title="{{ __('text.common.required_field') }}">*</span>
                            </label>
                            <div class="col-lg-10">
                                {{ html()->number('image_slider_height')
                                    ->class(['form-control', 'is-invalid' => $errors->has('image_slider_height')])
                                    ->attributes(['autocomplete' => 'off'])
                                    ->value(old('image_slider_height', $settings['image_slider_height']))
                                    ->required() }}

                                @error('image_slider_height') <x-alert type="error" :message="$message"/> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1"></div>
                </div>
            </div>
        </div>
    @else
        <div class="kt-portlet kt-portlet--head-lg kt-portlet--responsive-mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <i class="fa fa-save"></i>&nbsp;
                    <h3 class="kt-portlet__head-title">
                        {{ __('text.crud.save') }}
                    </h3>
                </div>

                <div class="kt-portlet__head-toolbar">
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>{{ __('text.crud.save') }}</button>
                </div>

            </div>

            @if ($errors->any())
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-10">
                            <div class="alert alert-danger fade show" role="alert">
                                <div class="alert-icon"><i class="flaticon-warning-sign"></i></div>
                                <div class="alert-text">{{ __('messages.info.operation.could_not_be_completed') }}</div>
                                <div class="alert-close">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true"><i class="la la-close"></i></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1"></div>
                    </div>
                </div>
            @endif
        </div>
    @endisModuleActive()

    @isModuleActive([\App\Module::ID_PRODUCT_MANAGEMENT], $moduleIds)
        <div class="kt-portlet kt-portlet--head-lg" data-ktportlet="true">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <i class="fa fa-cubes"></i>&nbsp;
                <h3 class="kt-portlet__head-title">
                    {{ __('text.product.name_singular') }}
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-group">
                    <a href="javascript:void(0)" data-ktportlet-tool="toggle" class="btn btn-sm btn-icon btn-brand btn-icon-md"><i class="la la-angle-down"></i></a>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="kt-portlet__content">
                <div class="row">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-10">
                        <div class="form-group row">
                            <label for="image_product_max_size" class="col-lg-2 col-form-label">
                                {{ __('text.common.max_size_with_kb') }}
                                <span class="text-danger" title="{{ __('text.common.required_field') }}">*</span>
                            </label>
                            <div class="col-lg-10">
                                {{ html()->number('image_product_max_size')
                                    ->class(['form-control', 'is-invalid' => $errors->has('image_product_max_size')])
                                    ->attributes(['autocomplete' => 'off'])
                                    ->value(old('image_product_max_size', $settings['image_product_max_size']))
                                    ->required() }}

                                @error('image_product_max_size') <x-alert type="error" :message="$message"/> @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image_product_width" class="col-lg-2 col-form-label">
                                {{ __('text.common.allowed_width_with_pixel') }}
                                <span class="text-danger" title="{{ __('text.common.required_field') }}">*</span>
                            </label>
                            <div class="col-lg-10">
                                {{ html()->number('image_product_width')
                                    ->class(['form-control', 'is-invalid' => $errors->has('image_product_width')])
                                    ->attributes(['autocomplete' => 'off'])
                                    ->value(old('image_product_width', $settings['image_product_width']))
                                    ->required() }}

                                @error('image_product_width') <x-alert type="error" :message="$message"/> @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image_product_height" class="col-lg-2 col-form-label">
                                {{ __('text.common.allowed_height_with_pixel') }}
                                <span class="text-danger" title="{{ __('text.common.required_field') }}">*</span>
                            </label>
                            <div class="col-lg-10">
                                {{ html()->number('image_product_height')
                                    ->class(['form-control', 'is-invalid' => $errors->has('image_product_height')])
                                    ->attributes(['autocomplete' => 'off'])
                                    ->value(old('image_product_height', $settings['image_product_height']))
                                    ->required() }}

                                @error('image_product_height') <x-alert type="error" :message="$message"/> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1"></div>
                </div>
            </div>
        </div>
    </div>
    @endisModuleActive()

    {{ html()->form()->close() }}
@stop

@section('pageScript')
    <script src="{{asset('admin/assets/custom/bootstrap-toggle_v2.2.2/bootstrap-toggle.min.js')}}" type="text/javascript"></script>
@endsection
