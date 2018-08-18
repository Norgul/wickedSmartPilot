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
                                <div class="row">
                                    <div class="col-md-6 my-4">
                                        <input type="text" id="invoice-search" name="search" placeholder="Search Invoice" class="form-control m-input m-input--air m-input--pill">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="invoices-table"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                        // sample data mapping
                        var dataSet = raw;
                        if (typeof raw.data !== 'undefined') {
                            dataSet = raw.data;
                        }
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
            field: 'paperwork',
            title: 'View Paperwork',
            template: '@{{paperwork_url}}'
        }, {
            field: 'status',
            title: 'Status',
            sortable: 'asc',
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
</script>
@endpush
