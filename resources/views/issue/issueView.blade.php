@extends('includes.master')
@section('content')
@section('page-title', 'Issue Master Details')
@section('page-heading', 'Issue Master Details')

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
                        <input type="text" data-kt-filter="search"
                            class="form-control form-control-solid w-250px ps-14" placeholder="Search Master Details" />
                    </div>
                </div>

                <div class="card-toolbar">
                    <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                        <button type="button" class="btn btn-primary add-details" data-bs-toggle="modal"
                            data-bs-target="#kt_modal_add_details">Add Details</button>
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
                            id="issueDetailsTbale">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="text-center min-w-90px sorting_disabled">Manage Issue</th>
                                    <th class="min-w-125px sorting">Issue ID</th>
                                    <th class="min-w-125px sorting">Issue</th>
                                    <th class="min-w-125px sorting">Belongs To</th>
                                    <th class="min-w-125px sorting">Handler Name</th>
                                    <th class="min-w-125px sorting">TAT
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="fw-semibold text-gray-600">

                                @if (!@empty($results))

                                    @foreach ($results as $result)
                                        <tr class="even">
                                            <td>

                                                <button class="btn btn-link">
                                                    <a onclick="editModal(this)" data-bs-toggle="modal"
                                                        data-bs-target="#kt_modal_edit_details"
                                                        class="menu-link px-3 edit-issue">
                                                        <i class="bi bi-pencil-square text-success">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </a>
                                                </button>

                                            </td>

                                            <td id="id">{{ $result->id }}</td>
                                            <td>{{ $result->queary }}</td>
                                            <td>{{ $result->bt }}</td>
                                            <td>{{ $result->EmployeeName }}</td>
                                            <td>{{ $result->tat }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal fade" id="kt_modal_add_details" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered mw-950px">
                        <div class="modal-content">
                            <form class="form fv-plugins-bootstrap5 fv-plugins-framework" action="{{ url('issueAdd') }}"
                                method="post" id="kt_modal_add_issue_form" data-kt-redirect="">
                                @csrf
                                <div class="modal-header" id="kt_modal_add_email_header">
                                    <h2 class="fw-bold">Add Issue</h2>
                                    <div id="kt_modal_add_email_close"
                                        class="btn btn-icon btn-sm btn-active-icon-primary">
                                    </div>
                                </div>

                                <div class="modal-body py-10 px-lg-17">
                                    <div class="scroll-y me-n7 pe-7" id="kt_modal_add_email_scroll"
                                        data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                                        data-kt-scroll-max-height="auto"
                                        data-kt-scroll-dependencies="#kt_modal_add_email_header"
                                        data-kt-scroll-wrappers="#kt_modal_add_email_scroll"
                                        data-kt-scroll-offset="300px" style="">
                                        <div class="row g-9 mb-10">
                                            <div class="col-lg-6 fv-row">
                                                <label for="Issue" class="fs-6 fw-semibold"><span
                                                        class="required">Issue</span></label>
                                                <input type="text" class="form-control" id="issue"
                                                    name="issue" placeholder="Enter Issue" />
                                            </div>
                                            <div class="col-lg-6 fv-row">
                                                <label class="fs-6 fw-semibold"><span class="required">Belongs
                                                        To</span></label>
                                                <div class="col-md-12">
                                                    <select name="belongto" id="belongto"
                                                        aria-label="Select Belong To" data-control="select2"
                                                        class="form-select mb-2 Belong To">
                                                        <option value="">Select Belong To</option>
                                                        <option value="Human Resource">Human Resource</option>
                                                        <option value="Information Technology">Information Technology
                                                        </option>
                                                        <option value="Operation">Operation</option>
                                                        <option value="Administration">Administration</option>
                                                        <option value="Attendance">Attendance</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 fv-row">
                                                <label class="fs-6 fw-semibold"><span class="required">Handler
                                                        To</span></label>
                                                <div class="col-md-12">
                                                    <select name="handlerto" id="handlerto"
                                                        aria-label="Select Handler To" data-control="select2"
                                                        class="form-select mb-2 Handler To">
                                                        <option value="">Select Handler To</option>
                                                        <option value="CE03070003">Sachin Siwach</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 fv-row">
                                                <label class="fs-6 fw-semibold"><span
                                                        class="required">TAT</span></label>
                                                <div class="col-md-12">
                                                    <select name="tat" id="tat" aria-label="Select TAT"
                                                        data-control="select2" class="form-select mb-2 TAT">
                                                        <option value="">Select TAT</option>
                                                        @for ($i = 1; $i <= 72; $i++)
                                                            <option value="{{ $i }}">{{ $i }}
                                                                Hour</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer flex-center">
                                    <button type="button" class="btn btn-light"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" id="kt_modal_add_submit" class="btn btn-primary">
                                        <span class="indicator-label">Submit</span>
                                        <span class="indicator-progress" style="display: none;">
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="kt_modal_edit_details" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered mw-950px">
                        <div class="modal-content">
                            <form class="form fv-plugins-bootstrap5 fv-plugins-framework" id="editIssueForm">
                                @csrf

                                <div class="modal-header" id="kt_modal_add_email_header">
                                    <h2 class="fw-bold">Manage Issue</h2>
                                    <div id="kt_modal_add_email_close"
                                        class="btn btn-icon btn-sm btn-active-icon-primary">
                                    </div>
                                </div>
                                <div class="modal-body py-10 px-lg-17">
                                    <div class="scroll-y me-n7 pe-7" id="kt_modal_add_email_scroll"
                                        data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                                        data-kt-scroll-max-height="auto"
                                        data-kt-scroll-dependencies="#kt_modal_add_email_header"
                                        data-kt-scroll-wrappers="#kt_modal_add_email_scroll"
                                        data-kt-scroll-offset="300px" style="">
                                        <div class="row g-9 mb-10">

                                            <div class="col-lg-6 fv-row">
                                                <input type="text" name="id_edit" id="id_edit" hidden>
                                                <label for="Issue" class="fs-6 fw-semibold"><span
                                                        class="required">Issue</span></label>
                                                <input type="text" class="form-control" id="query"
                                                    name="query" placeholder="Enter Issue" />
                                            </div>
                                            <div class="col-lg-6 fv-row">
                                                <label class="fs-6 fw-semibold"><span class="required">Belongs
                                                        To</span></label>
                                                <div class="col-md-12">
                                                    <select name="belong_to" id="belong_to"
                                                        aria-label="Select Belong To" data-control="select2"
                                                        class="form-select mb-2 Belong To">
                                                        <option value="">Select Belong To</option>
                                                        <option value="Human Resource">Human Resource</option>
                                                        <option value="Information Technology">Information Technology
                                                        </option>
                                                        <option value="Operation">Operation</option>
                                                        <option value="Administration">Administration</option>
                                                        <option value="Attendance">Attendance</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 fv-row">
                                                <label class="fs-6 fw-semibold"><span class="required">Handler
                                                        To</span></label>
                                                <div class="col-md-12">
                                                    <select name="handler_to" id="handler_to_cal"
                                                        aria-label="Select Handler To" data-control="select2"
                                                        class="form-select mb-2 Handler To">
                                                        <option value="">Select Handler To</option>
                                                        <option value="CE03070003">Sachin Siwach</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-lg-6 fv-row">
                                                <label class="fs-6 fw-semibold"><span
                                                        class="required">TAT</span></label>
                                                <div class="col-md-12">
                                                    <select name="tat_edit" id="tat_edit" aria-label="Select TAT"
                                                        data-control="select2" class="form-select mb-2 TAT">
                                                        <option value="">Select TAT</option>
                                                        @for ($i = 1; $i <= 72; $i++)
                                                            <option value="{{ $i }}">{{ $i }}
                                                                Hour</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer flex-center">
                                    <button type="button" class="btn btn-light"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" id="kt_modal_edit_submit" class="btn btn-primary">
                                        <span class="indicator-label">Submit</span>
                                        <span class="indicator-progress" style="display: none;">
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<script src="{{ asset('utills/dist/assets/plugins/global/plugins.bundle.js') }}"></script>
{{-- <script src="{{ asset('utills/dist/assets/js/scripts.bundle.js') }}"></script> --}}
<script src=" {{ asset('utills/dist/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('utills/src/customeJs/custome.js') }}"></script>
<script>
    $(document).ready(function() {

        var table = $('#issueDetailsTbale').DataTable({
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

<script>
    $(document).ready(function() {
        $("#kt_modal_new_target_submit .indicator-progress").show();
        $('#kt_modal_add_issue_form').on('submit', function(event) {

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


<script>
    function editModal(id) {

        var tr = $(id).closest('tr');
        var id = tr.find('#id').text();
        $.ajax({
            type: "get",
            url: "{{ route('issueUpdate') }}",
            data: {
                "id": id
            },
            success: function(response) {

                $('#id_edit').val(response.data.id);
                $('#query').val(response.data.queary);
                $('#belong_to').val(response.data.bt).select2();
                $('#handler_to_cal').val(response.data.handler).select2();
                $('#tat_edit').val(response.data.tat).select2();

            }
        });
    }

    $(function() {
        $('#editIssueForm').on('submit', function(event) {

            event.preventDefault();



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

                var url = "{{ route('issueSave') }}";
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
    });
</script>
