@extends('admin.layouts.app')

@php
    $pageTitle = __('text.slider.management');

    $subHeaderTitle = __('text.slider.management');
    $subHeaderBreadcrumbs = [['name' => __('text.slider.name_plural'), 'url' => route('admin.sliders.index'), 'is_active' => false]];

    if (isset($slider)) {
        $subHeaderBreadcrumbs = array_merge($subHeaderBreadcrumbs, [['name' => __('text.crud.edit'), 'url' => $slider->editLink(), 'is_active' => true]]);
    } else {
        $subHeaderBreadcrumbs = array_merge($subHeaderBreadcrumbs, [['name' => __('text.crud.add_new'), 'url' => route('admin.sliders.create'), 'is_active' => true]]);
    }

    $userCanCreateOrUpdate = false;
    if ((auth()->user()->can('create-sliders') && Request::routeIs('admin.sliders.create')) || (auth()->user()->can('update-sliders') && Request::routeIs('admin.sliders.edit'))) {
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
                    @if(isset($slider))
                        {{ __('text.slider.edit') }}
                    @else
                        {{ __('text.slider.create') }}
                    @endif
                </h3>
            </div>
        </div>

        @if(isset($slider))
            {{ html()->form('PUT', $slider->updateLink())->attributes(['enctype' => 'multipart/form-data'])->open() }}
        @else
            {{ html()->form('POST', route('admin.sliders.store'))->attributes(['enctype' => 'multipart/form-data'])->open() }}
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

                    <div class="form-group row justify-content-center">
                        @if(isset($slider) && !empty($slider->media->first()->source))
                            <input type="hidden" name="is_image_exists" value="1">

                            <img src="{{ asset(env('IMAGE_PATH_SLIDER', \App\Media::DEFAULT_IMAGE_PATH_SLIDER). $slider->media->first()->source) }}" class="img-thumbnail" id="picture-preview">
                        @else
                            <input type="hidden" name="is_image_exists" value="0">

                            <img src="{{ asset('images/no-image.png') }}" class="img-thumbnail" id="picture-preview">
                        @endif

                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-lg-2 col-form-label">{{ __('text.common.name') }} <span class="text-danger" title="{{ __('text.common.required_field') }}">*</span></label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                {{ html()
                                        ->text('name')
                                        ->class(['form-control', 'is-invalid' => $errors->has('name')])
                                        ->autofocus()
                                        ->required()
                                        ->attributes(['maxlength' => 255, 'minlength' => 1, 'autocomplete' => 'off'])
                                }}
                                @error('name') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                {{ html()->text('name')->class(['form-control'])->attributes(['disabled' => 'disabled']) }}
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="slider_type_id" class="col-lg-2 col-form-label">{{ __('text.slider_type.name_singular') }}</label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                <select name="slider_type_id" id="slider_type_id" class="form-control select2 d-block w-100 @error('slider_type_id') is-invalid @enderror()">
                                    <option value="">{{ __('text.crud.select') }}</option>
                                    @foreach($sliderTypes as $key => $value)
                                        <option value="{{ $key }}" {{ old('slider_type_id', (isset($slider) ? $slider->slider_type_id : null)) == $key ? 'selected' : null }}>
                                            {{ __('text.slider_type.'. $value) }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('slider_type_id') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                <select class="form-control select2 d-block w-100" disabled>
                                    @foreach($sliderTypes as $key => $value)
                                        <option value="{{ $key }}" {{ (isset($slider) ? $slider->slider_type_id : null) == $key ? 'selected' : '' }}>{{ __('text.slider_type.'. $value) }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row" id="page_section" style="display: {{ old('slider_type_id', (isset($slider) ? $slider->slider_type_id : null)) == \App\SliderType::ID_TYPE_PAGE ? 'flex' : 'none' }};">
                        <label for="page_id" class="col-lg-2 col-form-label">{{ __('text.slider_type.page') }} <span class="text-danger" title="{{ __('text.common.required_field') }}">*</span></label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                {{ html()
                                    ->select('page_id')
                                    ->class(['form-control select2 d-block w-100', 'is-invalid' => $errors->has('page_id')])
                                    ->options($pages)
                                    ->attributes(['autocomplete' => 'off'])
                                    ->placeholder(__('text.crud.select'))
                                    ->required(old('page_id', (isset($slider) ? $slider->slider_type_id : null)) == \App\SliderType::ID_TYPE_PAGE ? true : false)
                                    ->value(old('page_id', ((isset($slider) ? $slider->slider_type_id : null) == \App\SliderType::ID_TYPE_PAGE ? $slider->type_value : null)))
                                }}

                                @error('page_id') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                {{ html()
                                    ->select('page_id')
                                    ->class(['form-control select2 d-block w-100'])
                                    ->options($pages)
                                    ->attributes(['disable' => true])
                                    ->placeholder(__('text.crud.select'))
                                    ->value((isset($slider) ? $slider->slider_type_id : null) == \App\SliderType::ID_TYPE_PAGE ? $slider->type_value : null)
                                }}
                            @endif
                        </div>
                    </div>

                    <div class="form-group row" id="link_section" style="display: {{ old('slider_type_id', (isset($slider) ? $slider->slider_type_id : null)) == \App\SliderType::ID_TYPE_LINK ? 'flex' : 'none' }};">
                        <label for="link" class="col-lg-2 col-form-label">{{ __('text.slider_type.link') }} <span class="text-danger" title="{{ __('text.common.required_field') }}">*</span></label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                {{ html()
                                    ->input('url', 'link')
                                    ->class(['form-control', 'is-invalid' => $errors->has('link')])
                                    ->attributes(['autocomplete' => 'off'])
                                    ->required(old('link', (isset($slider) ? $slider->slider_type_id : null)) == \App\SliderType::ID_TYPE_LINK ? true : false)
                                    ->value(old('link', ((isset($slider) ? $slider->slider_type_id : null) == \App\SliderType::ID_TYPE_LINK ? $slider->type_value : null)))
                                }}

                                @error('link') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                {{ html()
                                    ->input('url', 'link')
                                    ->class(['form-control', 'is-invalid' => $errors->has('link')])
                                    ->attributes(['disable' => true])
                                    ->value((isset($slider) ? $slider->slider_type_id : null) == \App\SliderType::ID_TYPE_LINK ? $slider->type_value : null)
                                }}
                            @endif
                        </div>
                    </div>

                    <div class="form-group row" id="categories_section" style="display: {{ old('slider_type_id', (isset($slider) ? $slider->slider_type_id : null)) == \App\SliderType::ID_TYPE_CATEGORY ? 'flex' : 'none' }};">
                        <label for="category_id" class="col-lg-2 col-form-label">{{ __('text.slider_type.category') }} <span class="text-danger" title="{{ __('text.common.required_field') }}">*</span></label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                {{ html()
                                    ->select('category_id')
                                    ->class(['form-control select2 d-block w-100', 'is-invalid' => $errors->has('category_id')])
                                    ->options($categories)
                                    ->attributes(['autocomplete' => 'off'])
                                    ->required(old('category_id', (isset($slider) ? $slider->slider_type_id : null)) == \App\SliderType::ID_TYPE_CATEGORY ? true : false)
                                    ->value(old('category_id', ((isset($slider) ? $slider->slider_type_id : null) == \App\SliderType::ID_TYPE_CATEGORY ? $slider->type_value : null)))
                                }}

                                @error('category_id') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                {{ html()
                                    ->select('category_id')
                                    ->class(['form-control select2 d-block w-100'])
                                    ->options($categories)
                                    ->attributes(['disabled' => true])
                                    ->value((isset($slider) ? $slider->slider_type_id : null) == \App\SliderType::ID_TYPE_CATEGORY ? $slider->type_value : null)
                                }}
                            @endif
                        </div>
                    </div>

                    <div class="form-group row" id="brands_section" style="display: {{ old('slider_type_id', (isset($slider) ? $slider->slider_type_id : null)) == \App\SliderType::ID_TYPE_BRAND ? 'flex' : 'none' }};">
                        <label for="brand_id" class="col-lg-2 col-form-label">{{ __('text.slider_type.brand') }} <span class="text-danger" title="{{ __('text.common.required_field') }}">*</span></label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                {{ html()
                                    ->select('brand_id')
                                    ->class(['form-control select2 d-block w-100', 'is-invalid' => $errors->has('brand_id')])
                                    ->options($brands)
                                    ->attributes(['autocomplete' => 'off'])
                                    ->required(old('brand_id', (isset($slider) ? $slider->slider_type_id : null)) == \App\SliderType::ID_TYPE_BRAND ? true : false)
                                    ->value(old('brand_id', ((isset($slider) ? $slider->slider_type_id : null) == \App\SliderType::ID_TYPE_BRAND ? $slider->type_value : null)))
                                }}

                                @error('brand_id') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                {{ html()
                                    ->select('brand_id')
                                    ->class(['form-control select2 d-block w-100'])
                                    ->options($brands)
                                    ->attributes(['disabled' => true])
                                    ->value((isset($slider) ? $slider->slider_type_id : null) == \App\SliderType::ID_TYPE_BRAND ? $slider->type_value : null)
                                }}
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="image" class="col-lg-2 col-form-label">{{ __('text.common.choose_file') }}<span class="text-danger" title="{{ __('text.common.required_field') }}">*</span></label>

                        <div class="col-lg-10">
{{--                            <label class="custom-file-label">{{ __('text.common.choose_file') }}</label>--}}
                            @if($userCanCreateOrUpdate)
                                <div class="kt-form__group--inline col-lg-12">
                                    <div class="kt-form__label">
                                        <label for="image" class="custom-file-label">{{ __('text.common.choose_file') }}</label>
                                        <input type="file" name="image" id="image" {{ isset($slider) ? '' : 'required'  }} class="custom-file-input" accept="image/*" onchange="addImageToPreview(this, 'picture-preview')">
                                    </div>
                                </div>
{{--                                <input type="file" name="image" id="image" required class="custom-file-input" accept="image/*" onchange="addImageToPreview(this, '+ pictureItemNumber +')">--}}

                                <span class="form-text text-danger">
                                    {{ __('text.common.allowed_size', ['size' => \App\Setting::IMAGE_SLIDER_MAX_SIZE]) }},
                                    {{ __('text.common.allowed_width', ['width' => \App\Setting::IMAGE_SLIDER_WIDTH]) }},
                                    {{ __('text.common.allowed_height', ['height' => \App\Setting::IMAGE_SLIDER_HEIGHT]) }}
                                </span>

                                @error('image')  <x-alert type="error" :message="$message"/> @enderror
                            @else
                                {{ html()->text('image')->class(['form-control', 'disabled' => true])->attributes(['autocomplete' => 'off']) }}
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="start_at" class="col-lg-2 col-form-label">{{ __('text.common.start_at') }}</label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                {{ html()->text('started_at')->class(['form-control date-range-single-picker-started-at', 'is-invalid' => $errors->has('started_at')])->attributes(['autocomplete' => 'off']) }}

                                @error('started_at')  <x-alert type="error" :message="$message"/> @enderror
                            @else
                                {{ html()->text('started_at')->class(['form-control', 'disabled' => true])->attributes(['autocomplete' => 'off']) }}
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="end_at" class="col-lg-2 col-form-label">{{ __('text.common.end_at') }}</label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                {{ html()->text('end_at')->class(['form-control date-range-single-picker-end-at', 'is-invalid' => $errors->has('end_at')])->attributes(['autocomplete' => 'off']) }}

                                @error('end_at')  <x-alert type="error" :message="$message"/> @enderror
                            @else
                                {{ html()->text('end_at')->class(['form-control', 'disabled' => true])->attributes(['autocomplete' => 'off']) }}
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="order" class="col-lg-2 col-form-label">{{ __('text.common.order') }}</label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                {{ html()->number('order')->class(['form-control', 'is-invalid' => $errors->has('order')])->attributes(['min' => 0, 'max' => 32767, 'autocomplete' => 'off']) }}

                                @error('order')  <x-alert type="error" :message="$message"/> @enderror
                            @else
                                <input type="text" class="form-control" disabled value="{{ isset($slider) ? $slider->order : null }}">
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="is_published" class="col-lg-2 col-form-label">{{ __('text.crud.status') }}</label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                <input type="hidden" name="is_published" value="0">

                                {{ html()->checkbox('is_published')
                                    ->class(['form-control'])
                                    ->attributes(['data-toggle' => 'toggle', 'data-on' => __('text.crud.active'), 'data-off' => __('text.crud.passive'),
                                    'data-width' => '200', 'data-onstyle' => 'success', 'data-offstyle' => 'danger'])
                                }}

                                @error('is_published') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                {{ html()->checkbox('is_published')
                                    ->class(['form-control'])
                                    ->attributes(['data-toggle' => 'toggle', 'data-on' => __('text.crud.active'), 'data-off' => __('text.crud.passive'),
                                    'data-width' => '200', 'data-onstyle' => 'success', 'data-offstyle' => 'danger', 'disabled' => 'disabled'])}}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-1"></div>
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
    <script src="{{asset('admin/assets/vendors/custom/datatables/datatables.bundle.js')}}" type="text/javascript"></script>

    <script>
        jQuery(document).ready(function() {
            let currentLocale = $("input[name=currentLocale]").val();

            createDateRangePickerForElement('date-range-single-picker-started-at', currentLocale);
            createDateRangePickerForElement('date-range-single-picker-end-at', currentLocale);
        });

        let slugUrl ='{{ route('admin.slug.create') }}';
        let swalTitleForSlug = "{{ __('messages.slug.auto_slug_failed') }}";
        let swalButtonTextSlug = "{{ __('text.common.ok') }}";

        $( "#slider_type_id" ).change(function() {
            let sliderTypeId = $(this).children("option:selected").val();

            let pageSection = $("#page_section");
            let pageId = $("#page_id");

            let linkSection = $("#link_section");
            let link = $("#link");

            let categorySection =  $("#categories_section");
            let categoryIdElement = $("#category_id");

            let brandSection =  $("#brands_section");
            let brandIdElement = $("#brand_id");

            pageSection.hide();
            pageId.val(null).trigger('change').prop('required',false);

            linkSection.hide();
            link.val(null).trigger('change').prop('required',false);

            categorySection.hide();
            categoryIdElement.val(null).trigger('change').prop('required',false);

            brandSection.hide();
            brandIdElement.val(null).trigger('change').prop('required',false);

            if (sliderTypeId == {{ \App\SliderType::ID_TYPE_PAGE }}) {
                pageSection.show();
                pageId.prop('required', true);
            } else if (sliderTypeId == {{ \App\SliderType::ID_TYPE_LINK }}) {
                linkSection.show();
                link.prop('required', true);
            } else if (sliderTypeId == {{ \App\SliderType::ID_TYPE_CATEGORY }}) {
                categorySection.show();
                categoryIdElement.prop('required', true);
            } else if (sliderTypeId == {{ \App\SliderType::ID_TYPE_BRAND }}) {
                brandSection.show();
                brandIdElement.prop('required', true);
            }

            initSelect2();
        });
    </script>
@endsection
