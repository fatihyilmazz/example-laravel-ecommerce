<!DOCTYPE html>
<html lang="{{ $app->getLocale() }}">
<head>
    <base href="{{ env('APP_URL') }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="robots" content="noindex" />

    <title>{{ $pageTitle ?? '' }}</title>

    <meta name="description" content="Default minimized aside">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

    <link href="{{ asset('admin/assets/vendors/general/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" type="text/css"/>

{{--    <link href="{{asset('admin/assets/vendors/general/tether/dist/css/tether.css')}}" rel="stylesheet" type="text/css"/>--}}
{{--    <link href="{{asset('admin/assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}" rel="stylesheet" type="text/css"/>--}}
{{--    <link href="{{asset('admin/assets/vendors/general/bootstrap-datetime-picker/css/bootstrap-datetimepicker.css')}}" rel="stylesheet" type="text/css"/>--}}
{{--    <link href="{{asset('admin/assets/vendors/general/bootstrap-timepicker/css/bootstrap-timepicker.css')}}" rel="stylesheet" type="text/css"/>--}}
    <link href="{{ asset('admin/assets/vendors/general/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css"/>
{{--    <link href="{{asset('admin/assets/vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css')}}" rel="stylesheet" type="text/css"/>--}}
{{--    <link href="{{asset('admin/assets/vendors/general/bootstrap-select/dist/css/bootstrap-select.css')}}" rel="stylesheet" type="text/css"/>--}}
{{--    <link href="{{asset('admin/assets/vendors/general/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css')}}" rel="stylesheet" type="text/css"/>--}}
    <link href="{{ asset('admin/assets/vendors/general/select2/dist/css/select2.css') }}" rel="stylesheet" type="text/css"/>
{{--    <link href="{{asset('admin/assets/vendors/general/ion-rangeslider/css/ion.rangeSlider.css')}}" rel="stylesheet" type="text/css"/>--}}
{{--    <link href="{{asset('admin/assets/vendors/general/nouislider/distribute/nouislider.css')}}" rel="stylesheet" type="text/css"/>--}}
{{--    <link href="{{asset('admin/assets/vendors/general/owl.carousel/dist/assets/owl.carousel.css')}}" rel="stylesheet" type="text/css"/>--}}
{{--    <link href="{{asset('admin/assets/vendors/general/owl.carousel/dist/assets/owl.theme.default.css')}}" rel="stylesheet" type="text/css"/>--}}
{{--    <link href="{{asset('admin/assets/vendors/general/dropzone/dist/dropzone.css')}}" rel="stylesheet" type="text/css"/>--}}
{{--    <link href="{{asset('admin/assets/vendors/general/quill/dist/quill.snow.css')}}" rel="stylesheet" type="text/css"/>--}}
{{--    <link href="{{asset('admin/assets/vendors/general/@yaireo/tagify/dist/tagify.css')}}" rel="stylesheet" type="text/css"/>--}}
{{--    <link href="{{asset('admin/assets/vendors/general/summernote/dist/summernote.css')}}" rel="stylesheet" type="text/css"/>--}}
{{--    <link href="{{asset('admin/assets/vendors/general/bootstrap-markdown/css/bootstrap-markdown.min.css')}}" rel="stylesheet" type="text/css"/>--}}
    <link href="{{ asset('admin/assets/vendors/general/animate.css/animate.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin/assets/vendors/general/toastr/build/toastr.css') }}" rel="stylesheet" type="text/css"/>
{{--    <link href="{{asset('admin/assets/vendors/general/dual-listbox/dist/dual-listbox.css')}}" rel="stylesheet" type="text/css"/>--}}
{{--    <link href="{{asset('admin/assets/vendors/general/morris.js/morris.css')}}" rel="stylesheet" type="text/css"/>--}}
    <link href="{{ asset('admin/assets/vendors/general/sweetalert2/dist/sweetalert2.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin/assets/vendors/general/socicon/css/socicon.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin/assets/vendors/custom/vendors/line-awesome/css/line-awesome.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin/assets/vendors/custom/vendors/flaticon/flaticon.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin/assets/vendors/custom/vendors/flaticon2/flaticon.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin/assets/vendors/general/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css"/>

    <link href="{{ asset('admin/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css"/>

    <link href="{{ asset('admin/assets/css/skins/header/base/light.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin/assets/css/skins/header/menu/light.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin/assets/css/skins/brand/dark.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin/assets/css/skins/aside/dark.css') }}" rel="stylesheet" type="text/css"/>

    @yield('pageStyle')

    <link rel="shortcut icon" href="{{asset('admin/assets/media/logos/favicon.ico')}}"/>

    <style>
        /* Paste this css to your style sheet file or under head tag */
        /* This only works with JavaScript,
        if it's not present, don't show loader */
        .no-js #loader { display: none;  }
        .js #loader { display: block; position: absolute; left: 100px; top: 0; }
        .page--loading {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url({{asset('admin/assets/media/loader/shopping_card.gif')}}) center no-repeat #fff;
        }
    </style>
</head>
<!-- end::Head -->

<!-- begin::Body -->
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed
    {{ isset($pageTitle) ? 'kt-subheader--enabled kt-subheader--fixed kt-subheader--solid' : '' }}
    kt-aside--enabled kt-aside--fixed kt-aside--minimize kt-page--loading">

<div class="page--loading"></div>

@include('admin.layouts.inc.mobile_header')

<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

        @include('admin.layouts.inc.sidebar')

        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

            @include('admin.layouts.inc.header')

            <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

                @include('admin.layouts.inc.sub_header')

                <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

                    @yield('content')

                </div>
            </div>

            @include('admin.layouts.inc.footer')
        </div>
    </div>
</div>
<!-- end:: Page -->

<!-- begin::Scrolltop -->
<div id="kt_scrolltop" class="kt-scrolltop"><i class="fa fa-arrow-up"></i></div>
<!-- end::Scrolltop -->

<input type="hidden" name="currentLocale" value="{{ $app->getLocale() }}">

<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#5d78ff",
                "dark": "#282a3c",
                "light": "#ffffff",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995"
            },
            "base": {
                "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
            }
        }
    };
</script>
<!-- end::Global Config -->

<!--begin:: Global Mandatory Vendors -->
<script src="{{ asset('admin/assets/vendors/general/jquery/dist/jquery.js') }}" type="text/javascript"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
<script src="{{ asset('admin/assets/vendors/general/popper.js/dist/umd/popper.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin/assets/vendors/general/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin/assets/vendors/general/js-cookie/src/js.cookie.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin/assets/vendors/general/moment/min/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin/assets/vendors/general/tooltip.js/dist/umd/tooltip.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin/assets/vendors/general/perfect-scrollbar/dist/perfect-scrollbar.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin/assets/vendors/general/sticky-js/dist/sticky.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin/assets/vendors/general/wnumb/wNumb.js') }}" type="text/javascript"></script>
<!--end:: Global Mandatory Vendors -->

<!--begin:: Global Optional Vendors -->
<script src="{{ asset('admin/assets/vendors/general/toastr/build/toastr.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin/assets/vendors/general/chart.js/dist/Chart.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin/assets/vendors/general/sweetalert2/dist/sweetalert2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin/assets/vendors/custom/js/vendors/sweetalert2.init.js') }}" type="text/javascript"></script>
{{--<script src="{{asset('admin/assets/vendors/general/bootstrap-select/dist/js/bootstrap-select.js')}}" type="text/javascript"></script>--}}

{{--<script src="{{asset('admin/assets/vendors/general/jquery-form/dist/jquery.form.min.js')}}" type="text/javascript"></script>--}}
{{--<script src="{{asset('admin/assets/vendors/general/block-ui/jquery.blockUI.js')}}" type="text/javascript"></script>--}}

<script src="{{ asset('admin/assets/vendors/general/bootstrap-daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin/assets/js/date-range-picker-functions.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin/assets/vendors/general/bootstrap-maxlength/src/bootstrap-maxlength.js') }}" type="text/javascript"></script>



{{--<script src="{{asset('admin/assets/vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js')}}" type="text/javascript"></script>--}}
{{--<script src="{{asset('admin/assets/vendors/general/bootstrap-switch/dist/js/bootstrap-switch.js')}}" type="text/javascript"></script>--}}
{{--<script src="{{asset('admin/assets/vendors/custom/js/vendors/bootstrap-switch.init.js')}}" type="text/javascript"></script>--}}
<script src="{{asset('admin/assets/vendors/general/select2/dist/js/select2.full.js')}}" type="text/javascript"></script>
{{--<script src="{{asset('admin/assets/vendors/general/typeahead.js/dist/typeahead.bundle.js')}}" type="text/javascript"></script>--}}
{{--<script src="{{asset('admin/assets/vendors/general/handlebars/dist/handlebars.js')}}" type="text/javascript"></script>--}}
{{--<script src="{{asset('admin/assets/vendors/general/autosize/dist/autosize.js')}}" type="text/javascript"></script>--}}
{{--<script src="{{asset('admin/assets/vendors/general/autosize/dist/autosize.js')}}" type="text/javascript"></script>--}}
{{--<script src="{{asset('admin/assets/vendors/general/clipboard/dist/clipboard.min.js')}}" type="text/javascript"></script>--}}
{{--<script src="{{asset('admin/assets/vendors/general/dropzone/dist/dropzone.js')}}" type="text/javascript"></script>--}}
{{--<script src="{{asset('admin/assets/vendors/custom/js/vendors/dropzone.init.js')}}" type="text/javascript"></script>--}}
{{--<script src="{{asset('admin/assets/vendors/general/quill/dist/quill.js')}}" type="text/javascript"></script>--}}
{{--<script src="{{asset('admin/assets/vendors/general/@yaireo/tagify/dist/tagify.polyfills.min.js')}}" type="text/javascript"></script>--}}
{{--<script src="{{asset('admin/assets/vendors/general/@yaireo/tagify/dist/tagify.min.js')}}" type="text/javascript"></script>--}}
{{--<script src="{{asset('admin/assets/vendors/general/summernote/dist/summernote.js')}}" type="text/javascript"></script>--}}
{{--<script src="{{asset('admin/assets/vendors/general/markdown/lib/markdown.js')}}" type="text/javascript"></script>--}}
{{--<script src="{{asset('admin/assets/vendors/general/bootstrap-markdown/js/bootstrap-markdown.js')}}" type="text/javascript"></script>--}}
{{--<script src="{{asset('admin/assets/vendors/custom/js/vendors/bootstrap-markdown.init.js')}}" type="text/javascript"></script>--}}
<script src="{{asset('admin/assets/vendors/general/bootstrap-notify/bootstrap-notify.min.js')}}" type="text/javascript"></script>
<script src="{{asset('admin/assets/vendors/custom/js/vendors/bootstrap-notify.init.js')}}" type="text/javascript"></script>
{{--<script src="{{asset('admin/assets/vendors/general/jquery-validation/dist/jquery.validate.js')}}" type="text/javascript"></script>--}}
{{--<script src="{{asset('admin/assets/vendors/general/jquery-validation/dist/additional-methods.js')}}" type="text/javascript"></script>--}}
{{--<script src="{{asset('admin/assets/vendors/custom/js/vendors/jquery-validation.init.js')}}" type="text/javascript"></script>--}}
{{--<script src="{{asset('admin/assets/vendors/general/dual-listbox/dist/dual-listbox.js')}}" type="text/javascript"></script>--}}
{{--<script src="{{asset('admin/assets/vendors/general/raphael/raphael.js')}}" type="text/javascript"></script>--}}
{{--<script src="{{asset('admin/assets/vendors/general/morris.js/morris.js')}}" type="text/javascript"></script>--}}
{{--<script src="{{asset('admin/assets/vendors/custom/vendors/bootstrap-session-timeout/dist/bootstrap-session-timeout.min.js')}}" type="text/javascript"></script>--}}
{{--<script src="{{asset('admin/assets/vendors/custom/vendors/jquery-idletimer/idle-timer.min.js')}}" type="text/javascript"></script>--}}
{{--<script src="{{asset('admin/assets/vendors/general/waypoints/lib/jquery.waypoints.js')}}" type="text/javascript"></script>--}}
{{--<script src="{{asset('admin/assets/vendors/general/counterup/jquery.counterup.js')}}" type="text/javascript"></script>--}}
{{--<script src="{{asset('admin/assets/vendors/general/es6-promise-polyfill/promise.min.js')}}" type="text/javascript"></script>--}}

{{--<script src="{{asset('admin/assets/vendors/general/jquery.repeater/src/lib.js')}}" type="text/javascript"></script>--}}
{{--<script src="{{asset('admin/assets/vendors/general/jquery.repeater/src/jquery.input.js')}}" type="text/javascript"></script>--}}
{{--<script src="{{asset('admin/assets/vendors/general/jquery.repeater/src/repeater.js')}}" type="text/javascript"></script>--}}
{{--<script src="{{asset('admin/assets/vendors/general/dompurify/dist/purify.js')}}" type="text/javascript"></script>--}}
<!--end:: Global Optional Vendors -->

<script src="{{asset('admin/assets/js/demo1/scripts.bundle.js')}}" type="text/javascript"></script>
<script src="{{asset('admin/assets/js/bootstrap-notify-functions.js')}}" type="text/javascript"></script>
<script src="{{asset('admin/assets/js/app.js')}}" type="text/javascript"></script>
<script src="{{asset('admin/assets/js/demo1/pages/dashboard.js')}}" type="text/javascript"></script>

<script>
    jQuery(document).ready(function() {
        initSelect2();

        //$(':input').maxlength({
        //    threshold: 3,
        //    //placement: 'top-left',
        //    warningClass: "kt-badge kt-badge--brand kt-badge--rounded kt-badge--inline",
        //    limitReachedClass: "kt-badge kt-badge--danger kt-badge--rounded kt-badge--inline",
        //    //appendToParent: true,
        //    separator: ' / ',
        //    preText: '{{ __('text.info.chars_used') }} ',
        //    //postText: ' allowed chars reamaining.',
        //    //validate: true
        //});

        @if(session()->has('notifyStatus'))
            callBootstrapNotify('{{ session()->get('notifyStatus') }}', '{{ session()->get('notifyMessage') }}', '{{ session()->get('notifyTitle') }}');
        @elseif($errors->any())
            callBootstrapNotify('danger', '{{ __('messages.errors.unexpected_error') }}', '{{ __('messages.info.operation.failed') }}');
        @endif
    });

    function initSelect2() {
        $('.select2').select2({
            placeholder: "{{ __('text.crud.select') }}",
            allowClear: true,
        });
    }

    // Datatable delete button action
    function confirmToDelete(url, itemId = null) {
        Swal.fire({
            title: "{{ __('messages.questions.are_you_sure') }}",
            text: "{{ __('messages.info.this_action_cannot_be_undone') }}",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: KTAppOptions.colors.state.danger,
            cancelButtonColor: KTAppOptions.colors.state.success,
            confirmButtonText: "{{ __('messages.info.yes_delete_it') }}",
            cancelButtonText: "{{ __('text.crud.cancel') }}",
        }).then((result) => {
            if (result.value) {
                $(".page--loading").fadeIn();

                if (itemId) {
                    var spinnerElement = $('#spinner-button-' + itemId);
                    var defaultClass = spinnerElement.attr('class');
                }

                $.ajax({
                    url: url,
                    type: 'DELETE',
                    beforeSend: function() {
                        if (itemId) {
                            spinnerElement.removeClass();
                            spinnerElement.addClass('kt-spinner kt-spinner--lg kt-spinner--warning');
                        }
                    },
                    success: function(result) {
                        spinnerElement.removeClass();
                        spinnerElement.addClass(defaultClass);

                        $(".page--loading").fadeOut();

                        if (result) {
                            $('.table-row-id-' + itemId).remove();

                            Swal.fire({ title: "{{ __('messages.info.deleted') }}", type: 'success'})
                        } else {
                            Swal.fire({ title: "{{ __('messages.info.failed_to_delete') }}", type: 'error'})
                        }
                    }
                });
            }
        })
    }

    function addImageToPreview(input, previewElementId = null, previewIndex = null) {
        console.log(input)
        console.log(previewElementId)
        console.log(previewIndex)
        if (input.files && input.files[0]) {
            let reader = new FileReader();

            reader.onload = function(e) {
                if (previewIndex == null) {
                    $('#' + previewElementId).attr('src', e.target.result);
                } else {
                    $('#' + previewElementId + previewIndex).attr('src', e.target.result);
                }
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    function addFileToPreview(input, previewElementId = null, previewIndex = null) {
        if (input.files && input.files[0]) {

        }
    }
</script>

@yield('pageScript')

</body>

</html>
