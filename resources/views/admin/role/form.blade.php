@extends('admin.layouts.app')

@php
    $pageTitle = __('text.role.management');

    $subHeaderTitle = __('text.role.management');
    $subHeaderBreadcrumbs = [['name' => __('text.role.name_plural'), 'url' => route('admin.roles.index'), 'is_active' => false]];

    if (isset($role)) {
        $subHeaderBreadcrumbs = array_merge($subHeaderBreadcrumbs, [['name' => __('text.crud.edit'), 'url' => route('admin.roles.edit', $role->id), 'is_active' => true]]);
    } else {
        $subHeaderBreadcrumbs = array_merge($subHeaderBreadcrumbs, [['name' => __('text.crud.add_new'), 'url' => route('admin.roles.create'), 'is_active' => true]]);
    }

    $userCanCreateOrUpdate = false;
    if ((auth()->user()->can('create-roles') && Request::routeIs('admin.roles.create')) || (auth()->user()->can('update-roles') && Request::routeIs('admin.roles.edit'))) {
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
                    @if(isset($role))
                        {{ __('text.role.edit') }}
                    @else
                        {{ __('text.role.create') }}
                    @endif
                </h3>
            </div>
        </div>

        @if(isset($role))
            {{ html()->form('PUT', $role->updateLink())->open() }}
        @else
            {{ html()->form('POST', route('admin.roles.store'))->open() }}
        @endif

        <div class="kt-portlet__body">
            <div class="row">
                <div class="col-lg-12">
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
                    <div class="col-12">
                        <div class="form-group row">
                            <label for="name" class="col-lg-2 col-form-label">
                                {{ __('text.common.name') }}
                                <span class="text-danger" title="{{ __('text.common.required_field') }}">*</span>
                            </label>
                            <div class="col-lg-10">
                                @if($userCanCreateOrUpdate)
                                    {{ html()
                                            ->text('name')
                                            ->class(['form-control', 'is-invalid' => $errors->has('name')])
                                            ->autofocus()
                                            ->required()
                                            ->value(old('name', (isset($role) ? $role->name : null)))
                                            ->attributes(['maxlength' => 255, 'minlength' => 1, 'autocomplete' => 'off'])
                                    }}

                                    @error('name')<x-alert type="error" :message="$message"/> @enderror
                                @else
                                    {{ html()
                                        ->text('name')
                                        ->class(['form-control'])
                                        ->attributes(['disabled' => 'disabled'])
                                        ->value(isset($role) ? $role->name : '')
                                    }}
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            @foreach(__('permissions') as $key => $modulePermissions)
                                @isModuleActive([$key], $moduleIds)
                                <div class="col-xl-4">
                                    <div class="kt-portlet kt-portlet--height-fluid">
                                        <div class="kt-portlet__head kt-portlet__head--noborder">
                                            <div class="kt-portlet__head-label">
                                                <h3 class="kt-portlet__head-title">
                                                    {{ __('permissions.module_names.'. $key) }}
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="kt-portlet__body">
                                            <div class="kt-widget kt-widget--user-profile-3">
                                                <div class="kt-widget__body">
                                                    <div class="portlet-body">
                                                        <div class="table-scrollable">
                                                            <table class="table table-striped table-hover">
                                                                <thead>
                                                                <tr>
                                                                    <th> {{ __('text.permissions.name_singular') }}</th>
                                                                    <th> {{ __('text.crud.status') }}</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($modulePermissions as $key => $permission)
                                                                    <tr>
                                                                        <td>
                                                                            <label class="checkbox">
                                                                                <span></span>{{ $permission }}
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            {{ html()
                                                                                ->checkbox('permissions['.$key.']', in_array($key, $rolePermissions ?? []))
                                                                                ->class(['form-control checkSingle'])
                                                                                ->attributes(['data-toggle' => 'toggle', 'data-on' => __('text.crud.active'), 'data-off' => __('text.crud.passive'),
                                                                                    'data-width' => '100', 'data-onstyle' => 'success', 'data-offstyle' => 'danger'])
                                                                             }}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endisModuleActive()
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="kt-portlet__foot kt-portlet__foot--solid">
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
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
                <div class="col-1"></div>
            </div>
        </div>

        {{ html()->form()->close() }}

    </div>

@stop

@section('pageScript')
    <script src="{{asset('admin/assets/custom/bootstrap-toggle_v2.2.2/bootstrap-toggle.min.js')}}" type="text/javascript"></script>
@endsection

