@extends('includes.master')
@section('content')
@section('page-title', 'Reference Registration Reports')
@section('page-heading', 'Reference Registration Reports')

<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl ">
        <!--begin::Card-->
        <div class="card cardheight cardOutline">
            <div class="card-body">
                <form id="ReferenceReport" action="" method="post">
                    @csrf
                    <div class="row g-9 mb-8">
                        <div class="col-md-6 fv-row">
                            <input class="form-control form-control-solid" placeholder="Pick date range" name="DateFrom"
                                id="DateFrom_To" />
                        </div>
                        <div class="col-md-4 fv-row">
                            <button type="submit" value="search" name="report_search" id="report_search"
                                class="btn btn-primary" style="float: right;">
                                <i class="fas fa-search"></i> Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @if (isset($results))
            @if (!@empty($results))
                <br>
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
                                        class="form-control form-control-solid w-250px ps-14"
                                        placeholder="Search Registration" />
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
                                        id="registrationList">
                                        <thead>
                                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                <th class="min-w-125px sorting">Employee ID</th>
                                                <th class="min-w-125px sorting">Employee Name</th>
                                                <th class="min-w-125px sorting">Process</th>
                                                <th class="min-w-125px sorting">Created On</th>
                                                <th class="min-w-125px sorting">Candidate Name</th>
                                                <th class="min-w-125px sorting">Candidate Number</th>
                                                <th class="min-w-125px sorting">Walkin(Y/N)</th>
                                                <th class="min-w-125px sorting">Walkin Date</th>
                                                <th class="min-w-125px sorting">Interview Cleared(Y/N)</th>
                                                <th class="min-w-125px sorting">Process Selected</th>
                                                <th class="min-w-125px sorting">Joining Date</th>
                                                <th class="min-w-125px sorting">Joined Y/N</th>
                                                <th class="min-w-125px sorting">Candidate EmployeeID</th>
                                                <th class="min-w-125px sorting">Salary CTC</th>
                                                <th class="min-w-125px sorting">Current Active (Y/N)</th>
                                                <th class="min-w-125px sorting">Total Amount</th>
                                                <th class="min-w-125px sorting">1st Pay Amount</th> 
                                                <th class="min-w-125px sorting">1st Pay Date</th>
                                                <th class="min-w-125px sorting">2nd Pay Amount</th>
                                                <th class="min-w-125px sorting">2nd Pay Date</th>
                                                <th class="min-w-125px sorting">Location</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fw-semibold text-gray-600">
                                            @foreach ($results as $result)
                                                <tr class="even">
                                                    @php

                                                        $refID = $result->RefID;
                                                        $candidateNumber = $result->CandidateNumber;
                                                        $employeeID = $result->EmployeeID;
                                                        $createdOn = $result->createdon;
                                                    @endphp
                                                    <td>{{ $result->EmployeeID }}</td>
                                                    <td>{{ $result->EmployeeName }}</td>
                                                    <td>{{ $result->Process }}</td>
                                                    <td>{{ $result->createdon }}</td>
                                                    <td>{{ $result->CandidateName }}</td>
                                                    <td>{{ $result->CandidateNumber }}</td>

                                                    @php
                                                        $candidate = customFunction($candidateNumber);
                                                        $id = '';
                                                        $intId = '';
                                                        $WalkinDate = '';
                                                    @endphp

                                                    @if (!@empty($candidate))
                                                        <td>{{ $candidate->Walkin }}</td>
                                                        <td>{{ $candidate->WalkinDate }}</td>
                                                        @php
                                                            $id = '';
                                                            $intId = $candidate->INTID;
                                                            $WalkinDate = $candidate->WalkinDate;
                                                            $id = $candidate->id;
                                                        @endphp
                                                    @else
                                                        <td>{{ __('No') }}</td>
                                                        <td>{{ __('NA') }}</td>
                                                    @endif

                                                    @php
                                                        $processOne = '';
                                                        $DOJ = '';
                                                        $candidateDetails = interviewDetails($id);
                                                    @endphp
                                                    @if (!@empty($candidateDetails) && @isset($id))
                                                        <td>{{ $candidateDetails->Interviewclered }} </td>
                                                        <td>{{ $candidateDetails->PrcessSeleceted }} </td>
                                                        <td>{{ $candidateDetails->JoiningDate }} </td>
                                                        @php
                                                            $DOJ = $candidateDetails->JoiningDate;
                                                            $processOne = $candidateDetails->Process1;
                                                        @endphp
                                                    @else
                                                        <td>{{ __('No') }}</td>
                                                        <td>{{ __('NA') }}</td>
                                                        <td>{{ __('NA') }}</td>
                                                    @endif

                                                    @php
                                                        $Joined = '';
                                                        $cmid = '';
                                                        $desig = '';
                                                        $empLocation = '';
                                                        $queryData = getDataByQuery($intId, $processOne, $createdOn);
                                                    @endphp
                                                    @if ($queryData > 0 && $queryData && $processOne != '')
                                                        <td>{{ $queryData[0]['Joined Y/N'] }}</td>
                                                        <td>{{ $queryData[0]['EmployeeID'] }}</td>
                                                        <td>{{ $queryData[0]['Salary CTC'] }}</td>
                                                        <td>{{ $queryData[0]['Current Active (Y/N)'] }}</td>

                                                        @php
                                                            $Joined = $queryData[0]['Joined Y/N'];
                                                            $cmid = $queryData[0]['cm_id'];
                                                            $desig = $queryData[0]['desig'];
                                                            $empLocation = $queryData[0]['location'];
                                                        @endphp
                                                    @else
                                                        <td>{{ __('No') }}</td>
                                                        <td>{{ __('NA') }}</td>
                                                        <td>{{ __('NA') }}</td>
                                                        <td>{{ __('No') }}</td>
                                                    @endif

                                                    @php
                                                        $amount = '';
                                                        $fpay = '';
                                                        $spay = '';
                                                        $window_month = '';
                                                        $fpayDate = '';
                                                        $spayDate = '';
                                                        $queryPayData = getPayDataByQuery($desig, $cmid, $createdOn);
                                                    @endphp
                                                    @if ($queryPayData > 0 && $queryPayData)
                                                        <td>{{ $queryPayData[0]['amount'] }}</td>
                                                        <td>{{ $queryPayData[0]['1st_pay'] }}</td>
                                                        <td>{{ $queryPayData[0]['2nd_pay'] }}</td>
                                                        <td>{{ $queryPayData[0]['window_month'] }}</td>
                                                        @php
                                                            $des_id = '';
                                                            $queryData2 = getData($EmployeeID);
                                                        @endphp
                                                        @if ($queryPayData2 > 0 && $queryPayData2)
                                                            <td>{{ $queryPayData2[0]['des_id'] }}</td>
                                                        @endif
                                                        @php
                                                            $datediff = strtotime($WalkinDate) - strtotime($createdOn);
                                                        @endphp
                                                        @if (
                                                            $Joined == '' or
                                                                ($des_id == '5' or
                                                                    $des_id == '7' or
                                                                    $des_id == '8' or
                                                                    $des_id == '10' or
                                                                    $des_id == '13' or
                                                                    $des_id == '14' or
                                                                    $des_id == '15' or
                                                                    $des_id == '16') or
                                                                round($datediff / (60 * 60 * 24)) < 0 and round($datediff / (60 * 60 * 24)) > 14 or
                                                                $amount == '')
                                                            @php $amount = 'NA'; @endphp
                                                        @endif
                                                        @if (
                                                            $Joined == '' or
                                                                ($des_id == '5' or
                                                                    $des_id == '7' or
                                                                    $des_id == '8' or
                                                                    $des_id == '10' or
                                                                    $des_id == '13' or
                                                                    $des_id == '14' or
                                                                    $des_id == '15' or
                                                                    $des_id == '16') or
                                                                round($datediff / (60 * 60 * 24)) < 0 and round($datediff / (60 * 60 * 24)) > 14 or
                                                                $fpay == '')
                                                            @php $fpay = 'NA'; @endphp
                                                        @endif
                                                        @php
                                                            $window_month = intval($window_month) + intval(1);
                                                        @endphp
                                                        @if (
                                                            $Joined == '' or
                                                                ($des_id == '5' or
                                                                    $des_id == '7' or
                                                                    $des_id == '8' or
                                                                    $des_id == '10' or
                                                                    $des_id == '13' or
                                                                    $des_id == '14' or
                                                                    $des_id == '15' or
                                                                    $des_id == '16') or
                                                                round($datediff / (60 * 60 * 24)) < 0 and round($datediff / (60 * 60 * 24)) > 14 or
                                                                $fpay == '')
                                                            @php $fpayDate = 'NA'; @endphp
                                                        @else
                                                            @php $fpayDate = date('Y-m-15', strtotime($DOJ . '+' . $window_month . ' month')); @endphp
                                                        @endif
                                                        @if (
                                                            $Joined == '' or
                                                                ($des_id == '5' or
                                                                    $des_id == '7' or
                                                                    $des_id == '8' or
                                                                    $des_id == '10' or
                                                                    $des_id == '13' or
                                                                    $des_id == '14' or
                                                                    $des_id == '15' or
                                                                    $des_id == '16') or
                                                                round($datediff / (60 * 60 * 24)) < 0 and round($datediff / (60 * 60 * 24)) > 14 or
                                                                $spay == '')
                                                            @php $spay = 'NA'; @endphp
                                                        @endif
                                                        @if (
                                                            $Joined == '' or
                                                                $spay == '' or
                                                                $spay == '0' or
                                                                ($des_id == '5' or
                                                                    $des_id == '7' or
                                                                    $des_id == '8' or
                                                                    $des_id == '10' or
                                                                    $des_id == '13' or
                                                                    $des_id == '14' or
                                                                    $des_id == '15' or
                                                                    $des_id == '16') or
                                                                round($datediff / (60 * 60 * 24)) < 0 and round($datediff / (60 * 60 * 24)) > 14 or
                                                                $spay == '')
                                                            @php $spayDate = 'NA'; @endphp
                                                        @else
                                                            @php $window_month = intval($window_month) + intval(1); @endphp
                                                            @php $spayDate = date('Y-m-15', strtotime($DOJ . '+' . $window_month . ' month')); @endphp
                                                        @endif
                                                    @else
                                                        @php
                                                            $amount = 'NA';
                                                            $fpay = 'NA';
                                                            $spay = 'NA';
                                                            $fpayDate = 'NA';
                                                            $spayDate = 'NA';
                                                            $empLocation = 'NA';
                                                        @endphp
                                                    @endif
                                                    <td>{{ $amount }}</td>
                                                    <td>{{ $fpay }}</td>
                                                    <td>{{ $fpayDate }}</td>
                                                    <td>{{ $spay }}</td>
                                                    <td>{{ $spayDate }}</td>
                                                    <td>{{ $empLocation }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>
</div>




@endsection
<script src="{{ asset('utills/dist/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('utills/dist/assets/js/scripts.bundle.js') }}"></script>
<script>
    $(function() {

        var table = $('#registrationList').DataTable({
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
