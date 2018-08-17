<!-- begin::Brand -->
<div class="m-stack__item m-brand">
    <div class="m-stack m-stack--ver m-stack--general m-stack--inline">
        <div class="m-stack__item m-stack__item--middle m-brand__logo">
            <a href="{{ route('home') }}" class="m-brand__logo-wrapper">
                <img class="img-fluid" alt="{{ config('app.name') }}" src="{{ asset('img/logo.png') }}" />
            </a>
        </div>
        <div class="m-stack__item m-stack__item--middle m-brand__tools">
            <div>
                <a href="{{ route('home') }}" class="btn">
                    <span>
                        {{ config('app.name') }}
                    </span>
                </a>
            </div>
        </div>

    </div>
</div>
<!-- end::Brand -->
