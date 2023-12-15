@extends('includes.master')
@section('content')
@section('page-title', 'Dynamic Report')
@section('page-heading', 'Dynamic Report')

<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card cardOutline">
            <div class="card-body align-items-center py-5 gap-2 gap-md-5">
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" data-kt-filter="search"
                                class="form-control form-control-solid w-250px ps-14" placeholder="Search Report" />
                        </div>
                    </div>
                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                        <button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click"
                            data-kt-menu-placement="bottom-end">
                            <i class="ki-duotone ki-exit-down fs-2"><span class="path1"></span><span
                                    class="path2"></span></i>
                            Export
                        </button>
                        <div id="kt_datatable_example_export_menu"
                            class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4"
                            data-kt-menu="true">
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-export="excel">
                                    Export as Excel
                                </a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-export="csv">
                                    Export as CSV
                                </a>
                            </div>
                        </div>
                        <div id="kt_datatable_example_buttons" class="d-none"></div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div id="kt_customers_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer"
                                id="ReportList">
                                <thead>
                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="min-w-125px sorting">Employee ID</th>
                                        <th class="min-w-125px sorting">Employee Name</th>
                                        <th class="min-w-125px sorting">Report Name</th>
                                        <th class="min-w-125px sorting">Location</th>
                                        <th class="min-w-125px sorting">Client</th>
                                        <th class="min-w-125px sorting">Process</th>
                                        <th class="min-w-125px sorting">Sub Process</th>
                                        <th class="min-w-125px sorting">Created On</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                    
                                    @if (!@empty($reportData))
                                   
                                        @foreach ($reportData as $result)
                                            <tr class="even">
                                                <td>{{ $result->EmpID }}</td>
                                                <td>{{ $result->EmployeeName }}</td>
                                                <td>{{ $result->report_name }}</td>
                                                <td>{{ $result->location }}</td>
                                                <td>{{ $result->client_name }}</td>
                                                <td>{{ $result->process }}</td>
                                                <td>{{ $result->sub_process }}</td>
                                                <td>{{ $result->Createdon }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script src="{{ asset('utills/dist/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('utills/dist/assets/js/scripts.bundle.js') }}"></script>

<script>
    $(document).ready(function() {

        var table = $('#ReportList').DataTable({
            "info": false,
            'order': [],
            'pageLength': 10,
        });

        const exportButtons = () => {
            const documentTitle = 'Expense-Report';
            const buttons = new $.fn.dataTable.Buttons(table, {
                buttons: [{
                        extend: 'excelHtml5',
                        title: documentTitle
                    },
                    {
                        extend: 'csvHtml5',
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
