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

                    <div class="col-xl-6">
                        @component('components/portlet')
                            @slot('title')
                                Graphs
                            @endslot
                            <div id="stats-chart" class="ct-chart ct-perfect-fourth"></div>
                        @endcomponent
                    </div>

                    <div class="col-xl-6">
                        @component('components/portlet')
                            @slot('title')
                                Stats
                            @endslot

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
                                                Calculated <small>based on all Invoices</small>
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
                                                Calculated <small>based on all Invoices</small>
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
                                                Average Calculated <small>based on all Invoices</small>
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
                    </div>
                </div>
                <!--Begin::Section-->
                <div class="row">
                    <div class="col-xl-12">
                        <!--begin:: Widgets/Invoices-->
                        @component('components/portlet')
                            @slot('title')
                                Invoices
                            @endslot
                            <div class="row">
                                <div class="col-md-12 my-4">
                                    <div class="m-input-icon m-input-icon--left">
                                        <input type="text" class="form-control form-control-lg m-input m-input--solid" placeholder="Search..." id="invoice-search"
                                            name="search">
                                        <span class="m-input-icon__icon m-input-icon__icon--left">
                                            <span>
                                                <i class="la la-search"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="invoices-table"></div>
                                </div>
                            </div>
                        @endcomponent
                        <!--end:: Widgets/Invoices-->
                    </div>
                </div>
                <!--End::Section-->

            </div>
        </div>
    </div>
</div>
<!-- end::Body -->
@endsection

@push('scripts')
<!--begin::Page Vendors -->
<script src="{{ asset('vendors/custom/fullcalendar/fullcalendar.bundle.js') }}" type="text/javascript "></script>
<!--end::Page Vendors -->

<!--begin::Page Snippets -->
<script src="{{ asset('js/dashboard.js') }}" type="text/javascript "></script>
<!--end::Page Snippets -->
@endpush

 @push('scripts')
<script>
    var options = {
        data: {
            type: 'remote',
            source: {
                read: {
                    url: '{{ route("invoices.fetch") }}',
                    method: 'POST',
                    // custom headers
                    headers: {
                        'X-CSRF-TOKEN': token.content,
                    },
                    map: function (raw) {
                        var dataSet = raw;
                        if (typeof raw.data !== 'undefined') {
                            dataSet = raw.data;
                        }

                        updateChart(raw);

                        return dataSet;
                    },
                }
            },
            pageSize: 15,
            saveState: {
                cookie: false,
                webstorage: false
            },
            serverPaging: true,
            serverFiltering: true,
            serverSorting: true,
            autoColumns: false
        },

        layout: {
            theme: 'default',
            class: 'm-datatable--success',
            scroll: false,
            height: null,
            footer: true,
            header: true,

            smoothScroll: {
                scrollbarShown: true
            },

            spinner: {
                overlayColor: '#000000',
                opacity: 0,
                type: 'loader',
                state: 'brand',
                message: true
            },

            icons: {
                sort: {
                    asc: 'la la-arrow-up',
                    desc: 'la la-arrow-down'
                },
                pagination: {
                    next: 'la la-angle-right',
                    prev: 'la la-angle-left',
                    first: 'la la-angle-double-left',
                    last: 'la la-angle-double-right',
                    more: 'la la-ellipsis-h'
                },
                rowDetail: {
                    expand: 'fa fa-caret-down',
                    collapse: 'fa fa-caret-right'
                }
            }
        },

        sortable: true,
        pagination: true,

        search: {
            // enable trigger search by keyup enter
            onEnter: true,
            // input text for search
            input: $('#invoice-search'),
            // search delay in milliseconds
            delay: 300,
        },

        // columns definition
        columns: [{
            field: "id",
            title: "#",
            sortable: 'asc',
            width: 40,
        }, {
            field: "origin_id",
            title: "Origin",
            sortable: 'asc',
            filterable: false,
            template: function (row) {
                return row.origin.name;
            }
        }, {
            field: "destination_id",
            title: "Destination",
            sortable: 'asc',
            filterable: false,
            template: function (row) {
                return row.destination.name;
            }
        }, {
            field: "weight",
            title: "Weight (LBS)",
            sortable: 'asc',
            filterable: false,
        }, {
            field: 'cost',
            title: 'Cost',
            sortable: 'asc',
            filterable: false,
        }, {
            field: 'costPerLB',
            title: 'Cost Per LB',
            sortable: 'asc',
            template: '@{{cost_per_unit}}'
        }, {
            field: 'paper_work',
            title: 'View Paperwork',
            template: '@{{paperwork_url}}'
        }, {
            field: 'status',
            title: 'Status',
            sortable: 'asc',
            template: function (row) {
                return `
                <button onclick="changeStatus(this)" data-invoice-id="${row.id}" data-status="${row.status}" data-status_class=${row.status_class} class="btn btn-sm m-btn--wide m-btn--pill btn-${row.status_class} invoice-status invoice-status--${row.id}">
                    ${row.status}
                </button>
                <select class="${row.status_class} invoice-statuses" style="display:none;">
                    ${row.status_options}
                </select>
                `;
            }
        }],

        toolbar: {
            layout: ['pagination', 'info'],

            placement: ['bottom'], //'top', 'bottom'

            items: {
                pagination: {
                    type: 'default',

                    pages: {
                        desktop: {
                            layout: 'default',
                            pagesNumber: 6
                        },
                        tablet: {
                            layout: 'default',
                            pagesNumber: 3
                        },
                        mobile: {
                            layout: 'compact'
                        }
                    },

                    navigation: {
                        prev: true,
                        next: true,
                        first: true,
                        last: true
                    },

                    pageSizeSelect: [10, 20, 30, 50, 100]
                },
                info: true
            }
        },

        translate: {
            records: {
                processing: 'Please wait...',
                noRecords: 'No records found'
            },
            toolbar: {
                pagination: {
                    items: {
                        default: {
                            first: 'First',
                            prev: 'Previous',
                            next: 'Next',
                            last: 'Last',
                            more: 'More pages',
                            input: 'Page number',
                            select: 'Select page size'
                        },
                        info: 'Displaying @{{start}} - @{{end}} of @{{total}} records'
                    }
                }
            }
        }
    };

    var datatable = $('#invoices-table').mDatatable(options);

    function changeStatus(element) {
        const target = $(element);
        const statusChanger = target.siblings('select');
        const prevStatusClass = target.data('status_class');

        $('button.invoice-status').show();
        target.hide();

        $('select.invoice-statuses').hide();
        statusChanger.show();

        statusChanger.unbind('change');
        statusChanger.on('change', function (event) {
            const statusElement = $(event.target);

            $.post("{{ route('invoices.status') }}", {
                id: target.data('invoice-id'),
                status: statusElement.val(),
            }, function(response) {

                target.removeClass(`btn-${prevStatusClass}`);
                target.text(response.data.status);
                target.addClass(`btn-${response.data.status_class}`);
                target.data('status', response.data.status);
                target.data('status_class', response.data.status_class);

                statusChanger.hide();
                target.show();
            });
        });
    }

</script>
@endpush


@push('styles')
    <link rel="stylesheet" href="{{ asset('/vendors/custom/chartist/chartist.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendors/custom/chartist/chartist-plugin-tooltip.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('/vendors/custom/chartist/chartist.min.js') }}">
    </script>
    <script src="{{ asset('/vendors/custom/chartist/chartist-plugin-tooltip.min.js') }}">
    </script>
    <script>

        function updateChart(data) {
            statChart.update(data.chart.content);
            chartMax = data.chart.max;
        }

        var data = {
        };
        var max = 7;

        var options = {
            plugins: [
                Chartist.plugins.tooltip()
            ]
        };

        // Create a new line chart object where as first parameter we pass in a selector
        // that is resolving to our chart container element. The Second parameter
        // is the actual data object.
        const statChart = new Chartist.Bar('#stats-chart', data, options);

        // This is the bit we are actually interested in. By registering a callback for `draw` events, we can actually intercept the drawing process of each element on the chart.
        statChart.on('draw', function(context) {
            // First we want to make sure that only do something when the draw event is for bars. Draw events do get fired for labels and grids too.
            if(context.type === 'bar') {
                // With the Chartist.Svg API we can easily set an attribute on our bar that just got drawn
                context.element.attr({
                    // Now we set the style attribute on our bar to override the default color of the bar. By using a HSL colour we can easily set the hue of the colour dynamically while keeping the same saturation and lightness. From the context we can also get the current value of the bar. We use that value to calculate a hue between 0 and 100 degree. This will make our bars appear green when close to the maximum and red when close to zero.
                    style: 'stroke: hsl(' + Math.floor(Chartist.getMultiValue(context.value) / max * 100) + ', 50%, 50%);'
                });
            }
        });
    </script>
@endpush
