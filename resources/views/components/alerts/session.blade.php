@if (session('message'))
<div class="m-alert m-alert--icon m-alert--air m-alert--square alert alert-{{ session('message_status') }} alert-dismissible fade show"
    role="alert">
    <div class="m-alert__icon">
        <i class="la la-warning"></i>
    </div>
    <div class="m-alert__text">
        {{ session('message') }}
    </div>
    <div class="m-alert__close">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        </button>
    </div>
</div>
@endif
