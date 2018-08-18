@component('components/portlet')
@slot('title') Stats @endslot

<div class="m-widget1">
    <div class="m-widget1__item">
        <div class="row m-row--no-padding align-items-center">
            <div class="col">
                <h3 class="m-widget1__title">
                    Invoices
                </h3>
                <span class="m-widget1__desc">
                    Total
                </span>
            </div>
            <div class="col m--align-right">
                <span class="m-widget1__number m--font-brand">
                    {{ $stats['total_invoices'] }}
                </span>
            </div>
        </div>
    </div>
    <div class="m-widget1__item">
        <div class="row m-row--no-padding align-items-center">
            <div class="col">
                <h3 class="m-widget1__title">
                    Weight
                </h3>
                <span class="m-widget1__desc">
                    Calculated
                    <small>based on all Invoices</small>
                </span>
            </div>
            <div class="col m--align-right">
                <span class="m-widget1__number m--font-brand">
                    {{ $stats['total_weight'] }}
                </span>
            </div>
        </div>
    </div>
    <div class="m-widget1__item">
        <div class="row m-row--no-padding align-items-center">
            <div class="col">
                <h3 class="m-widget1__title">
                    Cost
                </h3>
                <span class="m-widget1__desc">
                    Calculated
                    <small>based on all Invoices</small>
                </span>
            </div>
            <div class="col m--align-right">
                <span class="m-widget1__number m--font-success">
                    {{ $stats['total_cost']}}
                </span>
            </div>
        </div>
    </div>
    <hr>
    <div class="m-widget1__item">
        <div class="row m-row--no-padding align-items-center">
            <div class="col">
                <h3 class="m-widget1__title">
                    Cost Per LBS
                </h3>
                <span class="m-widget1__desc">
                    Average Calculated
                    <small>based on all Invoices</small>
                </span>
            </div>
            <div class="col m--align-right">
                <span class="m-widget1__number m--font-success">
                    {{ $stats['total_cost_per_unit']}}
                </span>
            </div>
        </div>
    </div>
</div>
@endcomponent
