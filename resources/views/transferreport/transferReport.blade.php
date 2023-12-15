@extends('includes.master')
@section('content')
@section('page-title', 'Adminstrator')
@section('page-heading', 'Transfer Report')
<div id="kt_app_content" class="app-content flex-column-fluid">

    <div id="kt_app_content_container" class="app-container container-xxl ">
        <!--begin::Card-->
        <div class="card cardheight cardOutline">
            <div class="card-body">
                <form id="FindtransferReport" action="{{route('transferreport')}}" method="post">
                    @csrf
                    <div class="row g-9 mb-8">
                        <div class="col-md-4 fv-row">
                            <input class="form-control form-control-solid" placeholder="Pick date rage" name="DateFrom_To" id="DateFrom_To" />
                        </div>

                        <div class="col-md-4 fv-row">
                            <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary" style="float: right;">
                                <i class="fas fa-search"></i> Search
                            </button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
        @if (isset($results))
        @if ($results->isNotEmpty())
        <br>
        <div class="card cardOutline">
            <div class="card-body">
                <!--begin::Card header-->
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Report" />
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--end::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                        <!--begin::Export dropdown-->
                        <button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            <i class="ki-duotone ki-exit-down fs-2"><span class="path1"></span><span class="path2"></span></i>
                            Export Report
                        </button>
                        <!--begin::Menu-->
                        <div id="kt_datatable_example_export_menu" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-export="csv">
                                    Export as CSV
                                </a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-export="excel">
                                    Export as Excel
                                </a>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--begin::Hide default export buttons-->
                        <div id="kt_datatable_example_buttons" class="d-none"></div>
                        <!--end::Hide default export buttons-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <div>
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_datatable_example">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-50px">Sr. No.</th>
                                <th class="min-w-70px">Employee ID</th>
                                <th class="min-w-100px">Location</th>
                                <th class="min-w-100px">Client Name</th>
                                <th class="min-w-100px">Process</th>
                                <th class="min-w-100px">Subprocess</th>
                                <th class="min-w-100px">Report To</th>
                        </thead>
                        <tbody>
                            @php $i = 0; @endphp
                            @foreach($results as $result)
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                <td class="min-w-50px">{{ ++$i }}</td>
                                <td class="min-w-70px">{{ $result->EmployeeID }}</td>
                                <td class="min-w-100px">{{ $result->location }}</td>
                                <td class="min-w-100px">{{ $result->client_name }}</td>
                                <td class="min-w-100px">{{ $result->process }}</td>
                                <td class="min-w-100px">{{ $result->sub_process }}</td>
                                <td class="min-w-100px">{{ $result->reports_to }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @else
        <script>
            toastr.success("No Data Found !!");
        </script>
    </div>
    @endif
    @endif
    <script src="{{ asset('utills/dist/assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('utills/dist/assets/js/scripts.bundle.js') }}"></script>
    <script>
        $(document).ready(function() {
            var table = $('#kt_datatable_example').DataTable({
                "info": false,
                'order': [],
                'pageLength': 10,
            });

            const exportButtons = () => {
                const documentTitle = 'Expense-Report';
                const buttons = new $.fn.dataTable.Buttons(table, {
                    buttons: [{
                            extend: 'copyHtml5',
                            title: documentTitle
                        },
                        {
                            extend: 'excelHtml5',
                            title: documentTitle
                        },
                        {
                            extend: 'csvHtml5',
                            title: documentTitle
                        },
                        {
                            extend: 'pdfHtml5',
                            title: documentTitle
                        }
                    ]
                }).container().appendTo($('#kt_datatable_example_buttons'));

                // Hook dropdown menu click event to datatable export buttons
                const exportButtons = document.querySelectorAll(
                    '#kt_datatable_example_export_menu [data-kt-export]');
                exportButtons.forEach(exportButton => {
                    exportButton.addEventListener('click', e => {
                        e.preventDefault();

                        // Get clicked export value
                        const exportValue = e.target.getAttribute('data-kt-export');
                        const target = document.querySelector('.dt-buttons .buttons-' +
                            exportValue);
                        // Trigger click event on hidden datatable export buttons
                        target.click();
                    });
                });
            };

            exportButtons();

            // Search Datatable
            const filterSearch = document.querySelector('[data-kt-filter="search"]');
            filterSearch.addEventListener('keyup', function(e) {
                table.search(e.target.value).draw();
            });
        });
    </script>
</div>
@endsection