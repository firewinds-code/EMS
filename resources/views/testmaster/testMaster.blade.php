@extends('includes.master')
@section('content')
@section('page-title', 'Test Master')
@section('page-heading', ' Manage Test Master')
<div id="kt_app_content" class="app-content flex-column-fluid">

    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card">
            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Master Details" />
                    </div>
                </div>

                <div class="card-toolbar">
                    <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_customer">Add Test Master</button>
                    </div>
                </div>
                <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                    <button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <i class="ki-duotone ki-exit-down fs-2"><span class="path1"></span><span class="path2"></span></i>
                        Export
                    </button>
                    <div id="kt_datatable_example_export_menu" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4" data-kt-menu="true">
                        <div class="menu-item px-3">
                            {{--  <a href="#" class="menu-link px-3" data-kt-export="excel">
                                Export as Excel
                            </a>  --}}
                        </div>
                        <div class="menu-item px-3">
                            {{--  <a href="#" class="menu-link px-3" data-kt-export="csv">
                                Export as CSV
                            </a>  --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body pt-0">
                <div id="test_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer" id="test_table">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th>Sr.No</th>
                                    <th>Test</th>
                                    <th>Client</th>
                                    <th>Process</th>
                                    <th>Sub Process</th>
                                    <th>File Name</th>
                                    <th>Location</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @foreach($datas as $data)
                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <td>{{ $i++}}</td>
                                    <td>{{ $data->cert_name}}</td>
                                    <td>{{ $data->client_name}}</td>
                                    <td>{{ $data->process}}</td>
                                    <td>{{ $data->sub_process}}</td>
                                    <td>{{ $data->filename}}</td>
                                    <td>{{ $data->location}}</td>
                                    <td><button onclick="edittestModal('{{ $data->id }}','{{ $data->cert_name }}','{{ $data->process }}','{{ $data->sub_process }}','{{ $data->filename }}','{{ $data->location }}')" class="btn btn-link edit-test" data-bs-toggle="modal" data-bs-target="#kt_modal_edit_details" id="{{ $data->cm_id}}"><i class="bi bi-pencil-square text-success"></i></button></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="kt_modal_add_customer" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered mw-650px">

        <div class="modal-content">

            <form class="form fv-plugins-bootstrap5 fv-plugins-framework" action="{{route('addtest') }}" method="post" id="kt_modal_add_test_form" data-kt-redirect="">
                @csrf
                <div class="modal-header" id="kt_modal_add_customer_header">
                    <h4> Add Test Master</h4>
                    <div id="kt_modal_add_customer_close" class="btn btn-icon btn-sm btn-active-icon-primary">
                    </div>
                </div>
                <div class="modal-body py-10 px-lg-17">
                    <div class="row g-9 mb-8" id="medit">

                        <div class="col-lg-6 fv-row">
                            <label class="fs-6 fw-semibold"><span class="required">Select
                                    <span>Location</span>
                            </label>
                            <div class="col-md-12">
                                <select class="form-select" data-control="select2" data-placeholder="Select an option" data-allow-clear="true" name="location" id="location">
                                    @foreach ($results as $list)
                                    <option></option>
                                    <option value="{{ $list->id }}">{{ $list->location }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="col-md-6 fv-row">
                            <label for="exampleFormControlInput1" class="form-label">
                                <span class="required">Process</span>
                            </label>
                            <select data-control="select2" data-placeholder="Select an option" data-allow-clear="true" class="form-select" name="process" id="process">
                            </select>
                        </div>

                        <div class="col-md-6 fv-row">
                            <label for="exampleFormControlInput1" class="form-label">
                                <span class="required">Test Name</span>
                            </label>
                            <div class="col-lg-10 fv-row">

                                <input type="text" class="form-control" id="test1" name="test" />
                            </div>
                        </div>


                        <div class="col-md-6 fv-row">
                            <label for="exampleFormControlInput1" class="form-label">
                                <span class="required">Test File Name(without Space) </span>
                            </label>
                            <div class="col-lg-10 fv-row">
                                <input type="text" class="form-control" id="testfile1" name="testfile" />
                            </div>
                        </div>
                    </div>



                    <div class="modal-footer flex-center">
                        <button type="reset" id="cancel" data-bs-dismiss="modal" class="btn btn-light me-3">Cancel</button>
                        <button type="submit" id="submit" class="btn btn-primary">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
            </form>

        </div>
    </div>
</div>
</div>
<!--end::Content container-->

<div class="modal fade" id="kt_modal_edit_details" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <form class="form fv-plugins-bootstrap5 fv-plugins-framework" id="editForm" class="kt_modal_edit_details_form">
                @csrf
                <div class="modal-header" id="kt_modal_edit_details">
                    <h4> Edit Test Master</h4>
                    <div id="kt_modal_edit_details" class="btn btn-icon btn-sm btn-active-icon-primary">
                    </div>
                </div>
                <div class="modal-body py-10 px-lg-17">
                    <div class="row g-9 mb-8">
                        <div class="col-lg-6 fv-row">
                            <label class="fs-6 fw-semibold"><span class="required">Select
                                    <span>Location</span>
                            </label>
                            <div class="col-md-12">
                                <select class="form-select" data-control="select2" data-placeholder="Select an option" data-allow-clear="true" name="location" id="location1">
                                    @foreach ($results as $list)
                                    <option></option>
                                    <option value="{{ $list->id }}">{{ $list->location }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 fv-row">
                            <label for="exampleFormControlInput1" class="form-label">
                                <span class="required">Process</span>
                            </label>
                            <select data-control="select2" data-placeholder="Select an option" data-allow-clear="true" class="form-select" name="processtest" id="processtest">
                            </select>
                        </div>

                        <div class="col-md-6 fv-row">
                            <label for="exampleFormControlInput1" class="form-label">
                                <span class="required">Test Name</span>
                            </label>
                            <div class="col-lg-10 fv-row">

                                <input type="text" class="form-control" id="test" name="test" />
                            </div>
                        </div>


                        <div class="col-md-6 fv-row">
                            <label for="exampleFormControlInput1" class="form-label">
                                <span class="required">Test File Name(without Space) </span>
                            </label>
                            <div class="col-lg-10 fv-row">
                                <input type="text" class="form-control" id="testfile" name="testfile" />
                            </div>
                        </div>
                    </div>
                    <input type='hidden' name='id' id='id'>
                    <button type="reset" id="cancel" data-bs-dismiss="modal" class="btn btn-light me-3">Cancel</button>
                    <button type="submit" id="submit" class="btn btn-primary">
                        <span class="indicator-label">Update</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
<script src="{{ asset('utills/dist/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('utills/dist/assets/js/scripts.bundle.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(function() {
        $.ajax({
            url: "{{ route('processtest') }}",
            type: "post",
            data: {
                "_token": "{{ csrf_token() }}",
                location_val: 1,
            },
            success: function(result) {
                $("#processtest").empty();
                $('#processtest').append('<option value="' + '">' + ' Select' + '</option>');
                for (val in result) {
                    var newOption = $('<option value="' + result[val]['cm_id'] + '">' + result[val][
                        'Process'
                    ] + '</option>');
                    $('#processtest').append(newOption);
                }
            }
        });

        $('.edit-test').on('click', function() {
            var testId = $(this).attr('id');
            $.get("{{ url('edit-test')}}" + '/' + testId, function(response) {
                $('#test').val(response.testrow.cert_name);
                $('#location1').val(response.testrow.locationid).select2();
                $('#testfile').val(response.testrow.filename)
                $('#processtest').val(response.testrow.cm_id).select2();
                $('#id').val(response.testrow.ID)
            });
        });
        $(function() {
            $('#editForm').on('submit', function(event) {
                event.preventDefault();
                $('.error-message').remove();
                let isValid = true;
                var form = $('#editForm').serialize();
                var url = "{{route('update')}}";

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
            });
        });
    });
</script>

<script>
    // ADD //
    $(function() {
        $("#location").on(' change', function() {
            var location_val = $(this).val();
            location_ajax(location_val);
        });
    });


    // Edit //
    $(function() {
        $("#location1").on(' change', function() {
            var location_val = $(this).val();
            location_ajax2(location_val);
        });
    });


    //   Get Process For ADD //
    function location_ajax(location_val) {
        $.ajax({
            url: "{{ route('processtest') }}",
            type: "post",
            data: {
                "_token": "{{ csrf_token() }}",
                location_val: location_val,
            },
            success: function(response) {
                $("#process").empty();
                $('#process').append('<option value="' + '">' + ' Select' + '</option>');
                for (val in response) {
                    var newOption = $('<option value="' + response[val]['cm_id'] + '">' + response[val][
                        'Process'
                    ] + '</option>');
                    $('#process').append(newOption);
                }
            }
        });
    }
    // For Validation

    $(document).ready(function() {
        $('#kt_modal_add_test_form').submit(function(event) {
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

    $(document).ready(function() {
        $('#kt_modal_edit_details').submit(function(event) {
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

    $(document).ready(function() {
        var table = $('#test_table').DataTable({
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
            }).container().appendTo($('#kt_datatable_example_export_menu'));
            const exportButtons = document.querySelectorAll(
                '#kt_datatable_example_export_menu [data-kt-export]');
            exportButtons.forEach(exportButton => {
                exportButton.addEventListener('click', e => {
                    e.preventDefault();


                    const exportValue = e.target.getAttribute('data-kt-export');
                    const target = document.querySelector('.dt-buttons .buttons-' +
                        exportValue);
                    target.click();
                });
            });
        };
        exportButtons();
        const filterSearch = document.querySelector('[data-kt-filter="search"]');
        filterSearch.addEventListener('keyup', function(e) {
            table.search(e.target.value).draw();
        });
    });
</script>
