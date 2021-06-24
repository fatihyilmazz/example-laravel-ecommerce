 @isset($subHeaderTitle)

    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">{{ $subHeaderTitle }}</h3>

                <span class="kt-subheader__separator kt-subheader__separator--v"></span>

                <div class="kt-subheader__breadcrumbs">
                    <a href="{{ route('admin.index') }}" class="kt-subheader__breadcrumbs-home"><i class="fa fa fa-home"></i></a>
                    @isset($subHeaderBreadcrumbs)
                        @foreach ($subHeaderBreadcrumbs as $breadcrumb)
                            <span class="kt-subheader__breadcrumbs-separator"></span>
                            <a href="{{ $breadcrumb['url'] }}" class="kt-subheader__breadcrumbs-link {{ $breadcrumb['is_active'] ? 'kt-subheader__breadcrumbs-link--active' : '' }}">{{ $breadcrumb['name'] }}</a>
                        @endforeach
                    @endisset
                </div>
            </div>
        </div>
    </div>

 @endisset
