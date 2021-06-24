@extends('admin.layouts.app')

@php
    $pageTitle = __('constant.dashboard');
@endphp

@section('content')
    <div class="kt-portlet">
        <div class="kt-portlet__body  kt-portlet__body--fit">
            <div class="row row-no-padding row-col-separator-xl">

{{--                <div class="col-md-12 col-lg-6 col-xl-3">--}}
{{--                    <div class="kt-widget24">--}}
{{--                        <div class="kt-widget24__details">--}}
{{--                            <div class="kt-widget24__info">--}}
{{--                                <h4 class="kt-widget24__title">{{ __('text.dashboard.sales') }}</h4>--}}
{{--                            </div>--}}
{{--                            <span class="kt-widget24__stats kt-font-success">1.345 ₺</span>--}}
{{--                        </div>--}}

{{--                        <div class="progress progress--sm">--}}
{{--                            <div class="progress-bar kt-bg-success" role="progressbar" style="width: 60%;" aria-valuenow="1000" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                        </div>--}}
{{--                        <div class="kt-widget24__action">--}}
{{--                            <span class="kt-widget24__change">{{ __('text.dashboard.daily') }}</span>--}}
{{--                            <span class="kt-widget24__number">1000 ₺</span>--}}
{{--                        </div>--}}

{{--                        <div class="progress progress--sm">--}}
{{--                            <div class="progress-bar kt-bg-success" role="progressbar" style="width: 40%;" aria-valuenow="1000" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                        </div>--}}
{{--                        <div class="kt-widget24__action">--}}
{{--                            <span class="kt-widget24__change">{{ __('text.dashboard.monthly') }}</span>--}}
{{--                            <span class="kt-widget24__number">1000 ₺</span>--}}
{{--                        </div>--}}

{{--                        <div class="progress progress--sm">--}}
{{--                            <div class="progress-bar kt-bg-success" role="progressbar" style="width: 70%;" aria-valuenow="1000" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                        </div>--}}
{{--                        <div class="kt-widget24__action">--}}
{{--                            <span class="kt-widget24__change">{{ __('text.dashboard.yearly') }}</span>--}}
{{--                            <span class="kt-widget24__number">1000 ₺</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-md-12 col-lg-6 col-xl-3">--}}
{{--                    <div class="kt-widget24">--}}
{{--                        <div class="kt-widget24__details">--}}
{{--                            <div class="kt-widget24__info">--}}
{{--                                <h4 class="kt-widget24__title">{{ __('text.dashboard.order') }}</h4>--}}
{{--                            </div>--}}
{{--                            <span class="kt-widget24__stats kt-font-warning">345</span>--}}
{{--                        </div>--}}

{{--                        <div class="progress progress--sm">--}}
{{--                            <div class="progress-bar kt-bg-warning" role="progressbar" style="width: 60%;" aria-valuenow="1000" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                        </div>--}}
{{--                        <div class="kt-widget24__action">--}}
{{--                            <span class="kt-widget24__change">{{ __('text.dashboard.daily') }}</span>--}}
{{--                            <span class="kt-widget24__number">1000</span>--}}
{{--                        </div>--}}

{{--                        <div class="progress progress--sm">--}}
{{--                            <div class="progress-bar kt-bg-warning" role="progressbar" style="width: 40%;" aria-valuenow="1000" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                        </div>--}}
{{--                        <div class="kt-widget24__action">--}}
{{--                            <span class="kt-widget24__change">{{ __('text.dashboard.monthly') }}</span>--}}
{{--                            <span class="kt-widget24__number">1000</span>--}}
{{--                        </div>--}}

{{--                        <div class="progress progress--sm">--}}
{{--                            <div class="progress-bar kt-bg-warning" role="progressbar" style="width: 70%;" aria-valuenow="1000" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                        </div>--}}
{{--                        <div class="kt-widget24__action">--}}
{{--                            <span class="kt-widget24__change">{{ __('text.dashboard.yearly') }}</span>--}}
{{--                            <span class="kt-widget24__number">1000</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-md-12 col-lg-6 col-xl-3">--}}
{{--                    <div class="kt-widget24">--}}
{{--                        <div class="kt-widget24__details">--}}
{{--                            <div class="kt-widget24__info">--}}
{{--                                <h4 class="kt-widget24__title">{{ __('text.dashboard.user') }}</h4>--}}
{{--                            </div>--}}
{{--                            <span class="kt-widget24__stats kt-font-danger">236</span>--}}
{{--                        </div>--}}

{{--                        <div class="progress progress--sm">--}}
{{--                            <div class="progress-bar kt-bg-danger" role="progressbar" style="width: 60%;" aria-valuenow="1000" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                        </div>--}}
{{--                        <div class="kt-widget24__action">--}}
{{--                            <span class="kt-widget24__change">{{ __('text.dashboard.daily') }}</span>--}}
{{--                            <span class="kt-widget24__number">1000 </span>--}}
{{--                        </div>--}}

{{--                        <div class="progress progress--sm">--}}
{{--                            <div class="progress-bar kt-bg-danger" role="progressbar" style="width: 40%;" aria-valuenow="1000" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                        </div>--}}
{{--                        <div class="kt-widget24__action">--}}
{{--                            <span class="kt-widget24__change">{{ __('text.dashboard.monthly') }}</span>--}}
{{--                            <span class="kt-widget24__number">1000 </span>--}}
{{--                        </div>--}}

{{--                        <div class="progress progress--sm">--}}
{{--                            <div class="progress-bar kt-bg-danger" role="progressbar" style="width: 70%;" aria-valuenow="1000" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                        </div>--}}
{{--                        <div class="kt-widget24__action">--}}
{{--                            <span class="kt-widget24__change">{{ __('text.dashboard.yearly') }}</span>--}}
{{--                            <span class="kt-widget24__number">1000 </span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-md-12 col-lg-6 col-xl-3">--}}
{{--                    <div class="kt-widget24">--}}
{{--                        <div class="kt-widget24__details">--}}
{{--                            <div class="kt-widget24__info">--}}
{{--                                <h4 class="kt-widget24__title">{{ __('text.dashboard.product') }}</h4>--}}
{{--                            </div>--}}
{{--                            <span class="kt-widget24__stats kt-font-brand">345</span>--}}
{{--                        </div>--}}

{{--                        <div class="progress progress--sm">--}}
{{--                            <div class="progress-bar kt-bg-brand" role="progressbar" style="width: 60%;" aria-valuenow="1000" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                        </div>--}}
{{--                        <div class="kt-widget24__action">--}}
{{--                            <span class="kt-widget24__change">{{ __('text.dashboard.daily') }}</span>--}}
{{--                            <span class="kt-widget24__number">1000 </span>--}}
{{--                        </div>--}}

{{--                        <div class="progress progress--sm">--}}
{{--                            <div class="progress-bar kt-bg-brand" role="progressbar" style="width: 40%;" aria-valuenow="1000" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                        </div>--}}
{{--                        <div class="kt-widget24__action">--}}
{{--                            <span class="kt-widget24__change">{{ __('text.dashboard.monthly') }}</span>--}}
{{--                            <span class="kt-widget24__number">1000 </span>--}}
{{--                        </div>--}}

{{--                        <div class="progress progress--sm">--}}
{{--                            <div class="progress-bar kt-bg-brand" role="progressbar" style="width: 70%;" aria-valuenow="1000" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                        </div>--}}
{{--                        <div class="kt-widget24__action">--}}
{{--                            <span class="kt-widget24__change">{{ __('text.dashboard.yearly') }}</span>--}}
{{--                            <span class="kt-widget24__number">1000 </span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

            </div>
        </div>
    </div>

{{--    <div class="row">--}}
{{--        <div class="col-xl-8">--}}
{{--            <!--begin:: Widgets/Order Statistics-->--}}
{{--            <div class="kt-portlet kt-portlet--height-fluid">--}}
{{--                <div class="kt-portlet__head">--}}
{{--                    <div class="kt-portlet__head-label">--}}
{{--                        <h3 class="kt-portlet__head-title">{{ __('text.dashboard.order_statistic') }}</h3>--}}
{{--                    </div>--}}
{{--                    <div class="kt-portlet__head-toolbar">--}}
{{--                        <a href="#" class="btn btn-label-brand btn-bold btn-sm dropdown-toggle" data-toggle="dropdown">--}}
{{--                            <i class="fa fa-print"></i>{{ __('text.dashboard.print') }}--}}
{{--                        </a>--}}
{{--                        <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">--}}
{{--                            <ul class="kt-nav">--}}
{{--                                <li class="kt-nav__head">--}}
{{--                                    {{ __('text.dashboard.print_options') }}--}}
{{--                                    <span data-toggle="kt-tooltip" data-placement="right">--}}
{{--                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"--}}
{{--                                             class="kt-svg-icon kt-svg-icon--brand kt-svg-icon--md1">--}}
{{--                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
{{--                                                <rect id="bound" x="0" y="0" width="24" height="24"/>--}}
{{--                                                <circle id="Oval-5" fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>--}}
{{--                                                <rect id="Rectangle-9" fill="#000000" x="11" y="10" width="2" height="7" rx="1"/>--}}
{{--                                                <rect id="Rectangle-9-Copy" fill="#000000" x="11" y="7" width="2" height="2" rx="1"/>--}}
{{--                                            </g>--}}
{{--                                        </svg>--}}
{{--                                    </span>--}}
{{--                                </li>--}}
{{--                                <li class="kt-nav__separator"></li>--}}
{{--                                <li class="kt-nav__item">--}}
{{--                                    <a href="javascript:;" class="kt-nav__link">--}}
{{--                                        <i class="kt-nav__link-icon fa fa-calendar-day"></i><span class="kt-nav__link-text">{{ __('text.dashboard.daily') }}</span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="kt-nav__item">--}}
{{--                                    <a href="javascript:;" class="kt-nav__link">--}}
{{--                                        <i class="kt-nav__link-icon fa fa-calendar-week"></i><span class="kt-nav__link-text">{{ __('text.dashboard.weekly') }}</span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="kt-nav__item">--}}
{{--                                    <a href="javascript:;" class="kt-nav__link">--}}
{{--                                        <i class="kt-nav__link-icon fa fa-calendar"></i><span class="kt-nav__link-text">{{ __('text.dashboard.monthly') }}</span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="kt-nav__item">--}}
{{--                                    <a href="javascript:;" class="kt-nav__link">--}}
{{--                                        <i class="kt-nav__link-icon fa fa-calendar-plus"></i><span class="kt-nav__link-text">{{ __('text.dashboard.yearly') }}</span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="kt-portlet__body kt-portlet__body--fluid">--}}
{{--                    <div class="kt-widget12">--}}
{{--                        <div class="kt-widget12__content">--}}
{{--                            <div class="kt-widget12__item">--}}
{{--                                <div class="kt-widget12__info">--}}
{{--                                    <span class="kt-widget12__desc">Annual Taxes EMS</span>--}}
{{--                                    <span class="kt-widget12__value">$400,000</span>--}}
{{--                                </div>--}}

{{--                                <div class="kt-widget12__info">--}}
{{--                                    <span class="kt-widget12__desc">Finance Review Date</span>--}}
{{--                                    <span class="kt-widget12__value">July 24,2019</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="kt-widget12__item">--}}
{{--                                <div class="kt-widget12__info">--}}
{{--                                    <span class="kt-widget12__desc">Avarage Revenue</span>--}}
{{--                                    <span class="kt-widget12__value">$60M</span>--}}
{{--                                </div>--}}
{{--                                <div class="kt-widget12__info">--}}
{{--                                    <span class="kt-widget12__desc">Revenue Margin</span>--}}
{{--                                    <div class="kt-widget12__progress">--}}
{{--                                        <div class="progress kt-progress--sm">--}}
{{--                                            <div class="progress-bar kt-bg-brand" role="progressbar"--}}
{{--                                                 style="width: 40%;" aria-valuenow="100"--}}
{{--                                                 aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                        </div>--}}
{{--                                        <span class="kt-widget12__stat">--}}
{{--                                    40%--}}
{{--                                </span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="kt-widget12__chart" style="height:250px;"><canvas id="kt_chart_order_statistics"></canvas>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!--end:: Widgets/Order Statistics-->--}}
{{--        </div>--}}
{{--        <div class="col-xl-4 col-lg-6 order-lg-1 order-xl-1">--}}
{{--            <!--begin:: Widgets/Audit Log-->--}}
{{--            <div class="kt-portlet kt-portlet--height-fluid">--}}
{{--                <div class="kt-portlet__head">--}}
{{--                    <div class="kt-portlet__head-label">--}}
{{--                        <h3 class="kt-portlet__head-title">{{ __('text.dashboard.latest_activity') }}</h3>--}}
{{--                    </div>--}}
{{--                    <div class="kt-portlet__head-toolbar">--}}
{{--                        <ul class="nav nav-pills nav-pills-sm nav-pills-label nav-pills-bold"--}}
{{--                            role="tablist">--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link active" data-toggle="tab" href="#kt_widget4_tab11_content" role="tab">{{ __('text.dashboard.daily') }}</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" data-toggle="tab" href="#kt_widget4_tab12_content" role="tab">{{ __('text.dashboard.weekly') }}</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" data-toggle="tab" href="#kt_widget4_tab13_content" role="tab">{{ __('text.dashboard.monthly') }}</a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="kt-portlet__body">--}}
{{--                    <div class="tab-content">--}}
{{--                        <div class="tab-pane active" id="kt_widget4_tab11_content">--}}
{{--                            <div class="kt-scroll" data-scroll="true" data-height="400"--}}
{{--                                 style="height: 400px;">--}}
{{--                                <div class="kt-list-timeline">--}}
{{--                                    <div class="kt-list-timeline__items">--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--success"></span>--}}
{{--                                            <span--}}
{{--                                                class="kt-list-timeline__text">12 new users registered</span>--}}
{{--                                            <span class="kt-list-timeline__time">Just now</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--info"></span>--}}
{{--                                            <span class="kt-list-timeline__text">System shutdown <span--}}
{{--                                                    class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill">pending</span></span>--}}
{{--                                            <span class="kt-list-timeline__time">14 mins</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--danger"></span>--}}
{{--                                            <span--}}
{{--                                                class="kt-list-timeline__text">New invoice received</span>--}}
{{--                                            <span class="kt-list-timeline__time">20 mins</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--success"></span>--}}
{{--                                            <span class="kt-list-timeline__text">DB overloaded 80% <span--}}
{{--                                                    class="kt-badge kt-badge--info kt-badge--inline kt-badge--pill">settled</span></span>--}}
{{--                                            <span class="kt-list-timeline__time">1 hr</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--warning"></span>--}}
{{--                                            <span class="kt-list-timeline__text">System error - <a--}}
{{--                                                    href="#" class="kt-link">Check</a></span>--}}
{{--                                            <span class="kt-list-timeline__time">2 hrs</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--brand"></span>--}}
{{--                                            <span--}}
{{--                                                class="kt-list-timeline__text">Production server down</span>--}}
{{--                                            <span class="kt-list-timeline__time">3 hrs</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--info"></span>--}}
{{--                                            <span--}}
{{--                                                class="kt-list-timeline__text">Production server up</span>--}}
{{--                                            <span class="kt-list-timeline__time">5 hrs</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--success"></span>--}}
{{--                                            <span href="" class="kt-list-timeline__text">New order received <span--}}
{{--                                                    class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill">urgent</span></span>--}}
{{--                                            <span class="kt-list-timeline__time">7 hrs</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--success"></span>--}}
{{--                                            <span--}}
{{--                                                class="kt-list-timeline__text">12 new users registered</span>--}}
{{--                                            <span class="kt-list-timeline__time">Just now</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--info"></span>--}}
{{--                                            <span class="kt-list-timeline__text">System shutdown <span--}}
{{--                                                    class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill">pending</span></span>--}}
{{--                                            <span class="kt-list-timeline__time">14 mins</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--danger"></span>--}}
{{--                                            <span--}}
{{--                                                class="kt-list-timeline__text">New invoice received</span>--}}
{{--                                            <span class="kt-list-timeline__time">20 mins</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--success"></span>--}}
{{--                                            <span class="kt-list-timeline__text">DB overloaded 80% <span--}}
{{--                                                    class="kt-badge kt-badge--info kt-badge--inline kt-badge--pill">settled</span></span>--}}
{{--                                            <span class="kt-list-timeline__time">1 hr</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--danger"></span>--}}
{{--                                            <span--}}
{{--                                                class="kt-list-timeline__text">New invoice received</span>--}}
{{--                                            <span class="kt-list-timeline__time">20 mins</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--success"></span>--}}
{{--                                            <span class="kt-list-timeline__text">DB overloaded 80% <span--}}
{{--                                                    class="kt-badge kt-badge--info kt-badge--inline kt-badge--pill">settled</span></span>--}}
{{--                                            <span class="kt-list-timeline__time">1 hr</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--warning"></span>--}}
{{--                                            <span class="kt-list-timeline__text">System error - <a--}}
{{--                                                    href="#" class="kt-link">Check</a></span>--}}
{{--                                            <span class="kt-list-timeline__time">2 hrs</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--brand"></span>--}}
{{--                                            <span--}}
{{--                                                class="kt-list-timeline__text">Production server down</span>--}}
{{--                                            <span class="kt-list-timeline__time">3 hrs</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--info"></span>--}}
{{--                                            <span--}}
{{--                                                class="kt-list-timeline__text">Production server up</span>--}}
{{--                                            <span class="kt-list-timeline__time">5 hrs</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--success"></span>--}}
{{--                                            <span href="" class="kt-list-timeline__text">New order received <span--}}
{{--                                                    class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill">urgent</span></span>--}}
{{--                                            <span class="kt-list-timeline__time">7 hrs</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="tab-pane" id="kt_widget4_tab12_content">--}}
{{--                            <div class="kt-scroll" data-scroll="true" data-height="400"--}}
{{--                                 style="height: 400px;">--}}
{{--                                <div class="kt-list-timeline">--}}
{{--                                    <div class="kt-list-timeline__items">--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--danger"></span>--}}
{{--                                            <span--}}
{{--                                                class="kt-list-timeline__text">New invoice received</span>--}}
{{--                                            <span class="kt-list-timeline__time">20 mins</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--success"></span>--}}
{{--                                            <span class="kt-list-timeline__text">DB overloaded 80% <span--}}
{{--                                                    class="kt-badge kt-badge--info kt-badge--inline kt-badge--pill">settled</span></span>--}}
{{--                                            <span class="kt-list-timeline__time">1 hr</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--danger"></span>--}}
{{--                                            <span--}}
{{--                                                class="kt-list-timeline__text">New invoice received</span>--}}
{{--                                            <span class="kt-list-timeline__time">20 mins</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--success"></span>--}}
{{--                                            <span--}}
{{--                                                class="kt-list-timeline__text">12 new users registered</span>--}}
{{--                                            <span class="kt-list-timeline__time">Just now</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--info"></span>--}}
{{--                                            <span class="kt-list-timeline__text">System shutdown <span--}}
{{--                                                    class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill">pending</span></span>--}}
{{--                                            <span class="kt-list-timeline__time">14 mins</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--danger"></span>--}}
{{--                                            <span--}}
{{--                                                class="kt-list-timeline__text">New invoice received</span>--}}
{{--                                            <span class="kt-list-timeline__time">20 mins</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--success"></span>--}}
{{--                                            <span class="kt-list-timeline__text">DB overloaded 80% <span--}}
{{--                                                    class="kt-badge kt-badge--info kt-badge--inline kt-badge--pill">settled</span></span>--}}
{{--                                            <span class="kt-list-timeline__time">1 hr</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--warning"></span>--}}
{{--                                            <span class="kt-list-timeline__text">System error - <a--}}
{{--                                                    href="#" class="kt-link">Check</a></span>--}}
{{--                                            <span class="kt-list-timeline__time">2 hrs</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--success"></span>--}}
{{--                                            <span class="kt-list-timeline__text">DB overloaded 80% <span--}}
{{--                                                    class="kt-badge kt-badge--info kt-badge--inline kt-badge--pill">settled</span></span>--}}
{{--                                            <span class="kt-list-timeline__time">1 hr</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--danger"></span>--}}
{{--                                            <span--}}
{{--                                                class="kt-list-timeline__text">New invoice received</span>--}}
{{--                                            <span class="kt-list-timeline__time">20 mins</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--success"></span>--}}
{{--                                            <span class="kt-list-timeline__text">DB overloaded 80% <span--}}
{{--                                                    class="kt-badge kt-badge--info kt-badge--inline kt-badge--pill">settled</span></span>--}}
{{--                                            <span class="kt-list-timeline__time">1 hr</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--warning"></span>--}}
{{--                                            <span class="kt-list-timeline__text">System error - <a--}}
{{--                                                    href="#" class="kt-link">Check</a></span>--}}
{{--                                            <span class="kt-list-timeline__time">2 hrs</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--brand"></span>--}}
{{--                                            <span--}}
{{--                                                class="kt-list-timeline__text">Production server down</span>--}}
{{--                                            <span class="kt-list-timeline__time">3 hrs</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--info"></span>--}}
{{--                                            <span--}}
{{--                                                class="kt-list-timeline__text">Production server up</span>--}}
{{--                                            <span class="kt-list-timeline__time">5 hrs</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--success"></span>--}}
{{--                                            <span href="" class="kt-list-timeline__text">New order received <span--}}
{{--                                                    class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill">urgent</span></span>--}}
{{--                                            <span class="kt-list-timeline__time">7 hrs</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="tab-pane" id="kt_widget4_tab13_content">--}}
{{--                            <div class="kt-scroll" data-scroll="true" data-height="400"--}}
{{--                                 style="height: 400px;">--}}
{{--                                <div class="kt-list-timeline">--}}
{{--                                    <div class="kt-list-timeline__items">--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--success"></span>--}}
{{--                                            <span href="" class="kt-list-timeline__text">New order received <span--}}
{{--                                                    class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill">urgent</span></span>--}}
{{--                                            <span class="kt-list-timeline__time">7 hrs</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--brand"></span>--}}
{{--                                            <span--}}
{{--                                                class="kt-list-timeline__text">New invoice received</span>--}}
{{--                                            <span class="kt-list-timeline__time">20 mins</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--info"></span>--}}
{{--                                            <span class="kt-list-timeline__text">DB overloaded 80% <span--}}
{{--                                                    class="kt-badge kt-badge--info kt-badge--inline kt-badge--pill">settled</span></span>--}}
{{--                                            <span class="kt-list-timeline__time">1 hr</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--danger"></span>--}}
{{--                                            <span--}}
{{--                                                class="kt-list-timeline__text">New invoice received</span>--}}
{{--                                            <span class="kt-list-timeline__time">20 mins</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--success"></span>--}}
{{--                                            <span--}}
{{--                                                class="kt-list-timeline__text">12 new users registered</span>--}}
{{--                                            <span class="kt-list-timeline__time">Just now</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--info"></span>--}}
{{--                                            <span class="kt-list-timeline__text">System shutdown <span--}}
{{--                                                    class="kt-badge kt-badge--warning kt-badge--inline kt-badge--pill">pending</span></span>--}}
{{--                                            <span class="kt-list-timeline__time">14 mins</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--danger"></span>--}}
{{--                                            <span--}}
{{--                                                class="kt-list-timeline__text">New invoice received</span>--}}
{{--                                            <span class="kt-list-timeline__time">20 mins</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--success"></span>--}}
{{--                                            <span class="kt-list-timeline__text">DB overloaded 80% <span--}}
{{--                                                    class="kt-badge kt-badge--info kt-badge--inline kt-badge--pill">settled</span></span>--}}
{{--                                            <span class="kt-list-timeline__time">1 hr</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--warning"></span>--}}
{{--                                            <span class="kt-list-timeline__text">System error - <a--}}
{{--                                                    href="#" class="kt-link">Check</a></span>--}}
{{--                                            <span class="kt-list-timeline__time">2 hrs</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--success"></span>--}}
{{--                                            <span class="kt-list-timeline__text">DB overloaded 80% <span--}}
{{--                                                    class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill">settled</span></span>--}}
{{--                                            <span class="kt-list-timeline__time">1 hr</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--danger"></span>--}}
{{--                                            <span--}}
{{--                                                class="kt-list-timeline__text">New invoice received</span>--}}
{{--                                            <span class="kt-list-timeline__time">20 mins</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--success"></span>--}}
{{--                                            <span class="kt-list-timeline__text">DB overloaded 80% <span--}}
{{--                                                    class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill">settled</span></span>--}}
{{--                                            <span class="kt-list-timeline__time">1 hr</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--warning"></span>--}}
{{--                                            <span class="kt-list-timeline__text">System error - <a--}}
{{--                                                    href="#" class="kt-link">Check</a></span>--}}
{{--                                            <span class="kt-list-timeline__time">2 hrs</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--brand"></span>--}}
{{--                                            <span--}}
{{--                                                class="kt-list-timeline__text">Production server down</span>--}}
{{--                                            <span class="kt-list-timeline__time">3 hrs</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-list-timeline__item">--}}
{{--                                                                <span--}}
{{--                                                                    class="kt-list-timeline__badge kt-list-timeline__badge--info"></span>--}}
{{--                                            <span--}}
{{--                                                class="kt-list-timeline__text">Production server up</span>--}}
{{--                                            <span class="kt-list-timeline__time">5 hrs</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!--end:: Widgets/Audit Log-->  </div>--}}
{{--    </div>--}}
@stop
