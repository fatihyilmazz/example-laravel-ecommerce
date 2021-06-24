<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>

<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">
    <div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
        <div class="kt-aside__brand-logo">
            <a href="{{ route('admin.index') }}">
                <img alt="Logo" src="{{ asset('admin/assets/media/logos/logo-light.png') }}"/>
            </a>
        </div>

        <div class="kt-aside__brand-tools">
            <button class="kt-aside__brand-aside-toggler" id="kt_aside_toggler">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon id="Shape" points="0 0 24 0 24 24 0 24"/>
                            <path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896
                            C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908
                            5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" id="Path-94" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999) "/>
                            <path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322
                            C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465
                            21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" id="Path-94" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1)
                            rotate(-270.000000) translate(-15.999997, -11.999999) "/>
                        </g>
                    </svg>
                </span>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon id="Shape" points="0 0 24 0 24 24 0 24"/>
                            <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896
                            C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908
                            12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" id="Path-94" fill="#000000" fill-rule="nonzero"/>
                            <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322
                            C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465
                            14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" id="Path-94" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000)
                            translate(-9.000003, -11.999999) "/>
                        </g>
                    </svg>
                </span>
            </button>
        </div>
    </div>
    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
        <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">
            <ul class="kt-menu__nav">
                <li class="kt-menu__item {{ Request::routeIs('admin.index') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                    <a href="{{ route('admin.index') }}" class="kt-menu__link ">
                        <span class="kt-menu__link-icon">
                            <i class="fa fa fa-home"></i>
                        </span>
                        <span class="kt-menu__link-text">{{ __('text.dashboard.name') }}</span>
                    </a>
                </li>

                @isModuleActive([\App\Module::ID_PRODUCT_MANAGEMENT], $moduleIds)
                    <li class="kt-menu__item kt-menu__item--submenu
                        {{ Request::routeIs([
                            'admin.products.index', 'admin.products.create', 'admin.products.edit', 'admin.products.histories',
                            'admin.brands.index', 'admin.brands.create', 'admin.brands.edit', 'admin.brands.histories',
                            'admin.categories.index', 'admin.categories.create', 'admin.categories.edit', 'admin.categories.histories',
                        ]) ? 'kt-menu__item--open kt-menu__item--here' : '' }}"
                        aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                            <span class="kt-menu__link-icon">
                                <i class="fa fa-cubes"></i>
                            </span>
                            <span class="kt-menu__link-text">{{ __('text.product.management') }}</span>
                            <i class="kt-menu__ver-arrow la la-angle-right"></i>
                        </a>
                        <div class="kt-menu__submenu " kt-hidden-height="200">
                            <span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">
                                <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true">
                                    <span class="kt-menu__link">
                                        <span class="kt-menu__link-text">{{ __('text.product.management') }}</span>
                                    </span>
                                </li>
                                @isModuleActive([\App\Module::ID_PRODUCT_MANAGEMENT], $moduleIds)
                                    @canany(['list-products', 'create-products', 'view-products', 'update-products', 'delete-products'])
                                        <li class="kt-menu__item {{ Request::routeIs(['admin.products.index', 'admin.products.create', 'admin.products.edit', 'admin.products.histories']) ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                            <a href="{{ route("admin.products.index") }}" class="kt-menu__link ">
                                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                                <span class="kt-menu__link-text">{{ __('text.product.name_plural') }}</span>
                                            </a>
                                        </li>
                                    @endcanany
                                @endisModuleActive()

                                @isModuleActive([\App\Module::ID_BRAND_MANAGEMENT], $moduleIds)
                                    @canany(['list-brands', 'create-brands', 'view-brands', 'update-brands', 'delete-brands'])
                                        <li class="kt-menu__item {{ Request::routeIs(['admin.brands.index', 'admin.brands.create', 'admin.brands.edit', 'admin.brands.histories']) ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                            <a href="{{ route("admin.brands.index") }}" class="kt-menu__link ">
                                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                                <span class="kt-menu__link-text">{{ __('text.brand.name_plural') }}</span>
                                            </a>
                                        </li>
                                    @endcanany
                                @endisModuleActive()

                                @isModuleActive([\App\Module::ID_CATEGORY_MANAGEMENT], $moduleIds)
                                    @canany(['list-categories', 'create-categories', 'view-categories', 'update-categories', 'delete-categories'])
                                        <li class="kt-menu__item {{ Request::routeIs(['admin.categories.index', 'admin.categories.create', 'admin.categories.edit', 'admin.categories.histories']) ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                            <a href="{{ route("admin.categories.index") }}" class="kt-menu__link ">
                                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                                <span class="kt-menu__link-text">{{ __('text.category.name_plural') }}</span>
                                            </a>
                                        </li>
                                    @endcanany
                                @endisModuleActive()
                            </ul>
                        </div>
                    </li>
                @endisModuleActive()

                @isModuleActive([\App\Module::ID_CONTENT_MANAGEMENT], $moduleIds)
                    <li class="kt-menu__item kt-menu__item--submenu
                        {{ Request::routeIs([
                            'admin.sliders.index', 'admin.sliders.create', 'admin.sliders.edit', 'admin.sliders.histories',
                            'admin.menus.index', 'admin.menus.create', 'admin.menus.edit', 'admin.menus.histories',
                            'admin.pages.index', 'admin.pages.create', 'admin.pages.edit', 'admin.pages.histories',
                        ]) ? 'kt-menu__item--open kt-menu__item--here' : '' }}"
                        aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                            <span class="kt-menu__link-icon">
                                <i class="fa fa-pager"></i>
                            </span>
                            <span class="kt-menu__link-text">{{ __('text.content.management') }}</span>
                            <i class="kt-menu__ver-arrow la la-angle-right"></i>
                        </a>
                        <div class="kt-menu__submenu " kt-hidden-height="200">
                            <span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">
                                <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true">
                                    <span class="kt-menu__link">
                                        <span class="kt-menu__link-text">{{ __('text.content.management') }}</span>
                                    </span>
                                </li>
                                @isModuleActive([\App\Module::ID_SLIDER_MANAGEMENT], $moduleIds)
                                    @canany(['list-sliders', 'create-sliders', 'view-sliders', 'update-sliders', 'delete-sliders'])
                                        <li class="kt-menu__item {{ Request::routeIs(['admin.sliders.index', 'admin.sliders.create', 'admin.sliders.edit', 'admin.sliders.histories']) ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                            <a href="{{ route("admin.sliders.index") }}" class="kt-menu__link ">
                                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                                <span class="kt-menu__link-text">{{ __('text.slider.name_plural') }}</span>
                                            </a>
                                        </li>
                                    @endcanany
                                @endisModuleActive()

                                @isModuleActive([\App\Module::ID_PAGE_MANAGEMENT], $moduleIds)
                                    @canany(['list-pages', 'create-pages', 'view-pages', 'update-pages', 'delete-pages'])
                                        <li class="kt-menu__item {{ Request::routeIs(['admin.pages.index', 'admin.pages.create', 'admin.pages.edit', 'admin.pages.histories']) ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                            <a href="{{ route("admin.pages.index") }}" class="kt-menu__link ">
                                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                                <span class="kt-menu__link-text">{{ __('text.page.name_plural') }}</span>
                                            </a>
                                        </li>
                                    @endcanany
                                @endisModuleActive()

                                @isModuleActive([\App\Module::ID_MENU_MANAGEMENT], $moduleIds)
                                    @canany(['list-menus', 'create-menus', 'view-menus', 'update-menus', 'delete-menus'])
                                        <li class="kt-menu__item {{ Request::routeIs(['admin.menus.index', 'admin.menus.create', 'admin.menus.edit', 'admin.menus.histories']) ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                            <a href="{{ route("admin.menus.index") }}" class="kt-menu__link ">
                                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                                <span class="kt-menu__link-text">{{ __('text.menu.name_plural') }}</span>
                                            </a>
                                        </li>
                                    @endcanany
                                @endisModuleActive()
                            </ul>
                        </div>
                    </li>
                @endisModuleActive()

                @isModuleActive([\App\Module::ID_USER_MANAGEMENT], $moduleIds )
                    <li class="kt-menu__item kt-menu__item--submenu
                        {{ Request::routeIs([
                            'admin.admins.index', 'admin.admins.create', 'admin.admins.edit', 'admin.admins.histories',
                            'admin.users.index', 'admin.users.create', 'admin.users.edit', 'admin.users.histories',
                            'admin.roles.index', 'admin.roles.create', 'admin.roles.edit'
                        ]) ? 'kt-menu__item--open kt-menu__item--here' : '' }}"
                        aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                            <span class="kt-menu__link-icon">
                                <i class="fa fa-users"></i>
                            </span>
                            <span class="kt-menu__link-text">{{ __('text.user.management') }}</span>
                            <i class="kt-menu__ver-arrow la la-angle-right"></i>
                        </a>
                        <div class="kt-menu__submenu " kt-hidden-height="200">
                            <span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">
                                <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true">
                                    <span class="kt-menu__link">
                                        <span class="kt-menu__link-text">{{ __('text.user.management') }}</span>
                                    </span>
                                </li>
                                @isModuleActive([\App\Module::ID_ADMIN_MANAGEMENT], $moduleIds )
                                    @canany(['list-admins', 'create-admins', 'view-admins', 'update-admins', 'delete-admins'])
                                        <li class="kt-menu__item {{ Request::routeIs(['admin.admins.index', 'admin.admins.create', 'admin.admins.edit', 'admin.admins.histories']) ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                            <a href="{{ route("admin.admins.index") }}" class="kt-menu__link ">
                                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                                <span class="kt-menu__link-text">{{ __('text.admin.name_plural') }}</span>
                                            </a>
                                        </li>
                                    @endcanany
                                @endisModuleActive()

                                @isModuleActive([\App\Module::ID_CUSTOMER_MANAGEMENT], $moduleIds )
                                    @canany(['list-users', 'create-users', 'view-users', 'update-users', 'delete-users'])
                                        <li class="kt-menu__item {{ Request::routeIs(['admin.users.index', 'admin.users.create', 'admin.users.edit', 'admin.users.histories']) ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                            <a href="{{ route("admin.users.index") }}" class="kt-menu__link ">
                                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                                <span class="kt-menu__link-text">{{ __('text.user.name_plural') }}</span>
                                            </a>
                                        </li>
                                    @endcanany
                                @endisModuleActive()

                                @isModuleActive([\App\Module::ID_CURRENCY_MANAGEMENT], $moduleIds)
                                    @canany(['list-roles', 'create-roles', 'view-roles', 'update-roles', 'delete-roles'])
                                        <li class="kt-menu__item {{ Request::routeIs(['admin.roles.index', 'admin.roles.create', 'admin.roles.edit', 'admin.roles.histories']) ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                            <a href="{{ route("admin.roles.index") }}" class="kt-menu__link ">
                                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                                <span class="kt-menu__link-text">{{ __('text.role.name_plural') }}</span>
                                            </a>
                                        </li>
                                    @endcanany
                                @endisModuleActive()
                            </ul>
                        </div>
                    </li>
                @endisModuleActive()

                @canany([
                    'list-general-configurations', 'update-general-configurations',
                    'list-tax-rates', 'create-tax-rates', 'view-tax-rates', 'update-tax-rates', 'delete-tax-rates',
                    'list-currencies', 'create-currencies', 'view-currencies', 'update-currencies', 'delete-currencies',
                    'list-locales', 'view-locales', 'update-locales',
                    'list-image-settings', 'update-image-settings',
                    'list-file-settings', 'update-file-settings',
                ])
                    <li class="kt-menu__item kt-menu__item--submenu
                    {{ Request::routeIs([
                       'admin.tax_rates.index', 'admin.tax_rates.create', 'admin.tax_rates.edit', 'admin.tax_rates.histories',
                       'admin.currencies.index', 'admin.currencies.create', 'admin.currencies.edit', 'admin.currencies.histories',
                       'admin.locales.index', 'admin.locales.edit',
                       'admin.configuration.general.index', 'admin.configuration.general.update',
                       'admin.setting.image.index', 'admin.setting.image.update',
                       'admin.setting.file.index', 'admin.setting.file.update',
                    ]) ? 'kt-menu__item--open kt-menu__item--here' : '' }}"
                        aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                        <span class="kt-menu__link-icon">
                            <i class="fa fa-cogs"></i>
                        </span>
                            <span class="kt-menu__link-text">{{ __('text.configuration.name') }}</span>
                            <i class="kt-menu__ver-arrow la la-angle-right"></i>
                        </a>
                        <div class="kt-menu__submenu " kt-hidden-height="200">
                            <span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">
                                <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true">
                                <span class="kt-menu__link">
                                    <span class="kt-menu__link-text">{{ __('text.configuration.name') }}</span>
                                </span>
                                </li>
                                @canany(['list-general-configurations', 'update-general-configurations'])
                                    <li class="kt-menu__item {{ Request::routeIs(['admin.configuration.general.index', 'admin.configuration.general.update']) ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                        <a href="{{ route("admin.configuration.general.index") }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">{{ __('text.configuration.general.name') }}</span>
                                        </a>
                                    </li>
                                @endcanany

                                @isModuleActive([\App\Module::ID_TAX_RATE_MANAGEMENT], $moduleIds)
                                    @canany(['list-tax-rates', 'create-tax-rates', 'view-tax-rates', 'update-tax-rates', 'delete-tax-rates'])
                                        <li class="kt-menu__item {{ Request::routeIs(['admin.tax_rates.index', 'admin.tax_rates.create', 'admin.tax_rates.edit', 'admin.tax_rates.histories']) ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                            <a href="{{ route("admin.tax_rates.index") }}" class="kt-menu__link ">
                                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                                <span class="kt-menu__link-text">{{ __('text.tax_rate.name_plural') }}</span>
                                            </a>
                                        </li>
                                    @endcanany
                                @endisModuleActive()

                                @isModuleActive([\App\Module::ID_CURRENCY_MANAGEMENT], $moduleIds)
                                    @canany(['list-currencies', 'create-currencies', 'view-currencies', 'update-currencies', 'delete-currencies'])
                                        <li class="kt-menu__item {{ Request::routeIs(['admin.currencies.index', 'admin.currencies.create', 'admin.currencies.edit', 'admin.currencies.histories']) ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                            <a href="{{ route("admin.currencies.index") }}" class="kt-menu__link ">
                                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                                <span class="kt-menu__link-text">{{ __('text.currency.name_plural') }}</span>
                                            </a>
                                        </li>
                                    @endcanany
                                @endisModuleActive()

                                @isModuleActive([\App\Module::ID_LOCALE_MANAGEMENT], $moduleIds)
                                    @canany(['list-locales', 'view-locales', 'update-locales'])
                                        <li class="kt-menu__item {{ Request::routeIs(['admin.locales.index', 'admin.locales.edit']) ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                            <a href="{{ route("admin.locales.index") }}" class="kt-menu__link ">
                                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                                <span class="kt-menu__link-text">{{ __('text.locale.management') }}</span>
                                            </a>
                                        </li>
                                    @endcanany
                                @endisModuleActive()

                                @canany(['list-image-settings', 'update-image-settings', 'list-file-settings', 'update-file-settings'])
                                    <li class="kt-menu__item kt-menu__item--submenu
                                    {{ Request::routeIs([
                                        'admin.setting.image.index', 'admin.setting.image.update',
                                        'list-file-settings', 'update-file-settings',
                                    ]) ? 'kt-menu__item--open kt-menu__item--here' : '' }}"
                                        aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">{{ __('text.setting.name_plural') }}</span>
                                            <i class="kt-menu__ver-arrow la la-angle-right"></i>
                                        </a>
                                        <div class="kt-menu__submenu " kt-hidden-height="120" style="">
                                            <span class="kt-menu__arrow"></span>
                                            <ul class="kt-menu__subnav">
                                                @canany(['list-image-settings', 'update-image-settings'])
                                                    <li class="kt-menu__item {{ Request::routeIs(['admin.setting.image.index', 'admin.setting.image.update']) ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                                        <a href="{{ route('admin.setting.image.index') }}" class="kt-menu__link ">
                                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                                            <span class="kt-menu__link-text">{{ __('text.setting.image') }}</span>
                                                        </a>
                                                    </li>
                                                @endcanany

                                                @canany(['list-file-settings', 'update-file-settings'])
                                                    <li class="kt-menu__item {{ Request::routeIs(['admin.setting.file.index', 'admin.setting.file.update']) ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                                        <a href="{{ route('admin.setting.file.index') }}" class="kt-menu__link ">
                                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                                            <span class="kt-menu__link-text">{{ __('text.setting.file') }}</span>
                                                        </a>
                                                    </li>
                                                @endcanany
                                            </ul>
                                        </div>
                                    </li>
                                @endcanany
                            </ul>
                        </div>
                    </li>
                @endcanany

                @role(\App\Admin::ROLE_NAME_SUPER_ADMIN)
                    <li class="kt-menu__item kt-menu__item--submenu
                        {{ Request::routeIs([

                        ]) ? 'kt-menu__item--open kt-menu__item--here' : '' }}"
                        aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                            <span class="kt-menu__link-icon">
                                <i class="fa fa-cogs"></i>
                            </span>
                            <span class="kt-menu__link-text">{{ __('text.super_admin_settings') }}</span>
                            <i class="kt-menu__ver-arrow la la-angle-right"></i>
                        </a>
                        <div class="kt-menu__submenu " kt-hidden-height="200">
                            <span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">
                                <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true">
                                    <span class="kt-menu__link">
                                        <span class="kt-menu__link-text">{{ __('text.super_admin_settings') }}</span>
                                    </span>
                                </li>
                                <li class="kt-menu__item {{ Request::routeIs(['admin.tax_rates.index', 'admin.tax_rates.create', 'admin.tax_rates.edit', 'admin.tax_rates.histories']) ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                    <a href="{{ route("admin.tax_rates.index") }}" class="kt-menu__link ">
                                        <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        <span class="kt-menu__link-text">{{ __('text.tax_rate.name_plural') }}</span>
                                    </a>
                                </li>

                                <li class="kt-menu__item kt-menu__item--submenu
                                    {{ Request::routeIs([

                                    ]) ? 'kt-menu__item--open kt-menu__item--here' : '' }}"
                                    aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                        <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        <span class="kt-menu__link-text">{{ __('text.setting.name_plural') }}</span>
                                        <i class="kt-menu__ver-arrow la la-angle-right"></i>
                                    </a>
                                    <div class="kt-menu__submenu " kt-hidden-height="120" style="">
                                        <span class="kt-menu__arrow"></span>
                                        <ul class="kt-menu__subnav">
                                            <li class="kt-menu__item " aria-haspopup="true">
                                                <a href="/" class="kt-menu__link ">
                                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                                    <span class="kt-menu__link-text">{{ __('text.suggestion_settings') }}</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endrole

{{--                @canany(['list-suppliers', 'create-suppliers', 'view-suppliers', 'update-suppliers', 'delete-suppliers'])--}}
{{--                    <li class="kt-menu__item kt-menu__item--submenu {{ Request::routeIs(['admin.suppliers.index', 'admin.suppliers.create', 'admin.suppliers.edit', 'admin.suppliers.histories']) ?--}}
{{--                        'kt-menu__item--open kt-menu__item--here' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">--}}
{{--                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">--}}
{{--                        <span class="kt-menu__link-icon">--}}
{{--                            <i class="fa fa-industry"></i>--}}
{{--                        </span>--}}
{{--                            <span class="kt-menu__link-text">{{ __('text.supplier.management') }}</span>--}}
{{--                            <i class="kt-menu__ver-arrow la la-angle-right"></i>--}}
{{--                        </a>--}}
{{--                        <div class="kt-menu__submenu " kt-hidden-height="200">--}}
{{--                            <span class="kt-menu__arrow"></span>--}}
{{--                            <ul class="kt-menu__subnav">--}}
{{--                                <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true">--}}
{{--                                <span class="kt-menu__link">--}}
{{--                                    <span class="kt-menu__link-text">{{ __('text.supplier.management') }}</span>--}}
{{--                                </span>--}}
{{--                                </li>--}}
{{--                                @canany(['list-suppliers','view-suppliers', 'update-suppliers', 'delete-suppliers'])--}}
{{--                                    <li class="kt-menu__item {{ Request::routeIs(['admin.suppliers.index', 'admin.suppliers.edit']) ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">--}}
{{--                                        <a href="{{ route("admin.suppliers.index") }}" class="kt-menu__link ">--}}
{{--                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>--}}
{{--                                            <span class="kt-menu__link-text">{{ __('text.supplier.all') }}</span>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                @endcanany--}}

{{--                                @canany(['create-suppliers'])--}}
{{--                                    <li class="kt-menu__item {{ Request::routeIs('admin.suppliers.create') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">--}}
{{--                                        <a href="{{ route('admin.suppliers.create') }}" class="kt-menu__link ">--}}
{{--                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>--}}
{{--                                            <span class="kt-menu__link-text">{{ __('text.supplier.create') }}</span>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                @endcanany--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </li>--}}
{{--                @endcanany--}}

{{--                @canany(['list-countries', 'create-countries', 'view-countries', 'update-countries', 'delete-countries'])--}}
{{--                    <li class="kt-menu__item kt-menu__item--submenu {{ Request::routeIs(['admin.countries.index', 'admin.countries.create', 'admin.countries.edit', 'admin.countries.histories']) ?--}}
{{--                        'kt-menu__item--open kt-menu__item--here' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">--}}
{{--                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">--}}
{{--                        <span class="kt-menu__link-icon">--}}
{{--                            <i class="fa fa-globe-americas"></i>--}}
{{--                        </span>--}}
{{--                            <span class="kt-menu__link-text">{{ __('text.country.management') }}</span>--}}
{{--                            <i class="kt-menu__ver-arrow la la-angle-right"></i>--}}
{{--                        </a>--}}
{{--                        <div class="kt-menu__submenu " kt-hidden-height="200">--}}
{{--                            <span class="kt-menu__arrow"></span>--}}
{{--                            <ul class="kt-menu__subnav">--}}
{{--                                <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true">--}}
{{--                                <span class="kt-menu__link">--}}
{{--                                    <span class="kt-menu__link-text">{{ __('text.country.management') }}</span>--}}
{{--                                </span>--}}
{{--                                </li>--}}
{{--                                @canany(['list-countries','view-countries', 'update-countries', 'delete-countries'])--}}
{{--                                    <li class="kt-menu__item {{ Request::routeIs(['admin.countries.index', 'admin.countries.edit']) ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">--}}
{{--                                        <a href="{{ route("admin.countries.index") }}" class="kt-menu__link ">--}}
{{--                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>--}}
{{--                                            <span class="kt-menu__link-text">{{ __('text.country.all') }}</span>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                @endcanany--}}

{{--                                @canany(['create-countries'])--}}
{{--                                    <li class="kt-menu__item {{ Request::routeIs('admin.countries.create') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">--}}
{{--                                        <a href="{{ route('admin.countries.create') }}" class="kt-menu__link ">--}}
{{--                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>--}}
{{--                                            <span class="kt-menu__link-text">{{ __('text.country.create') }}</span>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                @endcanany--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </li>--}}
{{--                @endcanany--}}

{{--                @canany(['list-provinces', 'create-provinces', 'view-provinces', 'update-provinces', 'delete-provinces'])--}}
{{--                    <li class="kt-menu__item kt-menu__item--submenu {{ Request::routeIs(['admin.provinces.index', 'admin.provinces.create', 'admin.provinces.edit', 'admin.provinces.histories']) ?--}}
{{--                        'kt-menu__item--open kt-menu__item--here' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">--}}
{{--                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">--}}
{{--                        <span class="kt-menu__link-icon">--}}
{{--                            <i class="fa fa-map-marked-alt"></i>--}}
{{--                        </span>--}}
{{--                            <span class="kt-menu__link-text">{{ __('text.province.management') }}</span>--}}
{{--                            <i class="kt-menu__ver-arrow la la-angle-right"></i>--}}
{{--                        </a>--}}
{{--                        <div class="kt-menu__submenu " kt-hidden-height="200">--}}
{{--                            <span class="kt-menu__arrow"></span>--}}
{{--                            <ul class="kt-menu__subnav">--}}
{{--                                <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true">--}}
{{--                                <span class="kt-menu__link">--}}
{{--                                    <span class="kt-menu__link-text">{{ __('text.province.management') }}</span>--}}
{{--                                </span>--}}
{{--                                </li>--}}
{{--                                @canany(['list-provinces','view-provinces', 'update-provinces', 'delete-provinces'])--}}
{{--                                    <li class="kt-menu__item {{ Request::routeIs(['admin.provinces.index', 'admin.provinces.edit']) ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">--}}
{{--                                        <a href="{{ route("admin.provinces.index") }}" class="kt-menu__link ">--}}
{{--                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>--}}
{{--                                            <span class="kt-menu__link-text">{{ __('text.province.all') }}</span>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                @endcanany--}}

{{--                                @canany(['create-provinces'])--}}
{{--                                    <li class="kt-menu__item {{ Request::routeIs('admin.provinces.create') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">--}}
{{--                                        <a href="{{ route('admin.provinces.create') }}" class="kt-menu__link ">--}}
{{--                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>--}}
{{--                                            <span class="kt-menu__link-text">{{ __('text.province.create') }}</span>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                @endcanany--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </li>--}}
{{--                @endcanany--}}

{{--                @canany(['list-districts', 'create-districts', 'view-districts', 'update-districts', 'delete-districts'])--}}
{{--                    <li class="kt-menu__item kt-menu__item--submenu {{ Request::routeIs(['admin.districts.index', 'admin.districts.create', 'admin.districts.edit', 'admin.districts.histories']) ?--}}
{{--                        'kt-menu__item--open kt-menu__item--here' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">--}}
{{--                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">--}}
{{--                        <span class="kt-menu__link-icon">--}}
{{--                            <i class="fa fa-map-marker-alt"></i>--}}
{{--                        </span>--}}
{{--                            <span class="kt-menu__link-text">{{ __('text.district.management') }}</span>--}}
{{--                            <i class="kt-menu__ver-arrow la la-angle-right"></i>--}}
{{--                        </a>--}}
{{--                        <div class="kt-menu__submenu " kt-hidden-height="200">--}}
{{--                            <span class="kt-menu__arrow"></span>--}}
{{--                            <ul class="kt-menu__subnav">--}}
{{--                                <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true">--}}
{{--                                <span class="kt-menu__link">--}}
{{--                                    <span class="kt-menu__link-text">{{ __('text.district.management') }}</span>--}}
{{--                                </span>--}}
{{--                                </li>--}}
{{--                                @canany(['list-districts','view-districts', 'update-districts', 'delete-districts'])--}}
{{--                                    <li class="kt-menu__item {{ Request::routeIs(['admin.districts.index', 'admin.districts.edit']) ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">--}}
{{--                                        <a href="{{ route("admin.districts.index") }}" class="kt-menu__link ">--}}
{{--                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>--}}
{{--                                            <span class="kt-menu__link-text">{{ __('text.district.all') }}</span>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                @endcanany--}}

{{--                                @canany(['create-districts'])--}}
{{--                                    <li class="kt-menu__item {{ Request::routeIs('admin.districts.create') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">--}}
{{--                                        <a href="{{ route('admin.districts.create') }}" class="kt-menu__link ">--}}
{{--                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>--}}
{{--                                            <span class="kt-menu__link-text">{{ __('text.district.create') }}</span>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                @endcanany--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </li>--}}
{{--                @endcanany--}}

{{--                @canany(['list-stock-units', 'create-stock-units', 'view-stock-units', 'update-stock-units', 'delete-stock-units'])--}}
{{--                    <li class="kt-menu__item kt-menu__item--submenu {{ Request::routeIs(['admin.stock_units.index', 'admin.stock_units.create', 'admin.stock_units.edit', 'admin.stock_units.histories']) ?--}}
{{--                        'kt-menu__item--open kt-menu__item--here' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">--}}
{{--                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">--}}
{{--                        <span class="kt-menu__link-icon">--}}
{{--                            <i class="fa fa-boxes"></i>--}}
{{--                        </span>--}}
{{--                            <span class="kt-menu__link-text">{{ __('text.stock_unit.management') }}</span>--}}
{{--                            <i class="kt-menu__ver-arrow la la-angle-right"></i>--}}
{{--                        </a>--}}
{{--                        <div class="kt-menu__submenu " kt-hidden-height="200">--}}
{{--                            <span class="kt-menu__arrow"></span>--}}
{{--                            <ul class="kt-menu__subnav">--}}
{{--                                <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true">--}}
{{--                                <span class="kt-menu__link">--}}
{{--                                    <span class="kt-menu__link-text">{{ __('text.stock_unit.management') }}</span>--}}
{{--                                </span>--}}
{{--                                </li>--}}
{{--                                @canany(['list-stock-units','view-stock-units', 'update-stock-units', 'delete-stock-units'])--}}
{{--                                    <li class="kt-menu__item {{ Request::routeIs(['admin.stock_units.index', 'admin.stock_units.edit']) ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">--}}
{{--                                        <a href="{{ route("admin.stock_units.index") }}" class="kt-menu__link ">--}}
{{--                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>--}}
{{--                                            <span class="kt-menu__link-text">{{ __('text.stock_unit.all') }}</span>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                @endcanany--}}

{{--                                @canany(['create-stock-units'])--}}
{{--                                    <li class="kt-menu__item {{ Request::routeIs('admin.stock_units.create') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">--}}
{{--                                        <a href="{{ route('admin.stock_units.create') }}" class="kt-menu__link ">--}}
{{--                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>--}}
{{--                                            <span class="kt-menu__link-text">{{ __('text.stock_unit.create') }}</span>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                @endcanany--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </li>--}}
{{--                @endcanany--}}


                {{--                @canany(['list-activity-logs', 'view-activity-logs'])--}}
                {{--                    <li class="kt-menu__item {{ Request::routeIs(['admin.activity_log.index', 'admin.activity_log.show'])? 'kt-menu__item--active' : '' }}" aria-haspopup="true">--}}
                {{--                        <a href="{{ route('admin.activity_log.index') }}" class="kt-menu__link ">--}}
                {{--                        <span class="kt-menu__link-icon">--}}
                {{--                            <i class="fa fa fa-history"></i>--}}
                {{--                        </span>--}}
                {{--                            <span class="kt-menu__link-text">{{ trans_choice('text.common.transaction_history', 2) }}</span>--}}
                {{--                        </a>--}}
                {{--                    </li>--}}
                {{--                @endcanany--}}

            </ul>
        </div>
    </div>
</div>
