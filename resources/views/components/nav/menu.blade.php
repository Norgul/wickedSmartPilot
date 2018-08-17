<!-- begin::Horizontal Menu -->
<div class="m-stack__item m-stack__item--middle m-stack__item--fluid">
    <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-light " id="m_aside_header_menu_mobile_close_btn">
        <i class="la la-close"></i>
    </button>
    <div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-dark m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-light m-aside-header-menu-mobile--submenu-skin-light ">
        <ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
            <li class="m-menu__item  @if(in_array(Route::currentRouteName(), ['root', 'home', 'dashboard'])) m-menu__item--active @endif" aria-haspopup="true">
                <a href="{{ route('home') }}" class="m-menu__link ">
                    <span class="m-menu__item-here"></span>
                    <span class="m-menu__link-text">
                        Home
                    </span>
                </a>
            </li>
            @guest
            <li class="m-menu__item @if('login' === Route::currentRouteName()) m-menu__item--active @endif" aria-haspopup="true">
                <a href="{{ route('login') }}" class="m-menu__link ">
                    <span class="m-menu__item-here"></span>
                    <span class="m-menu__link-text">
                        Login
                    </span>
                </a>
            </li>
            <li class="m-menu__item @if('register' === Route::currentRouteName()) m-menu__item--active @endif" aria-haspopup="true">
                <a href="{{ route('register') }}" class="m-menu__link ">
                    <span class="m-menu__item-here"></span>
                    <span class="m-menu__link-text">
                        Register
                    </span>
                </a>
            </li>
            @endif
        </ul>
    </div>
</div>
<!-- end::Horizontal Menu -->
