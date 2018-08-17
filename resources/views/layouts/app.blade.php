<!DOCTYPE html>
<html lang="en">

<!-- begin::Head -->

<head>
    <meta charset="utf-8" />
    <title>
        {{ config('app.name') }} | {{ title_case(Route::currentRouteName()) ?? 'Application' }}
    </title>
    <meta name="description" content="{{ $pageDescription ?? config('app.name') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="shortcut icon" href="{{ asset('favicon.ico')}}" type="image/x-icon">

    @include('components/required/top')

    @stack('styles')
</head>

<body class="m-page--wide m-header--fixed m-header--fixed-mobile m-footer--push m-aside--offcanvas-default">
    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">
        @include('components/header/container')

        @yield('content')

        @include('components/footer/container')
    </div>
    <!-- end:: Page -->

    @include('components/required/bottom')

    @stack('scripts')
</body>
</html>
