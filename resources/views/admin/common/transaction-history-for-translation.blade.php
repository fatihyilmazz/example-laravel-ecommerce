@extends('admin.layouts.app')

@php
    $modelNamePlural = Str::plural($modelName);
    $modelVariableName = Str::camel($modelName);

    $pageTitle = __("text.{$modelName}.management");

    $subHeaderTitle = __("text.{$modelName}.management");
    $subHeaderBreadcrumbs = [
        ['name' => trans_choice("text.{$modelName}.name",2), 'url' => route("admin.{$modelNamePlural}.index"),'is_active' => false],
        ['name' => trans_choice('text.common.transaction_history',2), 'url' => route("admin.{$modelNamePlural}.histories"),'is_active' => true],
    ];
@endphp

@section('pageStyle')
    <link href="{{asset('admin/assets/vendors/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')

    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    {{ __("text.{$modelName}.all_histories") }}
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-actions">
                    <div class="btn-group show">
                        <button type="button" class="btn btn-brand dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            {{ __('text.crud.actions') }}
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-52px, 38px, 0px);">
                            @can("create-{$modelNamePlural}")
                                <a href="{{ route("admin.{$modelNamePlural}.create") }}" class="dropdown-item" ><i class="fa fa-plus-circle"></i>{{ __("text.{$modelName}.add_new") }}</a>
                            @endcan

                            <button class="dropdown-item" data-toggle="modal" data-target="#filter-modal"><i class="fa fa-filter"></i>{{ __('text.crud.filter') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{ html()->form('GET', route("admin.{$modelNamePlural}.histories"))->class(['filter-form'])->open() }}

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
                                <div class="col-4">
                                    <label for="id" class="col-form-label">{{ __('text.crud.id') }}</label>
                                    <input
                                        type="text"
                                        name="id"
                                        id="id"
                                        class="form-control @error('id')is-invalid @enderror"
                                        value="{{ request()->get('id') ? request()->get('id') : old('id') }}"
                                        autocomplete="off"
                                    >

                                    @error('id') <x-alert type="error" :message="$message"/> @enderror
                                </div>

                                <div class="col-4">
                                    <label for="log_name" class="col-form-label">{{ __('text.common.log_name') }}</label>
                                    <input
                                        type="text"
                                        name="log_name"
                                        id="log_name"
                                        class="form-control @error('log_name')is-invalid @enderror"
                                        value="{{ request()->get('log_name') ? request()->get('log_name') : old('log_name') }}"
                                        autocomplete="off"
                                    >

                                    @error('log_name') <x-alert type="error" :message="$message"/> @enderror
                                </div>

                                <div class="col-4">
                                    <label for="description" class="col-form-label d-block">{{ __('text.common.transaction_type') }}</label>
                                    {{ html()->select('description')->class(['form-control select2 d-block w-100', 'is-invalid' => $errors->has('description')])
                                            ->options(['created' => 'Created', 'updated' => 'Updated', 'deleted' => 'Deleted'])
                                            ->value((request()->get('description') ? request()->get('description') : old(('description'))))
                                            ->attributes(['autocomplete' => 'off'])
                                            ->placeholder(__('text.crud.select'))
                                    }}

                                    @error('description') <x-alert type="error" :message="$message"/> @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label for="subject_id" class="col-form-label d-block">{{ __('text.common.modified_record') }}</label>
                                    {{ html()->select('subject_id')->class(['form-control select2 d-block w-100', 'is-invalid' => $errors->has('subject_id')])
                                        ->options($subjects)
                                        ->value((request()->get('subject_id') ? request()->get('subject_id') : old(('subject_id'))))
                                        ->attributes(['autocomplete' => 'off'])
                                        ->placeholder(__('text.crud.select'))
                                    }}

                                    @error('subject_id') <x-alert type="error" :message="$message"/> @enderror
                                </div>

                                <div class="col-lg-6">
                                    <label for="causer_id" class="col-form-label">{{ __('text.common.user') }}</label>
                                    {{ html()->select('causer_id')->class(['form-control select2', 'is-invalid' => $errors->has('causer_id')])
                                        ->options($causers)
                                        ->value((request()->get('causer_id') ? request()->get('causer_id') : old(('causer_id'))))
                                        ->attributes(['autocomplete' => 'off'])
                                        ->placeholder(__('text.crud.select'))
                                    }}

                                    @error('causer_id') <x-alert type="error" :message="$message"/> @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label for="started_at" class="col-form-label">{{ __('text.common.start_date') }}</label>
                                    <input
                                        type='text'
                                        name="started_at"
                                        id="started_at"
                                        class="form-control date-range-single-picker-started-at"
                                        readonly
                                        value="{{ request()->get('started_at') ? request()->get('started_at') : old('started_at')  }}"
                                        placeholder="{{ __('text.crud.select') }}"
                                    >

                                    @error('started_at') <x-alert type="error" :message="$message"/> @enderror
                                </div>

                                <div class="col-lg-6">
                                    <label for="end_at" class="col-form-label">{{ __('text.common.end_date') }}</label>
                                    <input
                                        type='text'
                                        name="end_at"
                                        id="end_at"
                                        class="form-control date-range-single-picker-end-at"
                                        readonly
                                        value="{{ request()->get('end_at') ? request()->get('end_at') : old('end_at')  }}"
                                        placeholder="{{ __('text.crud.select') }}"
                                    >

                                    @error('end_at') <x-alert type="error" :message="$message"/> @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label for="order_by" class="col-form-label">{{ __('text.common.order_by') }}</label>
                                    {{ html()->select('order_by')->class(['form-control select2 d-block w-100', 'is-invalid' => $errors->has('order_by')])
                                            ->options([
                                                \App\Repositories\ActivityLogRepository::ORDER_BY_ID => __('text.crud.id'),
                                                \App\Repositories\ActivityLogRepository::ORDER_BY_LOG_NAME => __('text.common.log_name'),
                                                \App\Repositories\ActivityLogRepository::ORDER_BY_DESCRIPTION => __('text.common.transaction_type')
                                            ])
                                            ->value((request()->get('order_by') ? request()->get('order_by') : old(('order_by'))))
                                            ->attributes(['autocomplete' => 'off'])
                                            ->placeholder(__('text.crud.select'))
                                    }}

                                    @error('order_by') <x-alert type="error" :message="$message"/> @enderror
                                </div>

                                <div class="col-lg-6">
                                    <label for="sort_by" class="col-form-label">{{ __('text.common.sort_by') }}</label>
                                    {{ html()->select('sort_by')->class(['form-control select2 d-block w-100', 'is-invalid' => $errors->has('sort_by')])
                                            ->options([
                                                \App\Repositories\ActivityLogRepository::SORT_BY_ASC => __('text.common.low_to_high'),
                                                \App\Repositories\ActivityLogRepository::SORT_BY_DESC => __('text.common.high_to_low')
                                            ])
                                            ->value((request()->get('sort_by') ? request()->get('sort_by') : old(('sort_by'))))
                                            ->attributes(['autocomplete' => 'off'])
                                            ->placeholder(__('text.crud.select'))
                                    }}

                                    @error('sort_by') <x-alert type="error" :message="$message"/> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route("admin.{$modelNamePlural}.histories") }}" class="btn btn-danger"><i class="fa fa-eraser"></i>{{ __('text.crud.clear') }}</a>
                            <button type="submit" class="btn btn-success"><i class="fa fa-filter"></i>{{ __('text.crud.filter') }}</button>
                        </div>
                    </div>
                </div>
            </div>

            <table class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap" id="datatable">
                <thead>
                <tr>
                    <th class="no-sort">{{ __('text.crud.id') }}</th>
                    <th class="no-sort">{{ __('text.common.log_name') }}</th>
                    <th class="no-sort">{{ __('text.common.transaction_type') }}</th>
                    <th class="no-sort">{{ __('text.common.modified_record') }}</th>
                    <th class="no-sort">{{ __('text.common.user') }}</th>
                    <th class="no-sort">{{ __('text.common.changed_data') }}</th>
                    <th class="no-sort">{{ __('text.common.new_data') }}</th>
                    <th class="no-sort">{{ __('text.common.date') }}</th>
                </tr>
                </thead>

                <tbody>
                @foreach($transactions as $transaction)
                    <tr class="table-row-id-{{ $transaction->id }}">
                        <td>{{ $transaction->id }}</td>
                        <td>{{ $transaction->log_name }}</td>
                        <td>
                            @if($transaction->description == 'created')
                                <span class="badge badge-success">Creted</span>
                            @elseif($transaction->description == 'updated')
                                <span class="badge badge-warning">Updated</span>
                            @elseif($transaction->description == 'deleted')
                                <span class="badge badge-danger">Deleted</span>
                            @else
                                <span class="badge badge-primary">Unknown</span>
                            @endif
                        </td>
                        <td>
                            @if(!empty($transaction->subject->deleted_at))
                                <span>{{ $transaction->subject->translationForCurrentLocale->name }}</span>
                            @else
                                <a href="{{ route("admin.{$modelNamePlural}.edit", ["{$modelVariableName}" => $transaction->subject->id]) }}">{{ $transaction->subject->translationForCurrentLocale->name }}</a>
                            @endif
                        </td>
                        <td>
                            @if(!empty($transaction->causer->deleted_at))
                                <span>{{ $transaction->causer->first_name. ' '. $transaction->causer->last_name }}</span>
                            @else
                                <a href="{{ route('admin.users.edit', ['user' => $transaction->causer->id]) }}">{{ $transaction->causer->first_name. ' '. $transaction->causer->last_name }}</a>
                            @endif

                        </td>
                        <td>{{ json_encode($transaction->changes->get('old')) }}</td>
                        <td>{{ json_encode($transaction->changes->get('attributes')) }}</td>
                        <td>{{ $transaction->created_at->format('d/m/Y H:i:s') }}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                </tfoot>
            </table>

            {{ $transactions->appends(request()->all())->links() }}

        </div>

        {{ html()->form()->close() }}

    </div>

@stop

@section('pageScript')
    <script>
        jQuery(document).ready(function() {
            let currentLocale = $("input[name=currentLocale]").val();

            createDateRangePickerForElement('date-range-single-picker-started-at', currentLocale);
            createDateRangePickerForElement('date-range-single-picker-end-at', currentLocale);

            @if(!empty($errors->all()))
                $("#filter-modal").modal().open();
            @endif
        });
    </script>


    <script src="{{asset('admin/assets/vendors/custom/datatables/datatables.bundle.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/assets/js/demo1/pages/crud/datatables/extensions/responsive.js')}}" type="text/javascript"></script>
@endsection
