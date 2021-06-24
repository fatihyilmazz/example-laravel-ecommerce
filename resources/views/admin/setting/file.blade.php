@extends('admin.layouts.app')

@php
    $pageTitle = __('text.setting.file');

    $subHeaderTitle = __('text.setting.file');
    $subHeaderBreadcrumbs = [['name' => __('text.setting.file'), 'url' => route('admin.setting.image.index'), 'is_active' => true]];
@endphp

@section('pageStyle')
    <link href="{{asset('admin/assets/custom/bootstrap-toggle_v2.2.2/bootstrap-toggle.min.css')}}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')

    {{ html()->form('PUT', route('admin.setting.file.update'))->open() }}

    @isModuleActive([\App\Module::ID_PRODUCT_MANAGEMENT], $moduleIds)
        <div class="kt-portlet kt-portlet--head-lg kt-portlet--responsive-mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <i class="fa fa-images"></i>&nbsp;
                    <h3 class="kt-portlet__head-title">
                        {{ __('text.product.name_singular') }}
                    </h3>
                </div>

                <div class="kt-portlet__head-toolbar">
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>{{ __('text.crud.save') }}</button>
                </div>

            </div>
            <div class="kt-portlet__body">
                <div class="kt-portlet__content">
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
                                <label for="image_product_max_size" class="col-lg-2 col-form-label">
                                    {{ __('text.common.max_size_with_kb') }}
                                    <span class="text-danger" title="{{ __('text.common.required_field') }}">*</span>
                                </label>
                                <div class="col-lg-10">
                                    {{ html()->number('file_product_max_size')
                                        ->class(['form-control', 'is-invalid' => $errors->has('file_product_max_size')])
                                        ->attributes(['autocomplete' => 'off'])
                                        ->value(old('file_product_max_size', $settings['file_product_max_size']))
                                        ->required() }}

                                    @error('file_product_max_size') <x-alert type="error" :message="$message"/> @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="file_product_allowed_file_types" class="col-lg-2 col-form-label">
                                    {{ __('text.common.allowed_file_types') }}
                                    <span class="text-danger" title="{{ __('text.common.required_field') }}">*</span>
                                </label>
                                <div class="col-lg-10">
                                    <select
                                        name="file_product_allowed_file_types[]"
                                        id="file_product_allowed_file_types"
                                        class="form-control select2 d-block w-100 @error('file_product_allowed_file_types') is-invalid @enderror()"
                                        autocomplete="off"
                                        multiple
                                        placeholder="{{ __('text.crud.select') }}"
                                    >
                                        @foreach($fileTypeOptions as $optionKey => $option)
                                            @php
                                                $selectedOptions = explode(',', $settings['file_product_allowed_file_types']);

                                                $isSelected = false;
                                                foreach ($selectedOptions as $selectedOptionKey => $selectedOption) {
                                                    if($option === $selectedOption){
                                                        $isSelected = true;
                                                    }
                                                }
                                            @endphp

                                            <option value="{{ $optionKey }}" @if($isSelected) selected @endif>{{ $option }}</option>

                                        @endforeach

                                    </select>

                                    @error('file_product_allowed_file_types') <x-alert type="error" :message="$message"/> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1"></div>
                    </div>
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

    {{ html()->form()->close() }}
@stop

@section('pageScript')
    <script src="{{asset('admin/assets/custom/bootstrap-toggle_v2.2.2/bootstrap-toggle.min.js')}}" type="text/javascript"></script>
@endsection
