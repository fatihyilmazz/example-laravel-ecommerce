@extends('admin.layouts.app')

@php
    $pageTitle = __('text.page.management');

    $subHeaderTitle = __('text.page.management');
    $subHeaderBreadcrumbs = [['name' => __('text.page.name_plural'), 'url' => route('admin.pages.index'), 'is_active' => false]];

    if (isset($page)) {
        $subHeaderBreadcrumbs = array_merge($subHeaderBreadcrumbs, [['name' => __('text.crud.edit'), 'url' => $page->editLink(), 'is_active' => true]]);
    } else {
        $subHeaderBreadcrumbs = array_merge($subHeaderBreadcrumbs, [['name' => __('text.crud.add_new'), 'url' => route('admin.pages.create'), 'is_active' => true]]);
    }

    $userCanCreateOrUpdate = false;
    if ((auth()->user()->can('create-pages') && Request::routeIs('admin.pages.create')) || (auth()->user()->can('update-pages') && Request::routeIs('admin.pages.edit'))) {
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
                    @if(isset($page))
                        {{ __('text.page.edit') }}
                    @else
                        {{ __('text.page.create') }}
                    @endif
                </h3>
            </div>
        </div>

        @if(isset($page))
            {{ html()->form('PUT', $page->updateLink())->open() }}
        @else
            {{ html()->form('POST', route('admin.pages.store'))->open() }}
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
                                {{ html()->text('name')
                                    ->class(['form-control', 'is-invalid' => $errors->has('name')])
                                    ->autofocus()->required()
                                    ->attributes(['maxlength' => 255, 'minlength' => 1, 'autocomplete' => 'off'])
                                }}

                                @error('name') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                <input type="text" class="form-control" disabled value="{{ isset($page) ? $page->name : null }}">
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="is_active" class="col-lg-2 col-form-label">{{ __('text.crud.status') }}</label>
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
                                <input type="checkbox"
                                       class="form-control"
                                       disabled
                                       data-toggle="toggle" data-on="{{ __('text.crud.active') }}" data-off="{{ __('text.crud.passive') }}" data-width="200" data-onstyle="success" data-offstyle="danger"
                                    {{ isset($page) ? ($page->is_published ? 'checked' : null) : null }}
                                >
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

                                                    @if($errors->has('translations.'. $loop->index .'.*'))
                                                        &nbsp;
                                                        <span class="badge badge-warning"><i class="flaticon-warning-sign"></i></span>
                                                    @endif

                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>

                                    <div class="tab-content">
                                        @foreach($locales as $locale)
                                            @if($userCanCreateOrUpdate)
                                                <input type="hidden" name="translations[{{ $loop->index }}][locale]" value="{{ $locale->code }}">
                                                <input type="hidden" name="translations[{{ $loop->index }}][id]" value="{{ (isset($page) ? $page->translations->firstWhere('locale', $locale->code)->id : null)  }}">
                                            @endif

                                            <div class="tab-pane @if ($loop->first) active @endif" id="{{ $locale->code }}" role="tabpanel">
                                                <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-2x nav-tabs-line-success" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" data-toggle="tab" href="#page-info-{{ $locale->code }}" role="tab">{{ __('text.product.info') }}</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#page-seo-{{ $locale->code }}" role="tab">{{ __('text.product.seo') }}</a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="page-info-{{ $locale->code }}" role="tabpanel">
                                                        <div class="form-group row">
                                                            <label for="translations[{{ $loop->index }}][content]" class="col-lg-2 col-form-label">{{ __('text.common.content') }}</label>
                                                            <div class="col-lg-10">
                                                                @if($userCanCreateOrUpdate)
                                                                    <textarea
                                                                        name="translations[{{ $loop->index }}][content]" id="translations[{{ $loop->index }}][content]"
                                                                        class="form-control product-content @error("translations.{$loop->index}.content") is-invalid @enderror"
                                                                        autocomplete="off"
                                                                        cols="50"
                                                                    >{{ old('translations.'.$loop->index.'.content', (isset($page) ? $page->translations->firstWhere('locale', $locale->code)->content : '')) }}</textarea>

                                                                    @error("translations.{$loop->index}.content") <x-alert type="error" :message="$message"/> @enderror
                                                                @else
                                                                    <textarea
                                                                        class="form-control"
                                                                        disabled
                                                                    >{{ (isset($page) ? $page->translations->firstWhere('locale', $locale->code)->content : null) }}</textarea>
                                                                @endif
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="tab-pane" id="page-seo-{{ $locale->code }}" role="tabpanel">
                                                        <div class="form-group row">
                                                            <label for="translations{{ $loop->index }}slug" class="col-lg-2 col-form-label">{{ __('text.common.slug') }} <span class="text-danger" title="{{ __('text.common.required_field') }}">*</span></label>
                                                            <div class="col-lg-10">
                                                                @if($userCanCreateOrUpdate)
                                                                    <input
                                                                        type="text"
                                                                        name="translations[{{ $loop->index }}][slug]" id="translations{{ $loop->index }}slug"
                                                                        class="form-control @error("translations.{$loop->index}.slug") is-invalid @enderror"
                                                                        required
                                                                        maxlength="255" minlength="1" autocomplete="off"
                                                                        value='{{ old('translations.'.$loop->index.'.slug', (isset($page) ? $page->translations->firstWhere('locale', $locale->code)->slug : '')) }}'
                                                                    >

                                                                    @error("translations.{$loop->index}.slug") <x-alert type="error" :message="$message"/> @enderror
                                                                @else
                                                                    <input
                                                                        type="text"
                                                                        class="form-control"
                                                                        disabled
                                                                        value="{{ isset($page) ? $page->translate($locale->code)->slug : '' }}"
                                                                    >
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="translations{{ $loop->index }}keywords" class="col-lg-2 col-form-label">{{ __('text.common.keywords') }}</label>
                                                            <div class="col-lg-10">
                                                                @if($userCanCreateOrUpdate)
                                                                    <input
                                                                        type="text"
                                                                        name="translations[{{ $loop->index }}][keywords]" id="translations{{ $loop->index }}keywords"
                                                                        class="form-control @error("translations.{$loop->index}.keywords") is-invalid @enderror"
                                                                        maxlength="255"
                                                                        minlength="1"
                                                                        autocomplete="off"
                                                                        value='{{ old(('translations.'.$loop->index.'.keywords'), (isset($page) ? $page->translations->firstWhere('locale', $locale->code)->metas['keywords'] : null)) }}'
                                                                    >

                                                                    @error("translations.{$loop->index}.keywords") <x-alert type="error" :message="$message"/> @enderror
                                                                @else
                                                                    <input
                                                                        type="text"
                                                                        class="form-control"
                                                                        disabled
                                                                        value="{{ (isset($page) ? $page->translations->firstWhere('locale', $locale->code)->metas['keywords'] : null) }}"
                                                                    >
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="translations{{ $loop->index }}description" class="col-lg-2 col-form-label">{{ __('text.common.description') }}</label>
                                                            <div class="col-lg-10">
                                                                @if($userCanCreateOrUpdate)
                                                                    <input
                                                                        type="text"
                                                                        name="translations[{{ $loop->index }}][description]" id="translations{{ $loop->index }}description"
                                                                        class="form-control @error("translations.{$loop->index}.description") is-invalid @enderror"
                                                                        maxlength="255" minlength="1" autocomplete="off"
                                                                        value='{{ old(('translations.'.$loop->index.'.description'), (isset($page) ? $page->translations->firstWhere('locale', $locale->code)->metas['description'] : null)) }}'
                                                                    >

                                                                    @error("translations.{$loop->index}.description") <x-alert type="error" :message="$message"/> @enderror
                                                                @else
                                                                    <input
                                                                        type="text"
                                                                        class="form-control"
                                                                        disabled
                                                                        value="{{ (isset($page) ? $page->translations->firstWhere('locale', $locale->code)->metas['description'] : null) }}"
                                                                    >
                                                                @endif
                                                            </div>
                                                        </div>
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
    <script src="{{ asset('admin/assets/custom/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('admin/assets/custom/tinymce/tinymce-include.js') }}"></script>

    <script>
        let imageFileUploadPathForTinymce = "{{ \App\Media::DEFAULT_IMAGE_PATH_PAGE }}";
    </script>
@endsection
