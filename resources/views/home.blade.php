@extends('layouts.app')

@section('content')
<!-- begin::Body -->
<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor-desktop m-grid--desktop m-body">
    <div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver m-container m-container--responsive m-container--xxl m-page__container">
        <div class="m-grid__item m-grid__item--fluid m-wrapper">
            <!-- BEGIN: Subheader -->
            <div class="m-subheader ">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="m-subheader__title ">
                            Dashboard
                        </h3>
                    </div>
                </div>
            </div>
            <!-- END: Subheader -->

            <div class="m-content">
                <div class="row">
                    <div class="col-xl-12">
                        @include('components/invoice-stats', ['stats' => $stats])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end::Body -->
@endsection
