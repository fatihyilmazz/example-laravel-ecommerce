@extends('admin.layouts.app')

@php
    $pageTitle = __('text.locale.management');

    $subHeaderTitle = __('text.locale.management');
    $subHeaderBreadcrumbs = [['name' => __('text.locale.name_plural'), 'url' => route('admin.locales.index'),'is_active' => true]];
@endphp

@section('pageStyle')
    <link href="{{asset('admin/assets/vendors/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')

    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    {{ __('text.locale.all') }}
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-actions">
                    @can('view-locales-histories')
                        <div class="btn-group show">
                            <button type="button" class="btn btn-brand dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                {{ __('text.crud.actions') }}
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-52px, 38px, 0px);">
{{--                                <a href="{{ route('admin.locales.histories') }}" class="dropdown-item" ><i class="fa fa-history"></i>{{ trans_choice('text.common.transaction_history', 2) }}</a>--}}
                            </div>
                        </div>
                    @endcan
                </div>
            </div>
        </div>

        {{ html()->form('GET', route('admin.locales.index'))->class(['filter-form'])->open() }}

        <div class="kt-portlet__body">
            <table class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap" id="datatable">
                <thead>
                <tr>
                    <th>{{ __('text.crud.id') }}</th>
                    <th>{{ __('text.locale.english_name') }}</th>
                    <th>{{ __('text.common.name') }}</th>
                    <th>{{ __('text.locale.default_for_staff') }}</th>
                    <th>{{ __('text.locale.default_for_customer') }}</th>
                    <th class="status-column">{{ __('text.crud.status') }}</th>
                    @canany(['view-locales', 'update-locales'])
                        <th class="no-sort dt-center action-column">{{ __('text.crud.actions') }}</th>
                    @endcanany
                </tr>
                </thead>

                <tbody>
                @foreach($locales as $locale)
                    <tr class="table-row-id-{{ $locale->id }}">
                        <td>{{ $locale->id }}</td>
                        <td>{{ $locale->english_name }}</td>
                        <td>{{ $locale->native_name }}</td>
                        <td>
                            {!! $locale->is_default_for_admin
                                ? '<span class="kt-badge kt-badge--success">&nbsp;&nbsp;</span>'
                                : '<span class="kt-badge kt-badge--danger">&nbsp;&nbsp;</span>' !!}
                        </td>
                        <td>
                            {!! $locale->is_default_for_customer
                                ? '<span class="kt-badge kt-badge--success">&nbsp;</span>'
                                : '<span class="kt-badge kt-badge--danger">&nbsp;</span>' !!}
                        </td>
                        <td>
                            {!! $locale->is_usable_for_users
                                ? '<span class="badge badge-success d-inline">'.__('text.crud.active').'</span>'
                                : '<span class="badge badge-danger d-inline">'.__('text.crud.passive').'</span>' !!}
                        </td>
                        @canany(['view-locales', 'update-locales'])
                            <td>
                                @can('update-locales')
                                    <a href="{{ $locale->editLink() }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{ __('text.crud.edit') }}"><i class="fa fa-edit"></i></a>
                                @elsecan('view-locales')
                                    <a href="{{ $locale->editLink() }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{ __('text.crud.edit') }}"><i class="fa fa-eye"></i></a>
                                @endcan

    {{--                            @can('view-locales-histories')--}}
    {{--                                <a href="{{ $locale->transactionHistoriesLink() }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{ __('text.crud.edit') }}"><i class="fa fa-history"></i></a>--}}
    {{--                            @endcan--}}
                            </td>
                        @endcanany
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                </tfoot>
            </table>
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
