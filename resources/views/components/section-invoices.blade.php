<!--Begin::Section-->
<div class="row">
    <div class="col-xl-12">
        <!--begin:: Widgets/Invoices-->
        <div class="m-portlet m-portlet--full-height ">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Invoices
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                    <!--begin::Widget 11-->
                    <div class="m-widget11">
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table">
                                <!--begin::Thead-->
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>
                                            Origin
                                        </td>
                                        <td>
                                            Destination
                                        </td>
                                        <td>
                                            Weight (LBS)
                                        </td>
                                        <td>
                                            Cost
                                        </td>
                                        <td>
                                            Cost Per LB
                                        </td>
                                        <td>
                                            Paper Work
                                        </td>
                                        <td>
                                            Approved
                                        </td>
                                    </tr>
                                </thead>
                                <!--end::Thead-->
                                <!--begin::Tbody-->
                                <tbody>
                                    @foreach($invoices as $invoice)
                                    <tr>
                                        <td>
                                            {{ $invoice->id }}
                                        </td>
                                        <td>
                                            {{ $invoice->origin->name }}
                                        </td>
                                        <td>
                                            {{ $invoice->destination->name }}
                                        </td>
                                        <td>
                                            {{ $invoice->weight }}
                                        </td>
                                        <td>
                                            {{ $invoice->priceFormatting($invoice->cost) }}
                                        </td>
                                        <td>
                                            {{ $invoice->priceFormatting($invoice->cost_per_unit) }}
                                        </td>
                                        <td>
                                            <a href="{{ $invoice->paperWorkURL() }}" class="btn m-btn--pill btn-info">
                                                Paper Work
                                            </a>
                                        </td>
                                        <td>
                                            <span class="m-badge m-badge--{{ $invoice->statusClass() }} m-badge--wide">
                                                {{ $invoice->status }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <!--end::Tbody-->
                            </table>
                            <!--end::Table-->
                        </div>
                    </div>
                    <!--end::Widget 11-->
            </div>
        </div>
        <!--end:: Widgets/Invoices-->
    </div>
</div>
<!--End::Section-->
