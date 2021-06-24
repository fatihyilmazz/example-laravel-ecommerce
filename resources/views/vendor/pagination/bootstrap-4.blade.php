@if ($paginator->hasPages())
    <div class="kt-datatable kt-datatable--default kt-datatable--brand kt-datatable--subtable kt-datatable--loaded" id="child_data_local" style="">
        <div class="kt-datatable__pager kt-datatable--paging-loaded" style="padding: 0 !important; padding-top: 25px !important;">
            <ul class="kt-datatable__pager-nav">
                <li>
                    @if ($paginator->onFirstPage())
                        <a title="First" class="kt-datatable__pager-link kt-datatable__pager-link--first kt-datatable__pager-link--disabled" data-page="1" disabled="disabled">
                            <i class="flaticon2-fast-back"></i>
                        </a>
                    @else
                        <a href="{{ $paginator->url(1) }}" title="First" class="kt-datatable__pager-link kt-datatable__pager-link--first" data-page="1">
                            <i class="flaticon2-fast-back"></i>
                        </a>
                    @endif
                </li>
                <li>
                    @if ($paginator->onFirstPage())
                        <a title="Previous" class="kt-datatable__pager-link kt-datatable__pager-link--prev kt-datatable__pager-link--disabled" disabled="disabled">
                            <i class="flaticon2-back"></i>
                        </a>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" title="Previous" class="kt-datatable__pager-link kt-datatable__pager-link--prev">
                            <i class="flaticon2-back"></i>
                        </a>
                    @endif
                </li>

                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li>
                            <a class="kt-datatable__pager-link kt-datatable__pager-link-number">{{ $element }}</a>
                        </li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li>
                                    <a class="kt-datatable__pager-link kt-datatable__pager-link-number kt-datatable__pager-link--active" data-page="{{ $page }}" title="{{ $page }}">{{ $page }}</a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ $url }}" class="kt-datatable__pager-link kt-datatable__pager-link-number" data-page="{{ $page }}" title="{{ $page }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                <li></li>
                @if ($paginator->hasMorePages())
                    <li>
                        <a href="{{ $paginator->nextPageUrl() }}" title="Next" class="kt-datatable__pager-link kt-datatable__pager-link--next" data-page="2">
                            <i class="flaticon2-next"></i>
                        </a>
                    </li>

                    <li>
                        <a href="{{ $paginator->url($paginator->lastPage()) }}" title="Last" class="kt-datatable__pager-link kt-datatable__pager-link--last" data-page="{{ $paginator->lastPage() }}">
                            <i class="flaticon2-fast-next"></i>
                        </a>
                    </li>
                @else
                    <li>
                        <a title="Next" class="kt-datatable__pager-link kt-datatable__pager-link--next kt-datatable__pager-link--disabled">
                            <i class="flaticon2-next"></i>
                        </a>
                    </li>

                    <li>
                        <a title="Last" class="kt-datatable__pager-link kt-datatable__pager-link--last kt-datatable__pager-link--disabled">
                            <i class="flaticon2-fast-next"></i>
                        </a>
                    </li>
                @endif
            </ul>

            @php
                $perPageList = explode(',', setting('pagination_per_page_list', \App\Setting::PAGINATION_PER_PAGE_LIST));
            @endphp

            <div class="kt-datatable__pager-info">
                <div class="dropdown bootstrap-select kt-datatable__pager-size" style="width: 60px;">
                    <select name="per_page" onchange="submitFilterForm()" class="selectpicker kt-datatable__pager-size" title="{{ __('text.crud.select') }}" data-width="60px" data-selected="10" tabindex="-98">
                        @foreach($perPageList as $perPage )
                            <option value="{{ $perPage }}" {{ $paginator->perPage() == $perPage ? 'selected' : '' }}>{{ $perPage }}</option>
                        @endforeach
                    </select>
                    <div class="dropdown-menu ">
                        <div class="inner show" role="listbox" id="bs-select-3" tabindex="-1">
                            <ul class="dropdown-menu inner show" role="presentation"></ul>
                        </div>
                    </div>
                </div>
                <span class="kt-datatable__pager-detail">
                    <span class="badge badge-primary">{{ __('text.common.total') }}: {{ $paginator->total() }} / {{ $paginator->firstItem() }} - {{ $paginator->lastItem() }}</span>
                </span>

                @error('per_page') <x-alert type="error" :message="$message"/> @enderror

            </div>
        </div>
    </div>
@endif
