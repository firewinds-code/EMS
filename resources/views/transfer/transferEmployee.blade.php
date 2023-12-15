@extends('includes.master')
@section('content')
@section('page-title', 'Employee Transfer')
@section('page-heading', 'Employee Transfer')
<style>
    .overlay {
       position: fixed;
       top: 0;
       left: 0;
       width: 100%;
       height: 100%;
       background-color: rgba(0, 0, 0, 0.6);
       z-index: 1000;
       display: none;
    }
 </style>
 <div class="overlay" id="pageOverlay"></div>

<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card cardOutline">
            <div class="card-header border-0 pt-6">
                <form action="{{ route('transfer.search') }}" method="POST" id="search">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5"></i>
                                <input type="text" data-kt-customer-table-filter="search"
                                    class="form-control form-control-solid w-250px ps-13"
                                    placeholder="Search Employee ID"
                                    value="{{ old('employee_id') ?? ($results->EmployeeID ?? '') }}" name="employee_id"
                                    id="employee_id">
                            </div>
                        </div>
                        <div class=" col-md-6 col-lg-6">
                            <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                                <button type="submit" value="search" name="report_search" id="report_search"
                                    class="btn btn-primary">
                                    <span class="indicator-label">
                                        Search
                                    </span>

                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            @if (!@empty($results))
                <div class="card-body pt-0">
                    <div id="kt_customers_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer"
                                id="kt_customers_table">
                                <thead>
                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="min-w-125px sorting">Employee ID </th>
                                        <th class="min-w-125px sorting">Name</th>
                                        <th class="min-w-125px sorting">Designation</th>
                                        <th class="min-w-125px sorting">Process</th>
                                        <th class="min-w-125px sorting">Sub Process</th>
                                        <th class="min-w-125px sorting">Location</th>
                                        <th class="min-w-125px sorting">Report To</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                    <tr class="even">
                                        <td>{{ $results->EmployeeID }}</td>
                                        <td>{{ $results->EmployeeName }}</td>
                                        <td>{{ $results->designation }}</td>
                                        <td>{{ $results->process }}</td>
                                        <td>{{ $results->subprocess }}</td>
                                        <td>{{ $results->location }}</td>
                                        <td>{{ $results->ReportTo }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <br>
                    <form action="{{ url('save') }}" method="POST" id="saveData" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="employeeid"
                            value="@if (isset($results->EmployeeID)) {{ $results->EmployeeID }} @endif ">
                        <div class="row g-9 mb-8">
                            <div class="col-lg-6 fv-row">
                                <label class="fs-6 fw-semibold"><span class="required">Select
                                        Location</span></label>
                                <div class="col-md-12">
                                    <select name="location" id="location" aria-label="Select a Location"
                                        data-control="select2" class="form-select mb-2 location">
                                        <option value="">Select a Location</option>
                                        @if (isset($location))
                                            @foreach ($location as $list)
                                                <option value="{{ $list->id }}">{{ $list->location }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 fv-row">
                                <label class="fs-6 fw-semibold"><span class="required">Select Client</span></label>
                                <div class="col-md-12">
                                    <select name="client" id="client" aria-label="Select a Client"
                                        data-control="select2" data-placeholder="Select a Client..."
                                        class="form-select mb-2">
                                        <option value="">Select a Client</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row g-9 mb-8">
                            <div class="col-lg-6 fv-row">
                                <label class="fs-6 fw-semibold"><span class="required">Select Process</span></label>
                                <div class="col-md-12">
                                    <select name="process" id="process" aria-label="Select a Process"
                                        data-control="select2" data-placeholder="Select a Process..."
                                        class="form-select mb-2">
                                        <option value="">Select a Process</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 fv-row">
                                <label class="fs-6 fw-semibold"><span class="required">Select Sub
                                        Process</span></label>
                                <div class="col-md-12">
                                    <select name="subprocess" id="subprocess" aria-label="Select a Sub Process"
                                        data-control="select2" data-placeholder="Select a Sub Process..."
                                        class="form-select mb-2">
                                        <option value="">Select a Sub Process</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row g-9 mb-8">
                            <div class="col-lg-6 fv-row">
                                <label class="fs-6 fw-semibold"><span class="required">Reports To</span></label>
                                <div class="col-md-12">
                                    <select name="ReportTo" id="ReportTo" aria-label="Select Reports To"
                                        data-control="select2" data-placeholder="Select Reports To..."
                                        class="form-select mb-2">
                                        <option value="">Select Report To</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 fv-row">
                                <label class="fs-6 fw-semibold"><span class="required">Transfer Date</span></label>
                                <div class="col-md-12">
                                    <div class="position-relative d-flex align-items-center">
                                        
                                        <input class="form-control" placeholder=" Pick a date" id="kt_datepicker_1"
                                            name="transfer_date" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" id="submit" class="btn btn-primary">
                                <span class="indicator-label">Transfer</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection


<script src="{{ asset('utills/dist/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('utills/dist/assets/js/scripts.bundle.js') }}"></script>
<script>
    $(function() {
        $(".location").on('change', function() {
            var location_val = $(this).val();

            location_ajax(location_val);
        });
    });

    function location_ajax(location_val) {
        $.ajax({
            url: "{{ route('clientname') }}",
            type: "post",
            data: {
                "_token": "{{ csrf_token() }}",
                location_val: location_val,
            },
            success: function(response) {
                $("#client").empty();
                $('#client').append('<option value="' + '">' + ' Select a client ' + '</option>');
                for (val in response) {
                    var newOption = $('<option value="' + response[val]['client_id'] + '">' + response[val][
                        'client_name'
                    ] + '</option>');
                    $('#client').append(newOption);
                }
            }
        });
    }

    $(function() {
        $("#client").on('change', function() {
            var client_val = $(this).val();

            client_ajax(client_val);
        });
    });

    function client_ajax(client_val) {
        $.ajax({
            url: "{{ route('process') }}",
            type: "post",
            data: {
                "_token": "{{ csrf_token() }}",
                client_val: client_val,
                location_val: $('#location').val(),
            },
            success: function(response) {
                $("#process").empty();
                $('#process').append($('<option value="' + '">' + ' Select Process ' + '</option>'));
                for (val in response) {
                    var newOption = $('<option value="' + response[val]['process'] + '">' + response[val][
                        'process'
                    ] + '</option>');
                    $('#process').append(newOption);
                }
            },
        });
    }

    $(function() {
        $("#process").on('change', function() {
            var process_val = $(this).val();

            process_ajax(process_val);
        });
    });

    function process_ajax(process_val) {
        $.ajax({
            url: "{{ route('subprocess') }}",
            type: "post",
            data: {
                "_token": "{{ csrf_token() }}",
                process_val: process_val,
                location_val: $('#location').val(),
            },
            success: function(response) {
                $("#subprocess").empty();
                $('#subprocess').append($('<option value="' + '">' + ' Select Sub Process ' + '</option>'));
                for (val in response) {
                    var newOption = $('<option value="' + response[val]['sub_process'] + '">' + response[
                        val]['sub_process'] + '</option>');
                    $('#subprocess').append(newOption);
                }
            },
        });
    }

    $(function() {
        $("#subprocess").on('change', function() {
            var subprocess_val = $(this).val();

            subprocess_ajax(subprocess_val);
        });
    });

    function subprocess_ajax(subprocess_val) {
        $.ajax({
            url: "{{ route('reportTo') }}",
            type: "post",
            data: {
                "_token": "{{ csrf_token() }}",
                subprocess_val: subprocess_val,
                client_val: $('#client').val(),
                location_val: $('#location').val(),
                employee_id_val: $('#employee_id').val(),
            },
            success: function(response) {
                $("#ReportTo").empty();
                $('#ReportTo').append($('<option value="' + '">' + ' Select Report To ' + '</option>'));
                for (val in response) {
                    var newOption = $('<option value="' + response[val]['EmployeeID'] + '">' + response[
                        val]['EmpName'] + '</option>');
                    $('#ReportTo').append(newOption);
                }
            },
        });
    }
</script>


<script>
    $(document).ready(function() {
        $('#saveData').submit(function(event) {
            event.preventDefault();
            $('.error-message').remove();
            let isValid = true;

            $(this).find('.required').each(function() {
                const input = $(this).closest('.fv-row').find(
                    '.form-control, select');
                if (!input.val()) {
                    isValid = false;
                    const fieldName = $(this).text();
                    const errorMessage = fieldName + ' is required.';
                    $('<div class="error-message text-danger">' + errorMessage + '</div>')
                        .insertAfter(input);
                }
            });

            if (isValid == true) {
                var url = $(this).attr('action');
                var form = $(this).serialize();
                $.post(url, form, function(response) {
                    if (response.success) {
                        toastr.success(response.message, "Success", {
                            toastClass: "toast-success",
                            progressBar: true
                        });
                        location.reload();
                    } else {
                        toastr.error(response.message, "Error", {
                            toastClass: "toast-error",
                            progressBar: true
                        });
                    }
                });
            } else {
                return false;
            }
        });
    })
</script>
