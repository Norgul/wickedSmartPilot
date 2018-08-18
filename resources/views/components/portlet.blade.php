<div class="m-portlet m-portlet--full-height ">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    {{ $title ?? 'Portlet' }}
                </h3>
            </div>
        </div>
    </div>
    <div class="m-portlet__body">
        {{ $slot }}
    </div>
</div>
