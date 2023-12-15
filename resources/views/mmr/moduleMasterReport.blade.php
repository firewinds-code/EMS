@extends('includes.master')
@section('content')
@section('page-title', 'Module Master Report')
@section('page-heading', 'Module Master Report')

<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card cardOutline">
            <div class="card-body align-items-center py-5 gap-2 gap-md-5">
                {{-- <div class="card-header align-items-center py-5 gap-2 gap-md-5">
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
                </div> --}}
                <div class="card-body pt-0">
                    <div id="kt_customers_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer"
                                id="module_master_report_table">
                                <thead>
                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="min-w-125px sorting">EmployeeID</th>
                                        <th class="min-w-125px sorting">Employee Name</th>
                                        <th class="min-w-100px sorting">Location</th>
                                        <th class="min-w-250px sorting">Process</th>
                                        <th class="min-w-75px sorting">Level</th>
                                        <th class="min-w-125px sorting">L1 ID</th>
                                        <th class="min-w-125px sorting">L1 Name</th>
                                        <th class="min-w-125px sorting">L2 ID</th>
                                        <th class="min-w-125px sorting">L2 Name</th>
                                        <th class="min-w-125px sorting">Mapping</th>
                                    </tr>
                                </thead>
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

<script type="text/javascript">
    $(function() {
        var table = $('#module_master_report_table').DataTable({
            dom: 'Bfrtip',
            processing: true,
            serverSide: true,
            paging: true,
            searching: true,
            responsive: true,
            ajax: "{{ route('mmrView') }}",
            columns: [{
                    data: 'EmployeeID',
                    name: 'EmployeeID',
                    searchable: true
                },
                {
                    data: 'EmployeeName',
                    name: 'Employee Name',
                    searchable: true
                },
                {
                    data: 'location',
                    name: 'Location',
                    searchable: true
                },
                {
                    data: 'Process',
                    name: 'Process',
                    searchable: true
                },
                {
                    data: 'level',
                    name: 'Level',
                    searchable: true
                },
                {
                    data: 'L1',
                    name: 'L1 ID',
                    searchable: true
                },
                {
                    data: 'L1Name',
                    name: 'L1 Name',
                    searchable: true
                },
                {
                    data: 'L2',
                    name: 'L2 ID',
                    searchable: true
                },
                {
                    data: 'L2Name',
                    name: 'L2 Name',
                    searchable: true
                },
                {
                    data: 'Mapping',
                    name: 'Mapping',
                    searchable: true
                },
            ],
            lengthMenu:  [100, "All"],
            buttons: ['excel']
        });
        $('#module_master_report_table_filter input').on('keyup', function() {
            table.search(this.value).draw();
        });

    });
</script>
