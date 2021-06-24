@extends('admin.layouts.app')

@php
    $pageTitle = __('text.menu_group.management');

    $subHeaderTitle = __('text.menu_group.management');
    $subHeaderBreadcrumbs = [['name' => __('text.menu_group.name_plural'), 'url' => route('admin.menu_groups.index'), 'is_active' => false]];

    if (isset($menuGroup)) {
        $subHeaderBreadcrumbs = array_merge($subHeaderBreadcrumbs, [['name' => __('text.crud.edit'), 'url' => $menuGroup->editLink(), 'is_active' => true]]);
    } else {
        $subHeaderBreadcrumbs = array_merge($subHeaderBreadcrumbs, [['name' => __('text.crud.add_new'), 'url' => route('admin.menu_groups.create'), 'is_active' => true]]);
    }

    $userCanCreateOrUpdate = false;
    if ((auth()->user()->can('create-menu-groups') && Request::routeIs('admin.menu_groups.create')) || (auth()->user()->can('update-menu-groups') && Request::routeIs('admin.menu_groups.edit'))) {
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
                    @if(isset($menuGroup))
                        {{ __('text.menu_group.edit') }}
                    @else
                        {{ __('text.menu_group.create') }}
                    @endif
                </h3>
            </div>
        </div>

        @if(isset($menuGroup))
            {{ html()->form('PUT', $menuGroup->updateLink())->open() }}
        @else
            {{ html()->form('POST', route('admin.menu_groups.store'))->open() }}
        @endif
        <div class="kt-portlet__body">

            <div class="offset-3">
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
                    <label for="name" class="col-2 col-form-label">{{ __('text.common.name') }} <span class="text-danger" title="{{ __('text.common.required_field') }}">*</span></label>
                    <div class="col-4">
                        @if($userCanCreateOrUpdate)
                            {{ html()->text('name')
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
                    <label for="order" class="col-2 col-form-label">{{ __('text.common.row_number') }}</label>
                    <div class="col-4">
                        @if($userCanCreateOrUpdate)
                            {{ html()->number('order')
                                ->class(['form-control', 'is-invalid' => $errors->has('order')])
                                ->attributes(['min' => 0, 'max' => 32767, 'autocomplete' => 'off'])
                                ->value(old('order') ? old('order') : (isset($menuGroup) ? $menuGroup->order : null))
                            }}
                            @error('order')  <x-alert type="error" :message="$message"/> @enderror
                        @else
                            {{ html()->number('order')->class(['form-control'])->attributes(['disabled' => 'disabled']) }}
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="is_active" class="col-2 col-form-label">{{ __('text.crud.status') }}</label>
                    <div class="col-4">
                        @if($userCanCreateOrUpdate)
                            <input type="hidden" name="is_active" value="0">

                            {{ html()->checkbox('is_active')->class(['form-control', 'is-invalid' => true])->attributes(['data-toggle' => 'toggle', 'data-on' => __('text.crud.active'), 'data-off' => __('text.crud.passive'),'data-width' => '200', 'data-onstyle' => 'success', 'data-offstyle' => 'danger'])}}
                            @error('is_active') <x-alert type="error" :message="$message"/> @enderror
                        @else
                            {{ html()->checkbox('is_active')->class(['form-control'])->attributes(['data-switch' => 'true', 'data-on-text' => __('text.crud.active'),
                                'data-off-text' => __('text.crud.passive'), 'data-handle-width' => '75', 'data-on-color' => 'success', 'data-off-color' => 'danger','disabled' => 'disabled'])}}
                        @endif

                    </div>
                </div>
            </div>
        </div>

        <div class="kt-portlet__foot kt-portlet__foot--solid">
            <div class="offset-md-3">
                <div class="form-group row">
                    <div class="col-6 text-right">
                        <div class="kt-form__actions">
                            @if($userCanCreateOrUpdate)
                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>{{ __('text.crud.save') }}</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{ html()->form()->close() }}
    </div>

@stop

@section('pageScript')
    <script src="{{asset('admin/assets/custom/bootstrap-toggle_v2.2.2/bootstrap-toggle.min.js')}}" type="text/javascript"></script>
@endsection
