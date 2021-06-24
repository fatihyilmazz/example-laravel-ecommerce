@extends('admin.layouts.app')

@php
    $pageTitle = __('text.product.management');

    $subHeaderTitle = __('text.product.management');
    $subHeaderBreadcrumbs = [['name' => __('text.product.name_plural'), 'url' => route('admin.products.index'),'is_active' => true]];
@endphp

@section('pageStyle')
    <link href="{{asset('admin/assets/vendors/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')

    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    {{ __('text.product.name_plural') }}
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-actions">
                    <div class="btn-group show">
                        <button type="button" class="btn btn-brand dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            {{ __('text.crud.actions') }}
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-52px, 38px, 0px);">
                            @can('create-products')
                                <a href="{{ route('admin.products.create') }}" class="dropdown-item" ><i class="fa fa-plus-circle"></i>{{ __('text.product.add_new') }}</a>
                            @endcan

{{--                            @can('view-products-histories')--}}
{{--                                <a href="{{ route('admin.products.histories') }}" class="dropdown-item" ><i class="fa fa-history"></i>{{ trans_choice('text.common.transaction_history', 2) }}</a>--}}
{{--                            @endcan--}}

                            <button class="dropdown-item" data-toggle="modal" data-target="#filter-modal"><i class="fa fa-filter"></i>{{ __('text.crud.filter') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{ html()->form('GET', route('admin.products.index'))->class(['filter-form'])->open() }}

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
                                    <label for="ids" class="col-form-label">{{ __('text.crud.id') }}</label>
                                    <input type="text"
                                           name="ids"
                                           id="ids"
                                           class="form-control @error('ids') is-invalid @enderror"
                                           autocomplete="off"
                                           value="{{ request()->get('ids') }}"
                                    >

                                    @error('ids') <x-alert type="error" :message="$message"/> @enderror
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
                                    <label for="brand_id" class="col-form-label">{{ __('text.brand.name_singular') }}</label>
                                    {{ html()
                                        ->select('brand_id')
                                        ->class(['form-control select2 d-block w-100', 'is-invalid' => $errors->has('brand_id')])
                                        ->options($brands)
                                        ->value(request()->get('brand_id'))
                                        ->attributes(['autocomplete' => 'off'])
                                        ->placeholder(__('text.crud.select'))
                                    }}

                                    @error('brand_id') <x-alert type="error" :message="$message"/> @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="category_id" class="col-form-label">{{ __('text.category.name') }}</label>
                                    {{ html()
                                        ->select('category_id')
                                        ->class(['form-control select2 d-block w-100', 'is-invalid' => $errors->has('category_id')])
                                        ->options($categories)
                                        ->value(request()->get('category_id'))
                                        ->attributes(['autocomplete' => 'off'])
                                        ->placeholder(__('text.crud.select'))
                                    }}

                                    @error('category_id') <x-alert type="error" :message="$message"/> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label for="row_numbers" class="col-form-label">{{ __('text.common.order') }}</label>
                                    <input type="text"
                                           name="row_numbers"
                                           id="row_numbers"
                                           class="form-control @error('row_numbers') is-invalid @enderror()"
                                           autocomplete="off"
                                           value="{{ request()->get('row_numbers') }}"
                                    >

                                    @error('row_numbers') <x-alert type="error" :message="$message"/> @enderror
                                </div>
                                <div class="col-lg-6">
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
                            <a href="{{ route('admin.products.index') }}" class="btn btn-danger"><i class="fa fa-eraser"></i>{{ __('text.crud.clear') }}</a>
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
                    <th>{{ __('text.brand.name_singular') }}</th>
                    <th>{{ __('text.category.main_category') }}</th>
                    <th class="status-column">{{ __('text.crud.status') }}</th>
                    @canany(['view-products', 'update-products', 'delete-products', 'view-products-histories'])
                        <th class="no-sort dt-center action-column">{{ __('text.crud.actions') }}</th>
                    @endcanany
                </tr>
                </thead>

                <tbody>
                @foreach($products as $product)
                    <tr class="table-row-id-{{ $product->id }}">
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->translationForCurrentLocale->name }}</td>
                        <td><a href="{{ route('admin.brands.edit', ['brand' => $product->brand->id]) }}">{{ $product->brand->name }}</a></td>
                        <td>
                            <a href="{{ route('admin.categories.edit', ['category' => $product->mainCategory->id]) }}">
                                {{ $product->mainCategory->translationForCurrentLocale->name }}
                            </a>
                        </td>
                        <td>
                            {!! $product->is_active
                                ? '<span class="badge badge-success d-inline">'.__('text.crud.active').'</span>'
                                : '<span class="badge badge-danger d-inline">'.__('text.crud.passive').'</span>' !!}
                        </td>
                        @canany(['view-products', 'update-products', 'delete-products', 'view-products-histories'])
                            <td>
                                @can('update-products')
                                    <a href="{{ $product->editLink() }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{ __('text.crud.edit') }}"><i class="fa fa-edit"></i></a>
                                @elsecan('view-products')
                                    <a href="{{ $product->editLink() }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{ __('text.crud.edit') }}"><i class="fa fa-eye"></i></a>
                                @endcan

    {{--                            @can('view-products-histories')--}}
    {{--                                <a href="{{ $product->transactionHistoriesLink() }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{ __('text.crud.edit') }}"><i class="fa fa-history"></i></a>--}}
    {{--                            @endcan--}}

                                @can('delete-products')
                                    <button class="btn btn-sm btn-clean btn-icon btn-icon-md" type="button" onclick="confirmToDelete('{{ $product->deleteLink() }}', {{ $product->id }})" title="{{ __('text.crud.delete') }}">
                                        <i class="fa fa-trash" id="spinner-button-{{ $product->id }}"></i>
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

            {{ $products->appends(request()->all())->links() }}

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
