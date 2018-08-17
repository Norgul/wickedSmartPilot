<!-- begin::Topbar -->
<div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
    <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
        <div class="m-stack__item m-topbar__nav-wrapper">
            <ul class="m-topbar__nav m-nav m-nav--inline">
                @auth
                <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light"
                    data-dropdown-toggle="click">
                    <a href="#" class="m-nav__link m-dropdown__toggle">
                        <span class="m-topbar__welcome">
                            Hello,&nbsp;
                        </span>
                        <span class="m-topbar__username">
                            {{ auth()->user()->name }}
                        </span>
                        <span class="m-topbar__userpic">
                            <img src="{{ asset('img/user-1.jpg') }}" class="m--img-rounded m--marginless m--img-centered" alt="" />
                        </span>
                    </a>
                    <div class="m-dropdown__wrapper">
                        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                        <div class="m-dropdown__inner">
                            <div class="m-dropdown__header m--align-center" style="background: url("{{ asset('img/user_profile_bg.jpg') }}"); background-size: cover;">
                                <div class="m-card-user m-card-user--skin-dark">
                                    <div class="m-card-user__pic">
                                        <img src="{{ asset('img/user.jpg') }}" class="m--img-rounded m--marginless" alt="" />
                                    </div>
                                    <div class="m-card-user__details">
                                        <span class="m-card-user__name m--font-weight-500">
                                            {{ auth()->user()->name }}
                                        </span>
                                        <a href="" class="m-card-user__email m--font-weight-300 m-link">
                                            {{ auth()->user()->email }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="m-dropdown__body">
                                <div class="m-dropdown__content">
                                    <ul class="m-nav m-nav--skin-light">
                                        <li class="m-nav__item">
                                            <a href="{{ route('profile') }}" class="m-nav__link">
                                                <i class="m-nav__link-icon flaticon-profile-1"></i>
                                                <span class="m-nav__link-title">
                                                    <span class="m-nav__link-wrap">
                                                        <span class="m-nav__link-text">
                                                            My Profile
                                                        </span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>
                                        <li class="m-nav__separator m-nav__separator--fit"></li>
                                        <li class="m-nav__item">
                                            <a  href="{{ route('logout') }}"
                                                class="btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                            >
                                                Logout
                                            </a>

                                            <form style=" display: none;" id="logout-form" action="{{ route('logout') }}" method="POST">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>
<!-- end::Topbar -->
