@extends('admin.layouts.app')

@php
    $pageTitle = __('text.product.management');

    $subHeaderTitle = __('text.product.management');
    $subHeaderBreadcrumbs = [['name' => __('text.product.name_plural'), 'url' => route('admin.products.index'), 'is_active' => false]];

    if (isset($product)) {
        $subHeaderBreadcrumbs = array_merge($subHeaderBreadcrumbs, [['name' => __('text.crud.edit'), 'url' => $product->editLink(), 'is_active' => true]]);

        $pictureItemNumber = count($product->images);
        $fileItemNumber = count($product->files);
    } else {
        $subHeaderBreadcrumbs = array_merge($subHeaderBreadcrumbs, [['name' => __('text.crud.add_new'), 'url' => route('admin.products.create'), 'is_active' => true]]);

        $pictureItemNumber = 0;
        $fileItemNumber = 0;
    }

    $userCanCreateOrUpdate = false;
    if ((auth()->user()->can('create-products') && Request::routeIs('admin.products.create')) || (auth()->user()->can('update-products') && Request::routeIs('admin.products.edit'))) {
        $userCanCreateOrUpdate = true;
    }
@endphp

@section('pageStyle')
    <link href="{{asset('admin/assets/custom/bootstrap-toggle_v2.2.2/bootstrap-toggle.min.css')}}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')

    @if(isset($product))
        {{ html()->form('PUT', $product->updateLink())->attributes(['enctype' => 'multipart/form-data'])->open() }}

        <input type="hidden" name="id" value="{{ $product->id }}">
    @else
        {{ html()->form('POST', route('admin.products.store'))->attributes(['enctype' => 'multipart/form-data'])->open() }}
    @endif

    <div class="kt-portlet kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    @if(isset($product))
                        {{ __('text.product.edit') }}
                    @else
                        {{ __('text.product.create') }}
                    @endif
                </h3>
            </div>

            <div class="kt-portlet__head-toolbar">
                <a href="{{ route('admin.products.index') }}" class="btn btn-clean kt-margin-r-10">
                    <i class="la la-arrow-left"></i>
                    <span class="kt-hidden-mobile">{{ __('text.common.all') }}</span>
                </a>
                @if($userCanCreateOrUpdate)
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>{{ __('text.crud.save') }}</button>
                @endif
            </div>

        </div>
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

{{--                    <div class="form-group row">
                        <label for="type_id" class="col-lg-2 col-form-label">{{ __('text.product.product_type') }}<span class="text-danger" title="{{ __('text.common.required_field') }}">*</span></label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                {{ html()
                                    ->select('type_id')
                                    ->class(['form-control select2 d-block w-100', 'is-invalid' => $errors->has('type_id')])
                                    ->options($productTypes)
                                    ->value(old('type_id') ? old('type_id') : (isset($product) ? $product->type_id : null))
                                }}

                                @error('type_id') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                {{ html()
                                    ->select('type_id')
                                    ->class(['form-control'])
                                    ->options($productTypes)
                                    ->attributes(['disabled' => 'disabled'])
                                    ->value((isset($product) ? $product->type_id : null))
                                }}
                            @endif
                        </div>
                    </div>--}}

                    <div class="form-group row">
                        <label for="brand_id" class="col-lg-2 col-form-label">{{ __('text.brand.name_singular') }}<span class="text-danger" title="{{ __('text.common.required_field') }}">*</span></label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                {{ html()
                                    ->select('brand_id')
                                    ->class(['form-control select2', 'is-invalid' => $errors->has('brand_id')])
                                    ->options($brands)
                                    ->required()
                                    ->placeholder(__('text.crud.select'))
                                    ->value(old('brand_id', (isset($product) ? $product->brand_id : null)))
                                }}

                                @error('brand_id') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                {{ html()
                                    ->select('brand_id')
                                    ->class(['form-control'])
                                    ->options($brands)
                                    ->attributes(['disabled' => 'disabled'])
                                    ->placeholder(__('text.crud.select'))
                                    ->value((isset($product) ? $product->brand_id : null))
                                }}
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="main_category" class="col-lg-2 col-form-label">{{ __('text.category.main_category') }}<span class="text-danger" title="{{ __('text.common.required_field') }}">*</span></label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                {{ html()
                                    ->select('main_category')
                                    ->class(['form-control select2 d-block w-100', 'is-invalid' => $errors->has('main_category')])
                                    ->options($categories)
                                    ->required()
                                    ->placeholder(__('text.crud.select'))
                                    ->value(old('main_category', (isset($product) ? $product->categoryIds->firstWhere('is_main', true)->category_id : null)))
                                }}

                                @error('main_category') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                {{ html()
                                    ->select('main_category')
                                    ->class(['form-control'])
                                    ->options($categories)
                                    ->attributes(['disabled' => 'disabled'])
                                    ->placeholder(__('text.crud.select'))
                                    ->value((isset($product) ? $product->categoryIds->firstWhere('is_main', true)->category_id : null))
                                }}
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="sub_categories" class="col-lg-2 col-form-label">{{ __('text.category.sub_categories') }}</label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                <select
                                    name="sub_categories[]"
                                    id="sub_categories"
                                    class="form-control select2 d-block w-100 @error('sub_categories.*') is-invalid @enderror"
                                    multiple
                                    placeholder="{{ __('text.crud.select') }}"
                                >
                                    @php $oldSubCategories = old('sub_categories') ?? []; @endphp
                                    @php $selectedSubCategories = isset($product) ? $product->categoryIds->where('is_main', false)->toArray() : []; @endphp

                                    @foreach($categories as $key => $category)
                                        @php $isSelected = false; @endphp

                                        @forelse($oldSubCategories as $selectedKey => $selectedCategory)
                                            @php $keys[] = array($key, $selectedCategory); @endphp

                                        @if((int)$selectedCategory == $key)
                                                @php $isSelected = true; @endphp
                                                @break
                                            @endif
                                        @empty
                                            @foreach($selectedSubCategories as $selectedKey => $selectedCategory)
                                                @if($selectedCategory['category_id'] == $key)
                                                    @php $isSelected = true; @endphp
                                                    @break
                                                @endif
                                            @endforeach
                                        @endforelse

                                        @if($isSelected)
                                            <option value="{{ $key }}" selected>{{ $category }}</option>
                                        @else
                                            <option value="{{ $key }}">{{ $category }}</option>
                                        @endif
                                    @endforeach
                                </select>

                                @error('sub_categories.*') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                {{ html()
                                    ->select('sub_categories')
                                    ->class(['form-control'])
                                    ->options($categories)
                                    ->attributes(['disabled' => 'disabled'])
                                    ->placeholder(__('text.crud.select'))
                                    ->value((isset($product) ? $product->categoryIds->firstWhere('is_main', true)->category_id : null))
                                }}
                            @endif
                        </div>
                    </div>


{{--                    <div class="form-group row">
                        <label for="quantity" class="col-lg-2 col-form-label">{{ __('text.product.quantity') }}<span class="text-danger" title="{{ __('text.common.required_field') }}">*</span></label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                <input type="number"
                                       name="quantity" id="quantity"
                                       class="form-control @error('quantity') is-invalid @enderror()"
                                       min="0" max="32767" autocomplete="off"
                                       required
                                       value="{{ old('quantity') ? old('quantity') : (isset($product) ? $product->quantity : null) }}"
                                >

                                @error('quantity')  <x-alert type="error" :message="$message"/> @enderror
                            @else
                                <input type="number"
                                       class="form-control"
                                       disabled
                                       value="{{ (isset($product) ? $product->quantity : null) }}"
                                >
                            @endif
                        </div>
                    </div>--}}

                    <div class="form-group row">
                        <label for="selling_price" class="col-lg-2 col-form-label">{{ __('text.product.selling_price') }}<span class="text-danger" title="{{ __('text.common.required_field') }}">*</span></label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                <input type="number"
                                       name="selling_price" id="selling_price"
                                       class="form-control @error('selling_price') is-invalid @enderror()"
                                       min="0" autocomplete="off"
                                       required
                                       value="{{ old('selling_price', (isset($product) ? $product->selling_price : null)) }}"
                                >

                                @error('selling_price')  <x-alert type="error" :message="$message"/> @enderror
                            @else
                                <input type="number"
                                       class="form-control"
                                       disabled
                                       value="{{ (isset($product) ? $product->selling_price : null) }}"
                                >
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tax_rate_id" class="col-lg-2 col-form-label">{{ __('text.tax_rate.name_singular') }}<span class="text-danger" title="{{ __('text.common.required_field') }}">*</span></label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                {{ html()
                                    ->select('tax_rate_id')
                                    ->class(['form-control select2', 'is-invalid' => $errors->has('tax_rate_id')])
                                    ->options($taxRates)
                                    ->required()
                                    ->placeholder(__('text.crud.select'))
                                    ->value(old('tax_rate_id', (isset($product) ? $product->tax_rate_id : null)))
                                }}

                                @error('tax_rate_id') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                {{ html()
                                    ->select('tax_rate_id')
                                    ->class(['form-control'])
                                    ->options($taxRates)
                                    ->attributes(['disabled' => 'disabled'])
                                    ->placeholder(__('text.crud.select'))
                                    ->value((isset($product) ? $product->tax_rate_id : null))
                                }}
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="currency_id" class="col-lg-2 col-form-label">{{ __('text.currency.name_singular') }}<span class="text-danger" title="{{ __('text.common.required_field') }}">*</span></label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                {{ html()
                                    ->select('currency_id')
                                    ->class(['form-control select2', 'is-invalid' => $errors->has('currency_id')])
                                    ->options($currencies)
                                    ->required()
                                    ->placeholder(__('text.crud.select'))
                                    ->value(old('currency_id', (isset($product) ? $product->currency_id : null)))
                                }}

                                @error('currency_id') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                {{ html()
                                    ->select('currency_id')
                                    ->class(['form-control'])
                                    ->options($currencies)
                                    ->attributes(['disabled' => 'disabled'])
                                    ->placeholder(__('text.crud.select'))
                                    ->value((isset($product) ? $product->currency_id : null))
                                }}
                            @endif
                        </div>
                    </div>

{{--                    <div class="form-group row">
                        <label for="list_price" class="col-lg-2 col-form-label">{{ __('text.product.list_price') }}</label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                <input type="number"
                                       name="list_price" id="list_price"
                                       class="form-control @error('list_price') is-invalid @enderror()"
                                       autocomplete="off"
                                       value="{{ old('list_price') ? old('list_price') : (isset($product) ? $product->list_price : null) }}"
                                >

                                @error('list_price')  <x-alert type="error" :message="$message"/> @enderror
                            @else
                                <input type="number"
                                       class="form-control"
                                       disabled
                                       value="{{ (isset($product) ? $product->list_price : null) }}"
                                >
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cost_price" class="col-lg-2 col-form-label">{{ __('text.product.cost_price') }}</label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                <input type="number"
                                       name="cost_price" id="cost_price"
                                       class="form-control @error('cost_price') is-invalid @enderror()"
                                       autocomplete="off"
                                       value="{{ old('cost_price') ? old('cost_price') : (isset($product) ? $product->cost_price : null) }}"
                                >

                                @error('cost_price')  <x-alert type="error" :message="$message"/> @enderror
                            @else
                                <input type="number"
                                       class="form-control"
                                       disabled
                                       value="{{ (isset($product) ? $product->cost_price : null) }}"
                                >
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="weight" class="col-lg-2 col-form-label">{{ __('text.product.weight') }}</label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                <input type="number"
                                       name="weight" id="weight"
                                       class="form-control @error('weight') is-invalid @enderror()"
                                       min="0" max="32767" autocomplete="off"
                                       value="{{ old('weight') ? old('weight') : (isset($product) ? $product->weight : null) }}"
                                >

                                @error('weight')  <x-alert type="error" :message="$message"/> @enderror
                            @else
                                <input type="number"
                                       class="form-control"
                                       disabled
                                       value="{{ (isset($product) ? $product->weight : null) }}"
                                >
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="width" class="col-lg-2 col-form-label">{{ __('text.product.width') }}</label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                <input type="number"
                                       name="width" id="width"
                                       class="form-control @error('width') is-invalid @enderror()"
                                       min="0" max="32767" autocomplete="off"
                                       value="{{ old('width') ? old('width') : (isset($product) ? $product->width : null) }}"
                                >

                                @error('width')  <x-alert type="error" :message="$message"/> @enderror
                            @else
                                <input type="number"
                                       class="form-control"
                                       disabled
                                       value="{{ (isset($product) ? $product->width : null) }}"
                                >
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="height" class="col-lg-2 col-form-label">{{ __('text.product.height') }}</label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                <input type="number"
                                       name="height" id="height"
                                       class="form-control @error('height') is-invalid @enderror()"
                                       min="0" max="32767" autocomplete="off"
                                       value="{{ old('height') ? old('height') : (isset($product) ? $product->height : null) }}"
                                >

                                @error('height')  <x-alert type="error" :message="$message"/> @enderror
                            @else
                                <input type="number"
                                       class="form-control"
                                       disabled
                                       value="{{ (isset($product) ? $product->height : null) }}"
                                >
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="length" class="col-lg-2 col-form-label">{{ __('text.product.length') }}</label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                <input type="number"
                                       name="length" id="length"
                                       class="form-control @error('length') is-invalid @enderror()"
                                       min="0" max="32767" autocomplete="off"
                                       value="{{ old('length') ? old('length') : (isset($product) ? $product->length : null) }}"
                                >

                                @error('length')  <x-alert type="error" :message="$message"/> @enderror
                            @else
                                <input type="number"
                                       class="form-control"
                                       disabled
                                       value="{{ (isset($product) ? $product->length : null) }}"
                                >
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="min_selling_quantity" class="col-lg-2 col-form-label">{{ __('text.product.min_selling_quantity') }}</label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                <input type="number"
                                       name="min_selling_quantity" id="min_selling_quantity"
                                       class="form-control @error('min_selling_quantity') is-invalid @enderror()"
                                       min="0" max="32767" autocomplete="off"
                                       value="{{ old('min_selling_quantity') ? old('min_selling_quantity') : (isset($product) ? $product->min_selling_quantity : null) }}"
                                >

                                @error('min_selling_quantity')  <x-alert type="error" :message="$message"/> @enderror
                            @else
                                <input type="number"
                                       class="form-control"
                                       disabled
                                       value="{{ (isset($product) ? $product->min_selling_quantity : null) }}"
                                >
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="max_selling_quantity" class="col-lg-2 col-form-label">{{ __('text.product.max_selling_quantity') }}</label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                <input type="number"
                                       name="max_selling_quantity" id="max_selling_quantity"
                                       class="form-control @error('max_selling_quantity') is-invalid @enderror()"
                                       min="0" max="32767" autocomplete="off"
                                       value="{{ old('max_selling_quantity') ? old('max_selling_quantity') : (isset($product) ? $product->max_selling_quantity : null) }}"
                                >

                                @error('max_selling_quantity')  <x-alert type="error" :message="$message"/> @enderror
                            @else
                                <input type="number"
                                       class="form-control"
                                       disabled
                                       value="{{ (isset($product) ? $product->max_selling_quantity : null) }}"
                                >
                            @endif
                        </div>
                    </div>--}}

                    <div class="form-group row">
                        <label for="sku" class="col-lg-2 col-form-label">{{ __('text.product.sku') }}</label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                <input
                                    type="text"
                                    name="sku" id="sku"
                                    class="form-control @error("sku") is-invalid @enderror"
                                    minlength="1"
                                    maxlength="255"
                                    autocomplete="off"
                                    value='{{ old('sku', (isset($product) ? $product->sku : '')) }}'
                                >

                                @error('sku') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                <input
                                    type="text"
                                    class="form-control"
                                    disabled
                                    value="{{ isset($product) ? $product->sku : '' }}"
                                >
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="gtin" class="col-lg-2 col-form-label">{{ __('text.product.gtin') }}</label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                <input
                                    type="text"
                                    name="gtin" id="gtin"
                                    class="form-control @error("gtin") is-invalid @enderror"
                                    minlength="1"
                                    maxlength="14"
                                    autocomplete="off"
                                    value='{{ old('gtin', (isset($product) ? $product->gtin : '')) }}'
                                >

                                @error('gtin') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                <input
                                    type="text"
                                    class="form-control"
                                    disabled
                                    value="{{ isset($product) ? $product->gtin : '' }}"
                                >
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="upc" class="col-lg-2 col-form-label">{{ __('text.product.upc') }}</label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                <input
                                    type="text"
                                    name="upc" id="upc"
                                    class="form-control @error("upc") is-invalid @enderror"
                                    minlength="1"
                                    maxlength="12"
                                    autocomplete="off"
                                    value='{{ old('upc', (isset($product) ? $product->upc : '')) }}'
                                >

                                @error('upc') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                <input
                                    type="text"
                                    class="form-control"
                                    disabled
                                    value="{{ isset($product) ? $product->upc : '' }}"
                                >
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="ean" class="col-lg-2 col-form-label">{{ __('text.product.ean') }}</label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                <input
                                    type="text"
                                    name="ean"
                                    id="ean"
                                    class="form-control @error("ean") is-invalid @enderror"
                                    minlength="1"
                                    maxlength="12"
                                    autocomplete="off"
                                    value='{{ old('ean', (isset($product) ? $product->ean : '')) }}'
                                >

                                @error('ean') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                <input
                                    type="text"
                                    class="form-control"
                                    disabled
                                    value="{{ isset($product) ? $product->ean : '' }}"
                                >
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="jan" class="col-lg-2 col-form-label">{{ __('text.product.jan') }}</label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                <input
                                    type="text"
                                    name="jan"
                                    id="jan"
                                    class="form-control @error("jan") is-invalid @enderror"
                                    minlength="1"
                                    maxlength="12"
                                    autocomplete="off"
                                    value='{{ old('jan', (isset($product) ? $product->jan : '')) }}'
                                >

                                @error('jan') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                <input
                                    type="text"
                                    class="form-control"
                                    disabled
                                    value="{{ isset($product) ? $product->jan : '' }}"
                                >
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="isbn" class="col-lg-2 col-form-label">{{ __('text.product.isbn') }}</label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                <input
                                    type="text"
                                    name="isbn"
                                    id="isbn"
                                    class="form-control @error("isbn") is-invalid @enderror"
                                    minlength="1"
                                    maxlength="12"
                                    autocomplete="off"
                                    value='{{ old('isbn', (isset($product) ? $product->isbn : '')) }}'
                                >

                                @error('isbn') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                <input
                                    type="text"
                                    class="form-control"
                                    disabled
                                    value="{{ isset($product) ? $product->isbn : '' }}"
                                >
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="itf_14" class="col-lg-2 col-form-label">{{ __('text.product.itf_14') }}</label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                <input
                                    type="text"
                                    name="itf_14"
                                    id="itf_14"
                                    class="form-control @error("itf_14") is-invalid @enderror"
                                    minlength="1"
                                    maxlength="12"
                                    autocomplete="off"
                                    value='{{ old('itf_14', (isset($product) ? $product->itf_14 : '')) }}'
                                >

                                @error('itf_14') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                <input
                                    type="text"
                                    class="form-control"
                                    disabled
                                    value="{{ isset($product) ? $product->itf_14 : '' }}"
                                >
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="mpn" class="col-lg-2 col-form-label">{{ __('text.product.mpn') }}</label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                <input
                                    type="text"
                                    name="mpn"
                                    id="mpn"
                                    class="form-control @error("mpn") is-invalid @enderror"
                                    minlength="1"
                                    maxlength="12"
                                    autocomplete="off"
                                    value='{{ old('mpn', (isset($product) ? $product->mpn : '')) }}'
                                >

                                @error('mpn') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                <input
                                    type="text"
                                    class="form-control"
                                    disabled
                                    value="{{ isset($product) ? $product->mpn : '' }}"
                                >
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="oem" class="col-lg-2 col-form-label">{{ __('text.product.oem') }}</label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                <input
                                    type="text"
                                    name="oem" id="oem"
                                    class="form-control @error("oem") is-invalid @enderror"
                                    minlength="1"
                                    maxlength="12"
                                    autocomplete="off"
                                    value='{{ old('oem', (isset($product) ? $product->oem : '')) }}'
                                >

                                @error('oem') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                <input
                                    type="text"
                                    class="form-control"
                                    disabled
                                    value="{{ isset($product) ? $product->oem : '' }}"
                                >
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="non_oem" class="col-lg-2 col-form-label">{{ __('text.product.non_oem') }}</label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                <input
                                    type="text"
                                    name="non_oem"
                                    id="non_oem"
                                    class="form-control @error("non_oem") is-invalid @enderror"
                                    minlength="1"
                                    maxlength="12"
                                    autocomplete="off"
                                    value='{{ old('non_oem', (isset($product) ? $product->non_oem : '')) }}'
                                >

                                @error('non_oem') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                <input
                                    type="text"
                                    class="form-control"
                                    disabled
                                    value="{{ isset($product) ? $product->non_oem : '' }}"
                                >
                            @endif
                        </div>
                    </div>

{{--                    <div class="form-group row">
                        <label for="supplier_id" class="col-lg-2 col-form-label">{{ __('text.supplier.name_singular') }}</label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                {{ html()
                                    ->select('supplier_id')
                                    ->class(['form-control select2 d-block w-100', 'is-invalid' => $errors->has('supplier_id')])
                                    ->options($suppliers)
                                    ->placeholder(__('text.crud.select'))
                                    ->value(old('supplier_id') ? old('supplier_id') : (isset($product) ? $product->supplier_id : null))
                                }}

                                @error('supplier_id') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                {{ html()
                                    ->select('supplier_id')
                                    ->class(['form-control'])
                                    ->options($suppliers)
                                    ->attributes(['disabled' => 'disabled'])
                                    ->placeholder(__('text.crud.select'))
                                    ->value((isset($product) ? $product->supplier_id : null))
                                }}
                            @endif
                        </div>
                    </div>--}}

                    <div class="form-group row">
                        <label for="row" class="col-lg-2 col-form-label">{{ __('text.common.order') }}</label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                <input type="number"
                                       name="row"
                                       id="row"
                                       class="form-control @error('row') is-invalid @enderror()"
                                       min="0"
                                       max="32767"
                                       autocomplete="off"
                                       value="{{ old('row', (isset($product) ? $product->row : null)) }}"
                                >

                                @error('row')  <x-alert type="error" :message="$message"/> @enderror
                            @else
                                <input type="number"
                                       class="form-control"
                                       disabled
                                       value="{{ (isset($product) ? $product->row : null) }}"
                                >
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="is_tax_included" class="col-lg-2 col-form-label">{{ __('text.product.tax_included') }}</label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                <input type="hidden" name="is_tax_included" value="0">

                                {{ html()->checkbox('is_tax_included')
                                    ->class(['form-control'])
                                    ->attributes(['data-toggle' => 'toggle', 'data-on' =>__('text.common.yes'), 'data-off' => __('text.common.no'),
                                    'data-width' => '200', 'data-onstyle' => 'success', 'data-offstyle' => 'danger'])
                                }}

                                @error('is_tax_included') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                {{ html()->checkbox('is_tax_included')
                                    ->class(['form-control'])
                                    ->attributes(['data-toggle' => 'toggle', 'data-on' => __('text.common.yes'), 'data-off' => __('text.common.no'),
                                    'data-width' => '200', 'data-onstyle' => 'success', 'data-offstyle' => 'danger', 'disabled' => 'disabled'])}}
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
                                    ->attributes(['data-toggle' => 'toggle', 'data-on' => __('text.crud.active'), 'data-off' => __('text.crud.passive'),
                                    'data-width' => '200', 'data-onstyle' => 'success', 'data-offstyle' => 'danger'])
                                }}

                                @error('is_active') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                <input type="checkbox"
                                       class="form-control"
                                       disabled
                                       data-toggle="toggle" data-on="{{ __('text.crud.active') }}" data-off="{{ __('text.crud.passive') }}" data-width="200" data-onstyle="success" data-offstyle="danger"
                                    {{ isset($product) ? ($product->is_active ? 'checked' : null) : null }}
                                >
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-1"></div>
            </div>

        </div>
    </div>

    <div class="kt-portlet kt-portlet--head-lg" data-ktportlet="true" id="kt_portlet_tools_4">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <i class="la la-language"></i>&nbsp;
                <h3 class="kt-portlet__head-title">
                    {{ __('text.common.translations') }}

                    @if($errors->has('translations.*'))
                        &nbsp;
                        <span class="badge badge-danger"><i class="flaticon-warning-sign"></i></span>
                    @endif
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-group">
                    <a href="javascript:void(0)" data-ktportlet-tool="toggle" class="btn btn-sm btn-icon btn-brand btn-icon-md"><i class="la la-angle-down"></i></a>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="kt-portlet__content">
                <div class="row">
                    <div class="col-lg-1"></div>

                    <div class="col-lg-10">
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <ul class="nav nav-pills nav-fill" role="tablist">
                                    @foreach($locales as $locale)
                                        <li class="nav-item">
                                            <a class="nav-link @if ($loop->first) active @endif" data-toggle="tab" href="#{{ $locale->code }}">
                                                {{ $locale->native_name. '-'. Str::upper($locale->code) }}

                                                @if($errors->has('translations.'. $loop->index .'.*'))
                                                    &nbsp;
                                                    <span class="badge badge-danger"><i class="flaticon-warning-sign"></i></span>
                                                @endif

                                            </a>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="tab-content">
                                    @foreach($locales as $locale)
                                        @if($userCanCreateOrUpdate)
                                            <input type="hidden" name="translations[{{ $loop->index }}][locale]" value="{{ $locale->code }}">
                                            <input type="hidden" name="translations[{{ $loop->index }}][id]" value="{{ (isset($product) ? $product->translations->firstWhere('locale', $locale->code)->id : null)  }}">
                                        @endif

                                        <div class="tab-pane @if ($loop->first) active @endif" id="{{ $locale->code }}" role="tabpanel">
                                            <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-2x nav-tabs-line-success" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-toggle="tab" href="#product-info-{{ $locale->code }}" role="tab">{{ __('text.product.info') }}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#product-seo-{{ $locale->code }}" role="tab">{{ __('text.product.seo') }}</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="product-info-{{ $locale->code }}" role="tabpanel">
                                                    <div class="form-group row">
                                                        <label for="translations{{ $loop->index }}name" class="col-lg-2 col-form-label">{{ __('text.common.name') }} <span class="text-danger" title="{{ __('text.common.required_field') }}">*</span></label>
                                                        <div class="col-lg-10">
                                                            @if($userCanCreateOrUpdate)
                                                                <input
                                                                    type="text"
                                                                    name="translations[{{ $loop->index }}][name]" id="translations{{ $loop->index }}name"
                                                                    class="form-control @error("translations.{$loop->index}.name") is-invalid @enderror"
                                                                    required
                                                                    maxlength="255" minlength="1" autocomplete="off"
                                                                    value='{{ old(('translations.'.$loop->index.'.name'), (isset($product) ? $product->translations->firstWhere('locale', $locale->code)->name : '')) }}'
                                                                    onfocusout="generateSlug(
                                                                            'product',
                                                                            '{{ $locale->code }}',
                                                                            'translations{{ $loop->index }}name',
                                                                            'translations{{ $loop->index }}slug',
                                                                            '{{ (isset($product) ? $product->translations->firstWhere('locale', $locale->code)->id : '') }}'
                                                                        )"
                                                                >

                                                                @error("translations.{$loop->index}.name") <x-alert type="error" :message="$message"/> @enderror
                                                            @else
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    disabled
                                                                    value="{{ isset($product) ? $product->translate($locale->code)->name : '' }}"
                                                                >
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="translations[{{ $loop->index }}][short_description]" class="col-lg-2 col-form-label">{{ __('text.common.short_description') }}</label>
                                                        <div class="col-lg-10">
                                                            @if($userCanCreateOrUpdate)
                                                                <textarea
                                                                    name="translations[{{ $loop->index }}][short_description]" id="translations[{{ $loop->index }}][short_description]"
                                                                    class="form-control autosize-textarea @error("translations.{$loop->index}.short_description") is-invalid @enderror"
                                                                    autocomplete="off"
                                                                    minlength="1" maxlength="65535" rows="3"
                                                                >{{ old(('translations.'.$loop->index.'.short_description'), (isset($product) ? $product->translations->firstWhere('locale', $locale->code)->short_description : '')) }}</textarea>

                                                                @error("translations.{$loop->index}.short_description") <x-alert type="error" :message="$message"/> @enderror
                                                            @else
                                                                <textarea
                                                                    class="form-control"
                                                                    disabled
                                                                >{{ (isset($product) ? $product->translations->firstWhere('locale', $locale->code)->short_description : null) }}</textarea>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="translations[{{ $loop->index }}][content]" class="col-lg-2 col-form-label">{{ __('text.common.content') }}</label>
                                                        <div class="col-lg-10">
                                                            @if($userCanCreateOrUpdate)
                                                                <textarea
                                                                    name="translations[{{ $loop->index }}][content]" id="translations[{{ $loop->index }}][content]"
                                                                    class="form-control product-content @error("translations.{$loop->index}.content") is-invalid @enderror"
                                                                    autocomplete="off"
                                                                    cols="50"
                                                                >{{ old(('translations.'.$loop->index.'.content'), (isset($product) ? $product->translations->firstWhere('locale', $locale->code)->content : '')) }}</textarea>

                                                                @error("translations.{$loop->index}.content") <x-alert type="error" :message="$message"/> @enderror
                                                            @else
                                                                <textarea
                                                                    class="form-control"
                                                                    disabled
                                                                    cols="50"
                                                                >{{ (isset($product) ? $product->translations->firstWhere('locale', $locale->code)->content : null) }}</textarea>
                                                            @endif
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="tab-pane" id="product-seo-{{ $locale->code }}" role="tabpanel">
                                                    <div class="form-group row">
                                                        <label for="translations{{ $loop->index }}slug"
                                                               class="col-lg-2 col-form-label"
                                                        >
                                                            {{ __('text.common.slug') }} <span class="text-danger" title="{{ __('text.common.required_field') }}">*</span>
                                                        </label>
                                                        <div class="col-lg-10">
                                                            @if($userCanCreateOrUpdate)
                                                                <input
                                                                    type="text"
                                                                    name="translations[{{ $loop->index }}][slug]" id="translations{{ $loop->index }}slug"
                                                                    class="form-control @error("translations.{$loop->index}.slug") is-invalid @enderror"
                                                                    required
                                                                    maxlength="255"
                                                                    minlength="1"
                                                                    autocomplete="off"
                                                                    value='{{ old(('translations.'.$loop->index.'.slug'), (isset($product) ? $product->translations->firstWhere('locale', $locale->code)->slug : null)) }}'
                                                                >

                                                                @error("translations.{$loop->index}.slug") <x-alert type="error" :message="$message"/> @enderror
                                                            @else
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    disabled
                                                                    value="{{ isset($product) ? $product->translate($locale->code)->slug : '' }}"
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
                                                                    maxlength="255" minlength="1" autocomplete="off"
                                                                    value='{{ old(('translations.'.$loop->index.'.keywords'), (isset($product) ? ($product->translations->firstWhere('locale', $locale->code)->metas['keywords'] ?? null) : null)) }}'
                                                                >

                                                                @error("translations.{$loop->index}.keywords") <x-alert type="error" :message="$message"/> @enderror
                                                            @else
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    disabled
                                                                    value="{{ (isset($product) ? ($product->translations->firstWhere('locale', $locale->code)->metas['keywords'] ?? null) : null) }}"
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
                                                                    value='{{ old(('translations.'.$loop->index.'.description'), (isset($product) ? ($product->translations->firstWhere('locale', $locale->code)->metas['description'] ?? null) : null)) }}'
                                                                >

                                                                @error("translations.{$loop->index}.description") <x-alert type="error" :message="$message"/> @enderror
                                                            @else
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    disabled
                                                                    value="{{ (isset($product) ? ($product->translations->firstWhere('locale', $locale->code)->metas['description'] ?? null) : null)}}"
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

    <div class="kt-portlet kt-portlet--head-lg" data-ktportlet="true" id="kt_portlet_tools_4">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <i class="fa fa-photo-video"></i>
                &nbsp;
                <h3 class="kt-portlet__head-title">
                    {{ __('text.common.medias') }}

                    @if($errors->has('images.*'))
                        &nbsp;
                        <span class="badge badge-danger"><i class="flaticon-warning-sign"></i></span>
                    @endif
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-group">
                    <a href="javascript:void(0)" data-ktportlet-tool="toggle" class="btn btn-sm btn-icon btn-brand btn-icon-md"><i class="la la-angle-down"></i></a>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="kt-portlet__content">
                @if($errors->has('images.*'))
                    @foreach($errors->get('images.*') as $inputErrors)
                        @foreach($inputErrors as $message)
                            <div class="alert alert-danger fade show" role="alert">
                                <div class="alert-icon"><i class="flaticon-warning-sign"></i></div>
                                <div class="alert-text">{{ $message }}</div>
                                <div class="alert-close">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true"><i class="la la-close"></i></span>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                @endif
                <div class="row">
                    <div class="col-lg-12">
                        <div id="picture-preview-list">
                            <div class="row">
                                @isset($product->images)
                                    @foreach($product->images as $images)
                                        <div class="col-lg-3" id="picture-item-{{ $images->order }}">
                                            <div class="form-group row align-items-center" id="picture-item-{{ $images->order }}">
                                                <input type="hidden" name="images[{{ $images->order }}][isExists]" required value="1">
                                                <input type="hidden" name="images[{{ $images->order }}][id]" required value="{{ $images->id }}">
                                                <div class="col-lg-12">
                                                    <div class="col-lg-12">
                                                        <div class="kt-form__group--inline">
                                                            <img src="{{ asset(env('IMAGE_PATH_PRODUCT', \App\Media::DEFAULT_IMAGE_PATH_PRODUCT). $images->source) }}"
                                                                 class="img-thumbnail"
                                                                 id="picture-preview-{{ $images->order }}"
                                                            >
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <a href="javascript:;"
                                                           class="btn-sm btn btn-label-danger btn-bold form-control"
                                                           onclick="removePicture({{ $images->order }})"
                                                        >
                                                            <i class="la la-trash-o"></i>
                                                            {{ __('text.crud.delete') }}
                                                        </a>
                                                    </div>

                                                    <div class="d-md-none kt-margin-b-10"></div>

                                                    <div class="col-lg-12">
                                                        <div class="kt-form__group--inline">
                                                            <label for="images[{{ $images->order }}][alt]" class="col-lg-2 col-form-label">{{ __('text.common.alt') }}</label>
                                                            <input
                                                                type="text"
                                                                name="images[{{ $images->order }}][alt]" id="images[{{ $images->order }}][alt]"
                                                                class="form-control"
                                                                maxlength="255" minlength="1" autocomplete="off"
                                                                value="{{ old(('images.'.$loop->index.'.alt'), ($images->content->alt ?? '')) }}"
                                                            >

                                                            @error("images.{$loop->index}.alt") <x-alert type="error" :message="$message"/> @enderror
                                                        </div>
                                                        <div class="d-md-none kt-margin-b-10"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endisset

                                <div class="col-lg-12">
                                    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($userCanCreateOrUpdate)
                        <div class="col-lg-12">
                            <a href="javascript:void(0)" class="btn-sm btn btn-label-brand btn-bold form-control" onclick="addPicture()">
                                <i class="fa fa-plus"></i>
                                {{ __('text.crud.add_new') }}
                            </a>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>

    <div class="kt-portlet kt-portlet--last kt-portlet--head-lg" data-ktportlet="true" id="kt_portlet_tools_4">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <i class="fa fa-file-alt"></i>&nbsp;
                <h3 class="kt-portlet__head-title">
                    {{ __('text.common.files') }}

                    @if($errors->has('files.*'))
                        &nbsp;
                        <span class="badge badge-danger"><i class="flaticon-warning-sign"></i></span>
                    @endif
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-group">
                    <a href="javascript:void(0)" data-ktportlet-tool="toggle" class="btn btn-sm btn-icon btn-brand btn-icon-md"><i class="la la-angle-down"></i></a>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="kt-portlet__content">
                @if($errors->has('files.*'))
                    @foreach($errors->get('files.*') as $inputErrors)
                        @foreach($inputErrors as $message)
                            <div class="alert alert-danger fade show" role="alert">
                                <div class="alert-icon"><i class="flaticon-warning-sign"></i></div>
                                <div class="alert-text">{{ $message }}</div>
                                <div class="alert-close">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true"><i class="la la-close"></i></span>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                @endif
                <div class="row">
                    <div class="col-lg-12">
                        <div id="file-preview-list">
                            <div class="row">
                                @isset($product->files)
                                    @foreach($product->files as $files)
                                        <div class="col-lg-6" id="file-item-{{ $files->order }}">
                                            <div class="form-group align-items-center" id="file-item-{{ $files->order }}">
                                                <input type="hidden" name="files[{{ $files->order }}][isExists]" required value="1">
                                                <input type="hidden" name="files[{{ $files->order }}][id]" required value="{{ $files->id }}">

                                                <div class="col-lg-12">
                                                    <div class="col-lg-12">
                                                        <div class="kt-form__group--inline">
                                                            <object style="width: 100%; height: -webkit-fill-available;" type="application/pdf"
                                                                data="{{ asset(env('FILE_PATH_PRODUCT', \App\Media::DEFAULT_FILE_PATH_PRODUCT). $files->source) }}"
                                                            >
                                                                <p>{{ __('messages.file.cannot_viewed') }}</p>
                                                            </object>
                                                        </div>
                                                    </div>

                                                    <br>
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <a href="javascript:;" class="btn-sm btn btn-label-danger btn-bold form-control"
                                                                   onclick="removeFile({{ $files->order }})">
                                                                    <i class="la la-trash-o"></i>
                                                                    {{ __('text.crud.delete') }}
                                                                </a>
                                                            </div>
                                                            <div class="col-6">
                                                                <a href="@if(file_exists(env('FILE_PATH_PRODUCT', \App\Media::DEFAULT_FILE_PATH_PRODUCT). $files->source)){{ route('admin.download.file', ['name' => $product->translationForCurrentLocale->name, 'path' => $files->source, 'media_type' => \App\Media::TYPE_ID_FILE]) }}@else javascript:; @endif"
                                                                   class="btn-sm btn btn-label-success btn-bold form-control"
                                                                >
                                                                    <i class="la la-download"></i>
                                                                    {{ __('text.common.download') }}
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="d-md-none kt-margin-b-10"></div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endisset
                            </div>
                        </div>
                    </div>

                    @if($userCanCreateOrUpdate)
                        <div class="col-12">
                            <a href="javascript:void(0)" class="btn-sm btn btn-label-brand btn-bold form-control" onclick="addFile()">
                                <i class="fa fa-plus"></i>
                                {{ __('text.crud.add_new') }}
                            </a>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>

    {{ html()->form()->close() }}
@stop

@section('pageScript')
    <script src="{{asset('admin/assets/custom/bootstrap-toggle_v2.2.2/bootstrap-toggle.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('admin/assets/custom/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('admin/assets/custom/tinymce/tinymce-include.js') }}"></script>
    <script src="{{ asset('admin/assets/vendors/general/autosize/dist/autosize.js') }}"></script>
    <script src="{{ asset('admin/assets/js/sluggable.js') }}"></script>

    <script>
        let slugUrl ='{{ route('admin.slug.create') }}';
        let swalTitleForSlug = "{{ __('messages.slug.auto_slug_failed') }}";
        let swalButtonTextSlug = "{{ __('text.common.ok') }}";

        let imageFileUploadPathForTinymce = "{{ \App\Media::DEFAULT_IMAGE_PATH_PRODUCT }}";

        let pictureItemNumber = {{ $pictureItemNumber }};
        let fileItemNumber = {{ $fileItemNumber }};

        jQuery(document).ready(function() {

            autosize($('.autosize-textarea'));

            $('#main_category').change(function () {
                let mainCategoryId = $(this).val();
            })
        });

        function addPicture() {
            let imageFileUploadTemplate =
                '<div class="form-group row align-items-center" id="picture-item-'+ pictureItemNumber +'">' +
                '   <input type="hidden" name="images['+ pictureItemNumber +'][media_type]" required value="'+ "{{ \App\Media::TYPE_ID_IMAGE }}" +'">' +
                '   <div class="col-lg-2">' +
                '       <div class="col-12">' +
                '           <div class="kt-form__group--inline">' +
                '               <img src="'+ "{{ asset('images/no-image.png') }}" +'" class="img-thumbnail" id="picture-preview-'+ pictureItemNumber +'">' +
                '           </div>' +
                '       </div>' +
                '       <div class="col-12">' +
                '           <a href="javascript:;" class="btn-sm btn btn-label-danger btn-bold form-control" onclick="removePicture('+ pictureItemNumber +')">' +
                '               <i class="la la-trash-o"></i>' +
                '               '+ "{{ __('text.crud.delete') }}" +'' +
                '           </a>' +
                '       </div>' +
                '       <div class="d-md-none kt-margin-b-10"></div>' +
                '   </div>' +
                '   <div class="col-lg-10">' +
                '       <div class="kt-form__group--inline col-lg-12">' +
                '           <div class="kt-form__label col-lg-12">' +
                '               <label for="images['+ pictureItemNumber +'][source]" class="custom-file-label">'+ "{{ __('text.common.choose_file') }}" +'</label>' +
                '               <input' +
                '                   type="file"' +
                '                   name="images['+ pictureItemNumber +'][source]"' +
                '                   id="images['+ pictureItemNumber +'][source]"' +
                '                   class="custom-file-input"' +
                '                   accept="image/*"' +
                '                   onchange="addImageToPreview(this, ' + "'picture-preview-'" + ', '+ pictureItemNumber +')"' +
                '                   required>' +
                '           </div>' +
                '       </div>' +
                '       <div class="kt-form__group--inline">' +
                '           <label for="images['+ pictureItemNumber +'][alt]" class="col-lg-2 col-form-label">'+ "{{ __('text.common.alt') }}" +'</label>' +
                '           <div class="col-lg-12">' +
                '               <input' +
                '                   type="text"' +
                '                   name="images['+ pictureItemNumber +'][alt]" id="images['+ pictureItemNumber +'][alt]"' +
                '                   class="form-control"' +
                '                   maxlength="255" minlength="1" autocomplete="off"' +
                '               >' +
                '           </div>' +
                '       </div>' +
                '       <div class="d-lg-none kt-margin-b-10"></div>' +
                '   </div>' +
                '   <div class="col-lg-12"><div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div> </div>'+
                '</div>';

            $('#picture-preview-list').append(imageFileUploadTemplate);
            pictureItemNumber++;
        }

        function removePicture(pictureItemNumber) {
            Swal.fire({
                title: "{{ __('messages.questions.are_you_sure') }}",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: KTAppOptions.colors.state.danger,
                cancelButtonColor: KTAppOptions.colors.state.success,
                confirmButtonText: "{{ __('messages.info.yes_delete_it') }}",
                cancelButtonText: "{{ __('text.crud.cancel') }}",
            }).then((result) => {
                if (result.value) {
                    $('#picture-item-'+ pictureItemNumber).remove();
                }
            })
        }

        function addFile() {
            let fileUploadTemplate =
                '<div class="form-group row align-items-center" id="file-item-'+ fileItemNumber +'">' +
                '   <input type="hidden" name="files['+ fileItemNumber +'][media_type]" required value="'+ "{{ \App\Media::TYPE_ID_FILE }}" +'">' +
                '   <div class="col-lg-10">' +
                '       <div class="kt-form__group--inline col-lg-12">' +
                '           <div class="kt-form__label col-lg-12">' +
                '               <label for="files['+ fileItemNumber +'][source]" class="custom-file-label">'+ "{{ __('text.common.choose_file') }}" +'</label>' +
                '               <input' +
                '                   type="file"' +
                '                   name="files['+ fileItemNumber +'][source]"' +
                '                   id="files['+ fileItemNumber +'][source]"' +
                '                   class="custom-file-input"' +
                '                   accept="application/pdf, application/vnd.ms-excel, application/msword, application/vnd.ms-powerpoint, text/plain"' +
                '                   onchange="addFileToPreview(this, ' + "'file-preview-'" + ', '+ fileItemNumber +')"' +
                '                   required>' +
                '           </div>' +
                '       </div>' +
                '       <div class="d-md-none kt-margin-b-10"></div>' +
                '   </div>' +
                '   <div class="col-lg-2">' +
                '       <div class="col-12">' +
                '           <a href="javascript:;" class="btn-sm btn btn-label-danger btn-bold form-control" onclick="removeFile('+ fileItemNumber +')">' +
                '               <i class="la la-trash-o"></i>' +
                '               '+ "{{ __('text.crud.delete') }}" +'' +
                '           </a>' +
                '       </div>' +
                '       <div class="d-md-none kt-margin-b-10"></div>' +
                '   </div>' +
                '   <div class="col-lg-12"><div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div> </div>'+
                '</div>';

            $('#file-preview-list').append(fileUploadTemplate);
            fileItemNumber++;
        }

        function removeFile(fileItemNumber) {
            Swal.fire({
                title: "{{ __('messages.questions.are_you_sure') }}",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: KTAppOptions.colors.state.danger,
                cancelButtonColor: KTAppOptions.colors.state.success,
                confirmButtonText: "{{ __('messages.info.yes_delete_it') }}",
                cancelButtonText: "{{ __('text.crud.cancel') }}",
            }).then((result) => {
                if (result.value) {
                    $('#file-item-'+ fileItemNumber).remove();
                }
            })
        }
    </script>
@endsection
