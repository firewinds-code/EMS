@extends('includes.master')
@section('content')
@section('page-title', 'Report')
@section('page-heading', 'Reimbursement Report')



<div id="kt_app_content_container" class="app-container container-xxl">

    <div class="card cardheight cardOutline">
        <div class="card-body">
            <form id="formFindReport" action="{{ route('getReport') }}" method="POST">
                @csrf
                <div class="row g-9 mb-8">
                    <div class="col-md-4 fv-row">
                        <input class="form-control form-control-solid" placeholder="Pick date rage" name="DateFrom_To" id="DateFrom_To" />
                    </div>

                    <div class="col-md-4 fv-row">
                        <select class="form-select form-select-solid" data-control="select2" data-placeholder="Select an option" data-allow-clear="true" name="reimbursement_type">
                            <option value="food">Food</option>
                            <option value="travel">Travel</option>
                            <option value="hotel">Hotel</option>
                            <option value="mobile">Mobile</option>
                            <option value="miscellaneous">Miscellaneous </option>
                        </select>
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
    <br />
    @if (isset($results))
    @if ($results->isNotEmpty())
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
                            <a href="#" class="menu-link px-3" data-kt-export="excel">
                                Export as Excel
                            </a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3" data-kt-export="csv">
                                Export as CSV
                            </a>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::Menu-->
                    <!--end::Export dropdown-->

                    <!--begin::Hide default export buttons-->
                    <div id="kt_datatable_example_buttons" class="d-none"></div>
                    <!--end::Hide default export buttons-->
                </div>
                <!--end::Card toolbar-->
            </div>

            <!--begin::Table-->
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_datatable_example">
                <thead>
                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                        <th class="min-w-50px">Sr. No.</th>
                        <th class="min-w-70px">EmployeeID</th>
                        <th class="min-w-100px">Name</th>
                        <th class="min-w-100px">Client</th>
                        <th class="min-w-100px">Process</th>
                        <th class="min-w-100px">Subprocess</th>
                        <th class="min-w-100px">Designation</th>
                        <th class="min-w-100px">Location</th>
                        @if ($dataType === 'Hotel')
                        <th class="min-w-100px" hidden>Date</th>
                        @else
                        <th class="min-w-100px">Date</th>
                        @endif

                        @if ($dataType === 'Travel')
                        <th class="min-w-100px">Place From</th>
                        <th class="min-w-100px">Place To</th>
                        <th class="min-w-100px">Mode Of Travel</th>
                        @endif
                        @if ($dataType === 'Hotel')
                        <th class="min-w-100px">Date From</th>
                        <th class="min-w-100px">Date To</th>
                        <th class="min-w-100px">No Of Days</th>
                        <th class="min-w-100px">Hotel Name</th>
                        @endif

                        <th class="min-w-100px">Amount</th>
                        <th class="min-w-100px">Receipt No</th>
                        <th class="min-w-100px">Receipt Image</th>
                        <th class="min-w-100px">Remarks</th>
                        <th class="min-w-100px">Request Type</th>
                        <th class="min-w-100px">Manager Status</th>
                        <th class="min-w-100px">Manager Comment</th>
                        <th class="min-w-100px">Review Status</th>
                        <th class="min-w-100px">Review Comment</th>
                        <th class="min-w-100px">Created On</th>
                </thead>
                <tbody class="fw-semibold text-gray-600">
                    @if (isset($results))
                    @php $i = 0; @endphp
                    @foreach ($results as $data)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $data->EmployeeID }}</td>
                        <td>{{ $data->empName }}</td>
                        <td>{{ $data->client_name }}</td>
                        <td>{{ $data->process }}</td>
                        <td>{{ $data->sub_process }}</td>
                        <td>{{ $data->Designation }}</td>
                        <td>{{ $data->location }}</td>

                        @if ($dataType === 'Hotel')
                        <td hidden>{{ $data->date }}</td>
                        @else
                        <td>{{ $data->date }}</td>
                        @endif
                        @if ($dataType === 'Travel')
                        <td>{{ $data->placeFrom }}</td>
                        <td>{{ $data->placeTO }}</td>
                        <td>{{ $data->modeOftravel }}</td>
                        @endif

                        @if ($dataType === 'Hotel')
                        <td>{{ $data->dateFrom }}</td>
                        <td>{{ $data->dateTo }}</td>
                        <td>{{ $data->noOfdays }}</td>
                        <td>{{ $data->hotelName }}</td>
                        @endif

                        <td>{{ $data->amount }}</td>
                        <td>{{ $data->receipt_no }}</td>
                        <td>
                            @switch($dataType)
                            @case('Hotel')
                            <a href="{{ asset('reimbursement/ExpenseHotel/' . $data->receipt_image) }}" download>
                                <i class="fas fa-download text-success" title="Download File"></i>
                            </a>
                            @break
                            @case('Mobile')
                            <a href="{{ asset('reimbursement/ExpenseMobile/' . $data->receipt_image) }}" download>
                                <i class="fas fa-download text-success" title="Download File"></i>
                            </a>
                            @break
                            @case('Miscellaneous')
                            <a href="{{ asset('reimbursement/ExpenseMiscellaneous/' . $data->receipt_image) }}" download>
                                <i class="fas fa-download text-success" title="Download File"></i>
                            </a>
                            @break
                            @case('Food')
                            <a href="{{ asset('reimbursement/ExpenseFood/' . $data->receipt_image) }}" download>
                                <i class="fas fa-download text-success" title="Download File"></i>
                            </a>
                            @break
                            @default
                            @php $expenseCategory = ''; @endphp
                            @endswitch


                        </td>
                        <td>{{ $data->remarks }}</td>
                        <td>{{ $data->reqType }}</td>
                        <td>{{ $data->mgrStatus }}</td>
                        <td>{{ $data->mgrComment }}</td>
                        <td>{{ $data->reviewerStatus }}</td>
                        <td>{{ $data->reviewComment }}</td>
                        <td>{{ $data->created_at }}</td>

                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            <!--end::Table-->
        </div>
    </div>
    @else
    <script>
        toastr.success("No Data Found !!");
    </script>
    @endif
    @endif





</div>


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



@endsection