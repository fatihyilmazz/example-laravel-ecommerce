@extends('admin.layouts.app')

@php
    $pageTitle = __('text.category.management');

    $subHeaderTitle = __('text.category.management');
    $subHeaderBreadcrumbs = [['name' => trans_choice('text.category.name', 2), 'url' => route('admin.categories.index'), 'is_active' => false]];

    if (isset($category)) {
        $subHeaderBreadcrumbs = array_merge($subHeaderBreadcrumbs, [['name' => __('text.crud.edit'), 'url' => $category->editLink(), 'is_active' => true]]);
    } else {
        $subHeaderBreadcrumbs = array_merge($subHeaderBreadcrumbs, [['name' => __('text.crud.add_new'), 'url' => route('admin.categories.create'), 'is_active' => true]]);
    }

    $userCanCreateOrUpdate = false;
    if ((auth()->user()->can('create-categories') && Request::routeIs('admin.categories.create')) || (auth()->user()->can('update-categories') && Request::routeIs('admin.categories.edit'))) {
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
                    @if(isset($category))
                        {{ __('text.category.edit') }}
                    @else
                        {{ __('text.category.create') }}
                    @endif
                </h3>
            </div>
        </div>

        @if(isset($category))
            {{ html()->form('PUT', $category->updateLink())->open() }}
        @else
            {{ html()->form('POST', route('admin.categories.store'))->open() }}
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
                        <label for="parent_id" class="col-lg-2 col-form-label">{{ __('text.category.parent_category') }} </label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                {{ html()
                                    ->select('parent_id')
                                    ->class(['form-control select2 d-block w-100', 'is-invalid' => $errors->has('parent_id')])
                                    ->options($categories)
                                    ->value(old('parent_id', (isset($category) ? $category->parent_id : null)))
                                    ->attributes(['autocomplete' => 'off'])
                                    ->placeholder(__('text.crud.select'))
                                }}

                                @error('parent_id') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                {{ html()->text('parent_id')->class(['form-control'])->attributes(['disabled' => 'disabled']) }}
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="order" class="col-lg-2 col-form-label">{{ __('text.common.order') }}</label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                {{ html()
                                    ->number('order')
                                    ->class(['form-control', 'is-invalid' => $errors->has('order')])
                                    ->attributes(['min' => 0, 'max' => 32767, 'autocomplete' => 'off'])
                                }}

                                @error('order')  <x-alert type="error" :message="$message"/> @enderror
                            @else
                                {{ html()->number('order')->class(['form-control'])->attributes(['disabled' => 'disabled']) }}
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="is_active" class="col-lg-2 col-form-label">{{ __('text.crud.status') }}</label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                <input type="hidden" name="is_active" value="0">

                                {{ html()->checkbox('is_active')->class(['form-control'])->attributes(['data-toggle' => 'toggle', 'data-on' => __('text.crud.active'), 'data-off' => __('text.crud.passive'),'data-width' => '200', 'data-onstyle' => 'success', 'data-offstyle' => 'danger'])}}
                                @error('is_active') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                {{ html()->checkbox('is_active')->class(['form-control'])->attributes(['data-toggle' => 'toggle', 'data-on' => __('text.crud.active'), 'data-off' => __('text.crud.passive'),
                                    'data-width' => '200', 'data-onstyle' => 'success', 'data-offstyle' => 'danger', 'disabled' => 'disabled'])}}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-1"></div>
            </div>

            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>

            <div class="kt-section">
                <div class="kt-section__body">
                    <div class="row">
                        <div class="col-lg-1"></div>

                        <div class="col-lg-10">
                            <h3 class="kt-section__title kt-section__title-lg">{{ __('text.common.translations') }}</h3>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <ul class="nav nav-pills nav-fill" role="tablist">
                                        @foreach($locales as $locale)
                                            <li class="nav-item">
                                                <a class="nav-link @if ($loop->first) active @endif" data-toggle="tab" href="#{{ $locale->code }}">
                                                    {{ $locale->native_name. '-'. Str::upper($locale->code) }}

                                                    @if($errors->has("{$locale->code}.*"))
                                                        &nbsp;
                                                        <span class="badge badge-warning"><i class="flaticon-warning-sign"></i></span>
                                                    @endif

                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>

                                    <div class="tab-content">
                                        @foreach($locales as $locale)
                                            <div class="tab-pane @if ($loop->first) active @endif" id="{{ $locale->code }}" role="tabpanel">
                                                @if($userCanCreateOrUpdate)
                                                    <input type="hidden" name="translations[{{ $loop->index }}][id]" value="{{ (isset($category) ? $category->translations->firstWhere('locale', $locale->code)->id : null)  }}">
                                                    <input type="hidden" name="translations[{{ $loop->index }}][locale]" value="{{ $locale->code }}">
                                                @endif
                                                <div class="form-group row">
                                                    <label for="translations{{ $loop->index }}name" class="col-lg-2 col-form-label">{{ __('text.common.name') }} <span class="text-danger" title="{{ __('text.common.required_field') }}">*</span></label>
                                                    <div class="col-lg-10">
                                                        @if($userCanCreateOrUpdate)
                                                            <input
                                                                type="text"
                                                                name="translations[{{ $loop->index }}][name]" id="translations{{ $loop->index }}name"
                                                                class="form-control @error("{$locale->code}.name") is-invalid @enderror"
                                                                required
                                                                maxlength="255" minlength="1" autocomplete="off"
                                                                value='{{ old('translations.'.$loop->index.'.name', (isset($category) ? $category->translations->firstWhere('locale', $locale->code)->name : '')) }}'
                                                                onfocusout="generateSlug(
                                                                            'product',
                                                                            '{{ $locale->code }}',
                                                                            'translations{{ $loop->index }}name',
                                                                            'translations{{ $loop->index }}slug',
                                                                            '{{ (isset($product) ? $product->translations->firstWhere('locale', $locale->code)->id : '') }}'
                                                                        )"
                                                            >

                                                            @error("{$locale->code}.name") <x-alert type="error" :message="$message"/> @enderror
                                                        @else
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                disabled
                                                                value="{{ isset($category) ? $category->translate($locale->code)->name : '' }}"
                                                            >
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="translations{{ $loop->index }}slug" class="col-lg-2 col-form-label">{{ __('text.common.slug') }} <span class="text-danger" title="{{ __('text.common.required_field') }}">*</span></label>
                                                    <div class="col-lg-10">
                                                        @if($userCanCreateOrUpdate)
                                                            <input
                                                                type="text"
                                                                name="translations[{{ $loop->index }}][slug]" id="translations{{ $loop->index }}slug"
                                                                class="form-control @error("{$locale->code}.slug") is-invalid @enderror"
                                                                required
                                                                maxlength="255"
                                                                minlength="1"
                                                                autocomplete="off"
                                                                value='{{ old('translations.'.$loop->index.'.slug', (isset($category) ? $category->translations->firstWhere('locale', $locale->code)->slug : '')) }}'
                                                            >

                                                            @error("{$locale->code}.slug") <x-alert type="error" :message="$message"/> @enderror
                                                        @else
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                disabled
                                                                value="{{ isset($category) ? $category->translate($locale->code)->slug : '' }}"
                                                            >
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-1"></div>
                    </div>
                </div>
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
    <script src="{{ asset('admin/assets/js/sluggable.js') }}"></script>

    <script>
        let slugUrl ='{{ route('admin.slug.create') }}';
        let swalTitle = "{{ __('messages.slug.auto_slug_failed') }}";
        let swalButtonText = "{{ __('text.common.ok') }}";
    </script>
@endsection
