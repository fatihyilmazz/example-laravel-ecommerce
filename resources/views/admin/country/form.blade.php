@extends('admin.layouts.app')

@php
    $pageTitle = __('text.country.management');

    $subHeaderTitle = __('text.country.management');
    $subHeaderBreadcrumbs = [['name' => __('text.country.name_plural'), 'url' => route('admin.countries.index'), 'is_active' => false]];

    if (isset($country)) {
        $subHeaderBreadcrumbs = array_merge($subHeaderBreadcrumbs, [['name' => __('text.crud.edit'), 'url' => $country->editLink(), 'is_active' => true]]);
    } else {
        $subHeaderBreadcrumbs = array_merge($subHeaderBreadcrumbs, [['name' => __('text.crud.add_new'), 'url' => route('admin.countries.create'), 'is_active' => true]]);
    }

    $userCanCreateOrUpdate = false;
    if ((auth()->user()->can('create-countries') && Request::routeIs('admin.countries.create')) || (auth()->user()->can('update-countries') && Request::routeIs('admin.countries.edit'))) {
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
                    @if(isset($country))
                        {{ __('text.country.edit') }}
                    @else
                        {{ __('text.country.create') }}
                    @endif
                </h3>
            </div>
        </div>

        @if(isset($country))
            {{ html()->form('PUT', $country->updateLink())->open() }}
        @else
            {{ html()->form('POST', route('admin.countries.store'))->open() }}
        @endif
        <div class="kt-portlet__body">

            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
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
                        <label for="order" class="col-2 col-form-label">{{ __('text.common.order') }}</label>
                        <div class="col">
                            @if($userCanCreateOrUpdate)
                                {{ html()->number('order')
                                    ->class(['form-control', 'is-invalid' => $errors->has('order')])
                                    ->autofocus()
                                    ->attributes(['min' => 0, 'max' => 32767, 'autocomplete' => 'off'])
                                }}

                                @error('order')  <x-alert type="error" :message="$message"/> @enderror
                            @else
                                {{ html()->number('order')->class(['form-control'])->attributes(['disabled' => 'disabled']) }}
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="is_active" class="col-2 col-form-label">{{ __('text.crud.status') }}</label>
                        <div class="col">
                            @if($userCanCreateOrUpdate)
                                <input type="hidden" name="is_active" value="0">

                                {{ html()->checkbox('is_active')
                                    ->class(['form-control'])
                                    ->attributes(['data-toggle' => 'toggle', 'data-on' => __('text.crud.active'), 'data-off' => __('text.crud.passive'),
                                    'data-width' => '200', 'data-onstyle' => 'success', 'data-offstyle' => 'danger'])
                                }}

                                @error('is_active') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                {{ html()->checkbox('is_active')
                                    ->class(['form-control'])
                                    ->attributes(['data-toggle' => 'toggle', 'data-on' => __('text.crud.active'), 'data-off' => __('text.crud.passive'),
                                    'data-width' => '200', 'data-onstyle' => 'success', 'data-offstyle' => 'danger', 'disabled' => 'disabled'])}}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-1"></div>
            </div>
            <div class="offset-1"></div>

            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>

            <div class="kt-section">
                <div class="kt-section__body">
                    <div class="row">
                        <div class="col-1"></div>

                        <div class="col-10">
                            <h3 class="kt-section__title kt-section__title-lg">{{ __('text.common.translations') }}</h3>
                            <div class="form-group row">
                                <div class="col-12">
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
                                            <div class="tab-pane @if ($loop->first) active @endif" id="{{ $locale->code }}" role="tabpanel">
                                                @if($userCanCreateOrUpdate)
                                                    <input type="hidden" name="translations[{{ $loop->index }}][locale]" value="{{ $locale->code }}">
                                                    <input type="hidden" name="translations[{{ $loop->index }}][id]" value="{{ (isset($country) ? $country->translations->firstWhere('locale', $locale->code)->id : null)  }}">
                                                @endif
                                                <div class="form-group row">
                                                    <label for="translations[{{ $loop->index }}][name]" class="col-2 col-form-label">{{ __('text.common.name') }} <span class="text-danger" title="{{ __('text.common.required_field') }}">*</span></label>
                                                    <div class="col">
                                                        @if($userCanCreateOrUpdate)
                                                            <input
                                                                type="text"
                                                                name="translations[{{ $loop->index }}][name]" id="translations[{{ $loop->index }}][name]"
                                                                class="form-control @error("translations.{$loop->index}.name") is-invalid @enderror"
                                                                required
                                                                maxlength="255"
                                                                minlength="1"
                                                                autocomplete="off"
                                                                value='{{ old('translations.'.$loop->index.'.name', (isset($country) ? $country->translations->firstWhere('locale', $locale->code)->name : ''))  }}'
                                                            >

                                                            @error("translations.{$loop->index}.name") <x-alert type="error" :message="$message"/> @enderror
                                                        @else
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                disabled
                                                                value="{{ isset($country) ? $country->translate($locale->code)->name : '' }}"
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

                        <div class="col-1"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="kt-portlet__foot kt-portlet__foot--solid">
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
                    <div class="form-group row">
                        <div class="col text-right">
                            <div class="kt-form__actions">
                                @if((auth()->user()->can('create-countries') && Request::routeIs('admin.countries.create')) || (auth()->user()->can('update-countries') && Request::routeIs('admin.countries.edit')))
                                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>{{ __('text.crud.save') }}</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-1"></div>
            </div>
        </div>

        {{ html()->form()->close() }}
    </div>

@stop

@section('pageScript')
    <script src="{{asset('admin/assets/custom/bootstrap-toggle_v2.2.2/bootstrap-toggle.min.js')}}" type="text/javascript"></script>
@endsection
