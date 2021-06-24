@extends('admin.layouts.app')

@php
    $pageTitle = __('text.menu.management');

    $subHeaderTitle = __('text.menu.management');
    $subHeaderBreadcrumbs = [['name' => __('text.menu.name_plural'), 'url' => route('admin.menus.index'),'is_active' => true]];
@endphp

@section('pageStyle')
    <link href="{{asset('admin/assets/vendors/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')

    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    {{ __('text.menu.name_plural') }}
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-actions">
                    <div class="btn-group show">
                        <button type="button" class="btn btn-brand dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            {{ __('text.crud.actions') }}
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-52px, 38px, 0px);">
                            @can('create-menus')
                                <a href="{{ route('admin.menus.create') }}" class="dropdown-item" ><i class="fa fa-plus-circle"></i>{{ __('text.menu.add_new') }}</a>
                            @endcan

{{--                            @can('view-menus-histories')--}}
{{--                                <a href="{{ route('admin.menus.histories') }}" class="dropdown-item" ><i class="fa fa-history"></i>{{ trans_choice('text.common.transaction_history', 2) }}</a>--}}
{{--                            @endcan--}}

                            <button class="dropdown-item" data-toggle="modal" data-target="#filter-modal"><i class="fa fa-filter"></i>{{ __('text.crud.filter') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{ html()->form('GET', route('admin.menus.index'))->class(['filter-form'])->open() }}

        <div class="kt-portlet__body">
            <div class="modal fade " id="filter-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{ __('text.crud.filter') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label for="id" class="col-form-label">{{ __('text.crud.id') }}</label>
                                    {{ html()->text('id')
                                        ->class(['form-control', 'is-invalid' => $errors->has('id')])
                                        ->attributes(['autocomplete' => 'off'])
                                        ->value(request()->get('id'))

                                    }}

                                    @error('id') <x-alert type="error" :message="$message"/> @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="name" class="col-form-label">{{ __('text.common.name') }}</label>
                                    {{ html()->text('name')
                                        ->class(['form-control', 'is-invalid' => $errors->has('name')])
                                        ->attributes(['maxlength' => 255, 'minlength' => 3, 'autocomplete' => 'off'])
                                        ->value(request()->get('name'))
                                    }}

                                    @error('name') <x-alert type="error" :message="$message"/> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label for="menu_group_id" class="col-form-label">{{ __('text.menu_group.name_singular') }}</label>
                                    {{ html()
                                        ->select('menu_group_id')
                                        ->class(['form-control select2 d-block w-100', 'is-invalid' => $errors->has('menu_group_id')])
                                        ->options($menuGroups)
                                        ->value(request()->get('menu_group_id'))
                                        ->attributes(['autocomplete' => 'off'])
                                        ->placeholder(__('text.crud.select'))
                                    }}

                                    @error('menu_group_id') <x-alert type="error" :message="$message"/> @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="menu_type_id" class="col-form-label">{{ __('text.menu_type.name_singular') }}</label>
                                    <select name="menu_type_id" id="menu_type_id" class="form-control select2 d-block w-100 @error('menu_type_id') is-invalid @enderror()">
                                        <option value="">{{ __('text.crud.select') }}</option>
                                        @foreach($menuTypes as $key => $value)
                                            <option value="{{ $key }}" {{ (request()->get('menu_type_id') == $key ? 'selected' : null) }}>
                                                {{ __('text.menu_type.'. $value) }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('menu_type_id') <x-alert type="error" :message="$message"/> @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label for="parent_id" class="col-form-label">{{ __('text.menu.parent_menu') }}</label>
                                    {{ html()
                                        ->select('parent_id')
                                        ->class(['form-control select2 d-block w-100', 'is-invalid' => $errors->has('parent_id')])
                                        ->options($parentMenus)
                                        ->value(request()->get('parent_id'))
                                        ->attributes(['autocomplete' => 'off'])
                                        ->placeholder(__('text.crud.select'))
                                    }}

                                    @error('parent_id') <x-alert type="error" :message="$message"/> @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="order" class="col-form-label">{{ __('text.common.order') }}</label>
                                    {{ html()->number('order')
                                        ->class(['form-control', 'is-invalid' => $errors->has('order')])
                                        ->value(request()->get('order'))
                                        ->attributes(['autocomplete' => 'off'])
                                    }}

                                    @error('order') <x-alert type="error" :message="$message"/> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="is_active" class="col-form-label">{{ __('text.crud.status') }}</label>
                                    {{ html()->select('is_active')
                                        ->class(['form-control select2 d-block w-100', 'is-invalid' => $errors->has('is_active')])
                                        ->attributes(['autocomplete' => 'off'])
                                        ->options(['' => __('text.crud.select'), '1' => __('text.crud.active'), '0' => __('text.crud.passive')])
                                        ->value(request()->get('is_active'))
                                     }}

                                    @error('is_active') <x-alert type="error" :message="$message"/> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('admin.menus.index') }}" class="btn btn-danger"><i class="fa fa-eraser"></i>{{ __('text.crud.clear') }}</a>
                            <button type="submit" class="btn btn-success"><i class="fa fa-filter"></i>{{ __('text.crud.filter') }}</button>
                        </div>
                    </div>
                </div>
            </div>

            <table class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap" id="datatable">
                <thead>
                <tr>
                    <th>{{ __('text.crud.id') }}</th>
                    <th>{{ __('text.common.name') }}</th>
                    <th>{{ __('text.common.group') }}</th>
                    <th>{{ __('text.menu_type.name_singular') }}</th>
                    <th>{{ __('text.menu.parent_menu') }}</th>
                    <th class="status-column">{{ __('text.crud.status') }}</th>
                    @canany(['view-menus', 'update-menus', 'delete-menus', 'view-menus-histories'])
                        <th class="no-sort dt-center action-column">{{ __('text.crud.actions') }}</th>
                    @endcanany
                </tr>
                </thead>

                <tbody>
                @foreach($menus as $menu)
                    <tr class="table-row-id-{{ $menu->id }}">
                        <td>{{ $menu->id }}</td>
                        <td>{{ $menu->translationForCurrentLocale->name }}</td>
                        <td>
                            <a href="{{ route('admin.menu_groups.edit', ['menuGroup' => $menu->menuGroup->id]) }}"
                               hreflang="{{ app()->getLocale() }}"
                               title="{{ $menu->menuGroup->name }}"
                            >
                                {{ $menu->menuGroup->name }}
                            </a>
                        </td>
                        <td>{{ $menu->menuType ? __('text.menu_type.' . $menu->menuType->translation_key) : '' }}</td>
                        <td>
                            @if(!is_null($menu->parent))
                                <a href="{{ route('admin.menus.edit', ['menu' => $menu->parent->id]) }}"
                                   hreflang="{{ app()->getLocale() }}"
                                   title="{{ $menu->parent->translationForCurrentLocale->name }}">{{ $menu->parent->translationForCurrentLocale->name }}
                                </a>
                            @endif
                        </td>
                        <td>
                            {!! $menu->is_active
                                ? '<span class="badge badge-success d-inline">'.__('text.crud.active').'</span>'
                                : '<span class="badge badge-danger d-inline">'.__('text.crud.passive').'</span>' !!}
                        </td>
                        @canany(['view-menus', 'update-menus', 'delete-menus', 'view-menus-histories'])
                            <td>
                                @can('update-menus')
                                    <a href="{{ $menu->editLink() }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{ __('text.crud.edit') }}"><i class="fa fa-edit"></i></a>
                                @elsecan('view-menus')
                                    <a href="{{ $menu->editLink() }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{ __('text.crud.edit') }}"><i class="fa fa-eye"></i></a>
                                @endcan

    {{--                            @can('view-menus-histories')--}}
    {{--                                <a href="{{ $menu->transactionHistoriesLink() }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{ __('text.crud.edit') }}"><i class="fa fa-history"></i></a>--}}
    {{--                            @endcan--}}

                                @can('delete-menus')
                                    <button class="btn btn-sm btn-clean btn-icon btn-icon-md" type="button" onclick="confirmToDelete('{{ $menu->deleteLink() }}', {{ $menu->id }})" title="{{ __('text.crud.delete') }}">
                                        <i class="fa fa-trash" id="spinner-button-{{ $menu->id }}"></i>
                                    </button>
                                @endcan
                            </td>
                        @endcanany
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                </tfoot>
            </table>

            {{ $menus->appends(request()->all())->links() }}

        </div>

        {{ html()->form()->close() }}

    </div>

@stop

@section('pageScript')
        @if(!empty($errors->all()))
            <script>
                jQuery(document).ready(function() {
                    $("#filter-modal").modal().open();
                });
            </script>
        @endif

    <script src="{{asset('admin/assets/vendors/custom/datatables/datatables.bundle.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/assets/js/demo1/pages/crud/datatables/extensions/responsive.js')}}" type="text/javascript"></script>
@endsection
