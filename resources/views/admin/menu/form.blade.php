@extends('admin.layouts.app')

@php
    $pageTitle = __('text.menu.management');

    $subHeaderTitle = __('text.menu.management');
    $subHeaderBreadcrumbs = [['name' => __('text.menu.name_plural'), 'url' => route('admin.menus.index'), 'is_active' => false]];

    $menuTypeId             = null;
    $pageId                 = null;
    $externalLink           = null;
    $mainCategoryId         = null;
    $selectedCategoryIds    = null;
    $brandIds               = null;
    $staticPage             = null;

    if (isset($menu)) {
        $subHeaderBreadcrumbs = array_merge($subHeaderBreadcrumbs, [['name' => __('text.crud.edit'), 'url' => $menu->editLink(), 'is_active' => true]]);

        $menuTypeId = $menu->menu_type_id;

        if ($menu->menu_type_id === \App\MenuType::ID_PAGE) {
            $pageId = $menu->value[0];
        } elseif ($menu->menu_type_id === \App\MenuType::ID_EXTERNAL_LINK) {
            $externalLink = $menu->value[0];
        } elseif ($menu->menu_type_id === \App\MenuType::ID_MAIN_CATEGORY) {
            $mainCategoryId = $menu->value[0];
        } elseif ($menu->menu_type_id === \App\MenuType::ID_SELECTED_CATEGORIES) {
            $selectedCategoryIds = $menu->value;
        } elseif ($menu->menu_type_id === \App\MenuType::ID_BRANDS) {
            $brandIds = $menu->value;
        } elseif ($menu->menu_type_id === \App\MenuType::ID_STATIC_PAGE) {
            $staticPage = $menu->value[0];
        }
    } else {
        $subHeaderBreadcrumbs = array_merge($subHeaderBreadcrumbs, [['name' => __('text.crud.add_new'), 'url' => route('admin.menus.create'), 'is_active' => true]]);
    }

    $userCanCreateOrUpdate = false;
    if ((auth()->user()->can('create-menus') && Request::routeIs('admin.menus.create')) || (auth()->user()->can('update-menus') && Request::routeIs('admin.menus.edit'))) {
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
                    @if(isset($menu))
                        {{ __('text.menu.edit') }}
                    @else
                        {{ __('text.menu.create') }}
                    @endif
                </h3>
            </div>
        </div>

        @if(isset($menu))
            {{ html()->form('PUT', $menu->updateLink())->open() }}
        @else
            {{ html()->form('POST', route('admin.menus.store'))->open() }}
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
                        <label for="menu_group_id" class="col-lg-2 col-form-label">{{ __('text.menu.group') }} <span class="text-danger" title="{{ __('text.common.required_field') }}">*</span></label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                {{ html()
                                    ->select('menu_group_id')
                                    ->class(['form-control select2 d-block w-100', 'is-invalid' => $errors->has('menu_group_id')])
                                    ->options($menuGroups)
                                    ->attributes(['autocomplete' => 'off'])
                                    ->required()
                                    ->placeholder(__('text.crud.select'))
                                    ->value(old('menu_group_id', (isset($menu) ? $menu->menu_group_id : null)))
                                }}

                                @error('menu_group_id') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                {{ html()
                                    ->select('menu_group_id')
                                    ->class(['form-control'])
                                    ->options($menuGroups)
                                    ->attributes(['autocomplete' => 'off', 'disabled' => 'disabled'])
                                    ->placeholder(__('text.crud.select'))
                                    ->value((isset($menu) ? $menu->menu_group_id : null))
                                }}
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="parent_id" class="col-lg-2 col-form-label">{{ __('text.menu.parent_menu') }} </label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                {{ html()
                                    ->select('parent_id')
                                    ->class(['form-control select2 d-block w-100', 'is-invalid' => $errors->has('parent_id')])
                                    ->options($parentMenus)
                                    ->attributes(['autocomplete' => 'off'])
                                    ->placeholder(__('text.crud.select'))
                                    ->value(old('parent_id', (isset($menu) ? $menu->parent_id : null)))
                                }}

                                @error('parent_id') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                {{ html()
                                    ->select('parent_id')
                                    ->class(['form-control'])
                                    ->options($parentMenus)
                                    ->attributes(['disabled' => 'disabled'])
                                    ->placeholder(__('text.crud.select'))
                                    ->value((isset($menu) ? $menu->parent_id : null))
                                }}
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="menu_type_id" class="col-lg-2 col-form-label">{{ __('text.menu_type.name_singular') }}</label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                <select name="menu_type_id" id="menu_type_id" class="form-control select2 d-block w-100 @error('menu_type_id') is-invalid @enderror()">
                                    <option value="">{{ __('text.crud.select') }}</option>
                                    @foreach($menuTypes as $key => $value)
                                        <option value="{{ $key }}" {{ (old('menu_type_id', (isset($menu) ? $menu->menu_type_id : null)) == $key ? 'selected' : null) }}>
                                            {{ __('text.menu_type.'. $value) }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('menu_type_id') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                <select class="form-control select2 d-block w-100" disabled>
                                    @foreach($menuTypes as $key => $value)
                                        <option value="{{ $key }}" {{ $menu->menu_type_id == $key ? 'selected' : '' }}>{{ __('text.menu_type.'. $value) }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row" id="page_section" style="display: {{ old('menu_type_id', $menuTypeId) == \App\MenuType::ID_PAGE ? 'flex' : 'none' }};">
                        <label for="page_id" class="col-lg-2 col-form-label">{{ __('text.menu_type.internal_page') }} <span class="text-danger" title="{{ __('text.common.required_field') }}">*</span></label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                {{ html()
                                    ->select('page_id')
                                    ->class(['form-control select2 d-block w-100', 'is-invalid' => $errors->has('page_id')])
                                    ->options($pages)
                                    ->attributes(['autocomplete' => 'off'])
                                    ->placeholder(__('text.crud.select'))
                                    ->required(!is_null($pageId))
                                    ->value(old('page_id', $pageId))
                                }}

                                @error('page_id') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                {{ html()
                                    ->select('page_id')
                                    ->class(['form-control select2 d-block w-100'])
                                    ->options($pages)
                                    ->attributes(['disable' => true])
                                    ->placeholder(__('text.crud.select'))
                                    ->value($pageId)
                                }}
                            @endif
                        </div>
                    </div>

                    <div class="form-group row" id="external_link_section" style="display: {{ old('menu_type_id', $menuTypeId) == \App\MenuType::ID_EXTERNAL_LINK ? 'flex' : 'none' }};">
                        <label for="external_link" class="col-lg-2 col-form-label">{{ __('text.menu_type.external_link') }} <span class="text-danger" title="{{ __('text.common.required_field') }}">*</span></label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                {{ html()
                                    ->input('url', 'external_link')
                                    ->class(['form-control', 'is-invalid' => $errors->has('external_link')])
                                    ->attributes(['autocomplete' => 'off'])
                                    ->required(!is_null($externalLink))
                                    ->value(old('external_link', $externalLink))
                                }}

                                @error('external_link') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                {{ html()
                                    ->input('url', 'external_link')
                                    ->class(['form-control', 'is-invalid' => $errors->has('external_link')])
                                    ->attributes(['disable' => true])
                                    ->value($externalLink)
                                }}
                            @endif
                        </div>
                    </div>

                    <div class="form-group row" id="main_category_section" style="display: {{ old('menu_type_id', $menuTypeId) == \App\MenuType::ID_MAIN_CATEGORY ? 'flex' : 'none' }};">
                        <label for="main_category_id" class="col-lg-2 col-form-label">{{ __('text.menu_type.main_category') }} <span class="text-danger" title="{{ __('text.common.required_field') }}">*</span></label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                {{ html()
                                    ->select('main_category_id')
                                    ->class(['form-control select2 d-block w-100', 'is-invalid' => $errors->has('main_category_id')])
                                    ->options($mainCategories)
                                    ->attributes(['autocomplete' => 'off'])
                                    ->placeholder(__('text.crud.select'))
                                    ->required(!is_null(old('main_category_id', $mainCategoryId)))
                                    ->value(old('main_category_id', $mainCategoryId))
                                }}

                                @error('main_category_id') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                {{ html()
                                    ->select('main_category_id')
                                    ->class(['form-control select2 d-block w-100'])
                                    ->options($mainCategories)
                                    ->attributes(['disable' => true])
                                    ->placeholder(__('text.crud.select'))
                                    ->value($mainCategoryId)
                                }}
                            @endif
                        </div>
                    </div>

                    <div class="form-group row" id="categories_section" style="display: {{ old('menu_type_id', $menuTypeId) == \App\MenuType::ID_SELECTED_CATEGORIES ? 'flex' : 'none' }};">
                        <label for="category_ids" class="col-lg-2 col-form-label">{{ __('text.menu_type.selected_categories') }} <span class="text-danger" title="{{ __('text.common.required_field') }}">*</span></label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                {{ html()
                                    ->select('category_ids')
                                    ->multiple()
                                    ->class(['form-control select2 d-block w-100', 'is-invalid' => $errors->has('category_ids')])
                                    ->options($categories)
                                    ->attributes(['autocomplete' => 'off'])
                                    ->required(!is_null($selectedCategoryIds))
                                    ->value(old('category_ids', $selectedCategoryIds))
                                }}

                                @error('category_ids') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                {{ html()
                                    ->select('category_ids')
                                    ->multiple()
                                    ->class(['form-control select2 d-block w-100'])
                                    ->options($categories)
                                    ->attributes(['disabled' => true])
                                    ->value($selectedCategoryIds)
                                }}
                            @endif
                        </div>
                    </div>

                    <div class="form-group row" id="brands_section" style="display:{{ old('menu_type_id', $menuTypeId) == \App\MenuType::ID_BRANDS ? 'flex' : 'none' }}">
                        <label for="brand_ids" class="col-lg-2 col-form-label">
                            {{ __('text.menu_type.brands') }}
                            <span class="text-danger" title="{{ __('text.common.required_field') }}">*</span>
                        </label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                {{ html()
                                    ->select('brand_ids')
                                    ->multiple()
                                    ->class(['form-control select2 d-block w-100', 'is-invalid' => $errors->has('brand_ids')])
                                    ->options($brands)
                                    ->attributes(['autocomplete' => 'off'])
                                    ->required(!is_null(old('brand_ids', $brandIds)))
                                    ->value(old('brand_ids', $brandIds))
                                }}

                                @error('brand_ids') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                {{ html()
                                    ->select('brand_ids')
                                    ->multiple()
                                    ->class(['form-control select2 d-block w-100'])
                                    ->options($brands)
                                    ->attributes(['disabled' => true])
                                    ->value($brandIds)
                                }}
                            @endif
                        </div>
                    </div>

                    <div class="form-group row" id="static_page_section" style="display: {{ old('menu_type_id', $menuTypeId) == \App\MenuType::ID_STATIC_PAGE ? 'flex' : 'none' }};">
                        <label for="static_page" class="col-lg-2 col-form-label">{{ __('text.menu_type.static_page') }} <span class="text-danger" title="{{ __('text.common.required_field') }}">*</span></label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                {{ html()
                                    ->select('static_page')
                                    ->class(['form-control select2 d-block w-100', 'is-invalid' => $errors->has('static_page')])
                                    ->options($staticPageNames)
                                    ->attributes(['autocomplete' => 'off'])
                                    ->placeholder(__('text.crud.select'))
                                    ->required(!is_null(old('static_page', $staticPage)))
                                    ->value(old('static_page', $staticPage))
                                }}

                                @error('static_page') <x-alert type="error" :message="$message"/> @enderror
                            @else
                                {{ html()
                                    ->select('static_page')
                                    ->class(['form-control select2 d-block w-100'])
                                    ->options($staticPageNames)
                                    ->attributes(['disable' => true])
                                    ->placeholder(__('text.crud.select'))
                                    ->value($staticPage)
                                }}
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="row" class="col-lg-2 col-form-label">{{ __('text.common.order') }}</label>
                        <div class="col-lg-10">
                            @if($userCanCreateOrUpdate)
                                {{ html()->number('row')->class(['form-control', 'is-invalid' => $errors->has('row')])->attributes(['min' => 0, 'max' => 32767, 'autocomplete' => 'off']) }}

                                @error('row')  <x-alert type="error" :message="$message"/> @enderror
                            @else
                                <input type="text" class="form-control" disabled value="{{ isset($menu) ? $menu->row : null }}">
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
                                {{ html()->checkbox('is_active')
                                    ->class(['form-control'])
                                    ->attributes(['data-toggle' => 'toggle', 'data-on' => __('text.crud.active'), 'data-off' => __('text.crud.passive'),
                                    'data-width' => '200', 'data-onstyle' => 'success', 'data-offstyle' => 'danger', 'disabled' => 'disabled'])}}
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
                                            <div class="tab-pane @if ($loop->first) active @endif" id="{{ $locale->code }}" role="tabpanel">
                                                @if($userCanCreateOrUpdate)
                                                    <input type="hidden" name="translations[{{ $loop->index }}][locale]" value="{{ $locale->code }}">
                                                    <input type="hidden" name="translations[{{ $loop->index }}][id]" value="{{ (isset($menu) ? $menu->translations->firstWhere('locale', $locale->code)->id : null)  }}">
                                                @endif
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
                                                                value='{{ old('translations.'.$loop->index.'.name', (isset($menu) ? $menu->translations->firstWhere('locale', $locale->code)->name : '')) }}'
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
                                                                value="{{ isset($menu) ? $menu->translate($locale->code)->name : '' }}"
                                                            >
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="translations{{ $loop->index }}slug" class="col-lg-2 col-form-label">{{ __('text.common.slug') }}</label>
                                                    <div class="col-lg-10">
                                                        @if($userCanCreateOrUpdate)
                                                            <input
                                                                type="text"
                                                                name="translations[{{ $loop->index }}][slug]" id="translations{{ $loop->index }}slug"
                                                                class="form-control @error("translations.{$loop->index}.slug") is-invalid @enderror"
                                                                maxlength="255" minlength="1" autocomplete="off"
                                                                value='{{ old(('translations.'.$loop->index.'.slug'), (isset($menu) ? $menu->translations->firstWhere('locale', $locale->code)->slug : '')) }}'
                                                            >

                                                            @error("translations.{$loop->index}.slug") <x-alert type="error" :message="$message"/> @enderror
                                                        @else
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                disabled
                                                                value="{{ isset($menu) ? $menu->translate($locale->code)->slug : '' }}"
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
    <script src="{{ asset('admin/assets/js/sluggable.js') }}"></script>

    <script>
        let slugUrl ='{{ route('admin.slug.create') }}';
        let swalTitleForSlug = "{{ __('messages.slug.auto_slug_failed') }}";
        let swalButtonTextSlug = "{{ __('text.common.ok') }}";

        $( "#menu_type_id" ).change(function() {
            let menuTypeId = $(this).children("option:selected").val();

            let pageSection = $("#page_section");
            let pageId = $("#page_id");

            let externalLinkSection = $("#external_link_section");
            let externalLink = $("#external_link");

            let mainCategorySection =  $("#main_category_section");
            let mainCategoryId = $("#main_category_id");

            let categoriesSection =  $("#categories_section");
            let categoryIdsElement = $("#category_ids");

            let brandsSection =  $("#brands_section");
            let brandIdsElement = $("#brand_ids");

            let staticPageSection =  $("#static_page_section");
            let staticPageElement = $("#static_page");

            pageSection.hide();
            pageId.val(null).trigger('change').prop('required',false);

            externalLinkSection.hide();
            externalLink.val(null).trigger('change').prop('required',false);

            mainCategorySection.hide();
            mainCategoryId.val(null).trigger('change').prop('required',false);

            categoriesSection.hide();
            categoryIdsElement.val(null).trigger('change').prop('required',false);

            brandsSection.hide();
            brandIdsElement.val(null).trigger('change').prop('required',false);

            staticPageSection.hide();
            staticPageElement.val(null).trigger('change').prop('required',false);


            if (menuTypeId == {{ \App\MenuType::ID_PAGE }}) {
                pageSection.show();
                pageId.prop('required', true);
            } else if (menuTypeId == {{ \App\MenuType::ID_EXTERNAL_LINK }}) {
                externalLinkSection.show();
                externalLink.prop('required', true);
            } else if (menuTypeId == {{ \App\MenuType::ID_MAIN_CATEGORY }}) {
                mainCategorySection.show();
                mainCategoryId.prop('required', true);
            } else if (menuTypeId == {{ \App\MenuType::ID_SELECTED_CATEGORIES }}) {
                categoriesSection.show();
                categoryIdsElement.prop('required', true);
            } else if (menuTypeId == {{ \App\MenuType::ID_BRANDS }}) {
                brandsSection.show();
                brandIdsElement.prop('required', true);
            } else if (menuTypeId == {{ \App\MenuType::ID_STATIC_PAGE }}) {
                staticPageSection.show();
                staticPageElement.prop('required', true);
            }

            initSelect2();
        });
    </script>
@endsection
