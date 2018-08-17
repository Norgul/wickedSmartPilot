<header class="m-grid__item m-header " data-minimize="minimize" data-minimize-offset="200" data-minimize-mobile-offset="200">
    <div class="m-header__top">
        <div class="m-container m-container--responsive m-container--xxl m-container--full-height m-page__container">
            <div class="m-stack m-stack--ver m-stack--desktop">
                @include('components/header/branding')
                @include('components/header/topbar')
            </div>
        </div>
    </div>
    <div class="m-header__bottom">
        <div class="m-container m-container--responsive m-container--xxl m-container--full-height m-page__container">
            <div class="m-stack m-stack--ver m-stack--desktop">
                @include('components/nav/menu')
            </div>
        </div>
    </div>
</header>
