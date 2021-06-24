<header class="site-header mo-left header header-transparent navstyle2">
    <!-- main header -->
    <div class="sticky-header main-bar-wraper navbar-expand-lg">
        <div class="main-bar clearfix ">
            <div class="container clearfix">
                <!-- website logo -->
                <div class="logo-header mostion logo-white">
                    <a href="{{ route('web.index') }}"><img src="{{ asset('web/steel/images/logo.svg') }}" alt=""></a>
                </div>
                <!-- nav toggle button -->
                <button class="navbar-toggler collapsed navicon justify-content-end" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <!-- extra nav -->
                <div class="extra-nav">
                    <div class="extra-cell">
                        <button id="quik-search-btn" type="button" class="site-button-link"><i class="la la-search"></i></button>
                    </div>
                </div>
                <!-- Quik search -->
                <div class="dlab-quik-search ">
                    <form action="#">
                        <input name="search" value="" type="text" class="form-control" placeholder="Type to search">
                        <span id="quik-search-remove"><i class="ti-close"></i></span>
                    </form>
                </div>
                <!-- main nav -->
                <div class="header-nav navbar-collapse collapse justify-content-end" id="navbarNavDropdown">
                    <div class="logo-header d-md-block d-lg-none">
                        <a href="{{ route('web.index') }}"><img src="{{ asset('web/steel/images/logo.svg') }}" alt=""></a>
                    </div>

                    @include('web.steel.layouts.inc.components.menu.header', ['menus' => $headerMenus])

                    <div class="dlab-social-icon">
                        <ul>
                            <li><a class="site-button sharp-sm fa fa-facebook" href="javascript:void(0);"></a></li>
                            <li><a class="site-button sharp-sm fa fa-twitter" href="javascript:void(0);"></a></li>
                            <li><a class="site-button sharp-sm fa fa-linkedin" href="javascript:void(0);"></a></li>
                            <li><a class="site-button sharp-sm fa fa-instagram" href="javascript:void(0);"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- main header END -->
</header>
