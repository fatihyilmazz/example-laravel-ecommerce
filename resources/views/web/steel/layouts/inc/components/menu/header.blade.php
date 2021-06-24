<ul class="nav navbar-nav">
    @foreach($menus as $menu)
        @if($menu['subMenus']->isEmpty())
            <li class="@if($menu['urls']->contains(url()->current())) active @endif">
                <a href="{{ $menu['link'] }}">{{ $menu['name'] }}</a>
            </li>
        @else
            <li class="@if($menu['urls']->contains(url()->current())) active @endif">
                <a href="@empty($menu['link']) javascript:; @else {{ $menu['link'] }} @endempty">
                    {{ $menu['name'] }}
                    <i class="fa fa-chevron-down"></i>
                </a>
                <ul class="sub-menu tab-content">
                    @foreach($menu['subMenus'] as $subMenu)
                        <li>
                            <a href="@empty($subMenu['link']) javascript:; @else {{ $subMenu['link'] }} @endempty">
                                {{ $subMenu['name'] }}
                                @if($subMenu['subMenus']->isNotEmpty()) <i class="fa fa-angle-right"></i> @endempty
                            </a>
                            @foreach($subMenu['subMenus'] as $subMenuTwo)
                                <ul class="sub-menu">
                                    <li><a href="{{ $subMenuTwo['link'] }}">{{ $subMenuTwo['name'] }}</a></li>
                                </ul>
                            @endforeach

                        </li>
                    @endforeach
                </ul>
            </li>
        @endif
    @endforeach
</ul>
