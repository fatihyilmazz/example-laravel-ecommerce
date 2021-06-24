@extends('admin.layouts.app')

@php
    $pageTitle = __('text.brand.management');

    $subHeaderTitle = __('text.brand.management');
    $subHeaderBreadcrumbs = [['name' => __('text.brand.name_plural'), 'url' => route('admin.brands.index'), 'is_active' => false]];

    if (isset($brand)) {
        $subHeaderBreadcrumbs = array_merge($subHeaderBreadcrumbs, [['name' => __('text.crud.edit'), 'url' => $brand->editLink(), 'is_active' => true]]);
    } else {
        $subHeaderBreadcrumbs = array_merge($subHeaderBreadcrumbs, [['name' => __('text.crud.add_new'), 'url' => route('admin.brands.create'), 'is_active' => true]]);
    }

    $userCanCreateOrUpdate = false;
    if ((auth()->user()->can('create-brands') && Request::routeIs('admin.brands.create')) || (auth()->user()->can('update-brands') && Request::routeIs('admin.brands.edit'))) {
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
                    @if(isset($brand))
                        {{ __('text.brand.edit') }}
                    @else
                        {{ __('text.brand.create') }}
                    @endif
                </h3>
            </div>
        </div>

        @if(isset($brand))
            {{ html()->form('PUT', $brand->updateLink())->open() }}
        @else
            {{ html()->form('POST', route('admin.brands.store'))->open() }}
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
                        <label for="order" class="col-lg-2 col-form-label">{{ __('text.common.order') }}</label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                {{ html()->number('order')
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

                                {{ html()->checkbox('is_active')
                                        ->class(['form-control'])
                                        ->attributes([
                                            'data-toggle' => 'toggle',
                                            'data-on' => __('text.crud.active'),
                                            'data-off' => __('text.crud.passive'),
                                            'data-width' => '200',
                                            'data-onstyle' => 'success',
                                            'data-offstyle' => 'danger'
                                            ])
                                }}
                                @error('is_active') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                {{ html()->checkbox('is_active')
                                        ->class(['form-control'])
                                        ->attributes([
                                            'data-toggle' => 'toggle',
                                            'data-on' => __('text.crud.active'),
                                            'data-off' => __('text.crud.passive'),
                                            'data-width' => '200',
                                            'data-onstyle' => 'success',
                                            'data-offstyle' => 'danger',
                                            'disabled' => 'disabled'
                                            ])
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
