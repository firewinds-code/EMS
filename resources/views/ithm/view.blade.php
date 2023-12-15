@extends('includes.master')
@section('content')
@section('page-title', 'IT Help Desk')
@section('page-heading', 'IT Help Desk')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card">
            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                <!--begin::Card title-->
                <div class="card-title">
                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <input type="text" data-kt-filter="search"
                            class="form-control form-control-solid w-250px ps-14" placeholder="Search Report" />
                    </div>
                    <!--end::Search-->
                </div>
                <!--end::Card title-->

                <div class="card-toolbar">
                    <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#kt_modal_add_email">Add Email</button>
                    </div>
                </div>

                <!--begin::Card toolbar-->
                <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                    <!--begin::Export dropdown-->
                    <button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click"
                        data-kt-menu-placement="bottom-end">
                        <i class="ki-duotone ki-exit-down fs-2"><span class="path1"></span><span
                                class="path2"></span></i>
                        Export
                    </button>
                    <!--begin::Menu-->
                    <div id="kt_datatable_example_export_menu"
                        class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4"
                        data-kt-menu="true">
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
                    <div id="kt_datatable_example_buttons" class="d-none"></div>
                    <!--end::Hide default export buttons-->
                </div>
                <!--end::Card toolbar-->
            </div>

            <div class="card-body pt-0">
                <div id="kt_customers_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer"
                            id="it_help_desk_table">

                            <thead>
                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="text-end min-w-70px sorting_disabled">Delete</th>
                                    <th class="min-w-125px sorting">S No</th>
                                    <th class="min-w-125px sorting">ID</th>
                                    <th class="min-w-125px sorting">Email</th>
                                    <th class="min-w-125px sorting">Email Type</th>
                                    <th class="min-w-125px sorting">Location</th>
                                    <th class="min-w-125px sorting">Created By</th>
                                    <th class="min-w-125px sorting">Created Date</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                @if (!@empty($results))
                                    @php  $i = 1; @endphp
                                    @foreach ($results as $result)
                                        <tr class="even">
                                            <td>
                                                <button onclick="deleteEmail('{{ $result->id }}')"
                                                    class="btn btn-link">
                                                    <i class="bi bi-trash text-danger"></i>
                                                </button>
                                            </td>
                                            <td>{{ $i }}</td>
                                            <td>{{ $result->id }}</td>
                                            <td>{{ $result->email }}</td>
                                            <td>{{ $result->emailType }}</td>
                                            <td>{{ $result->location }}</td>
                                            <td>{{ $result->createdBy }}</td>
                                            <td>{{ $result->createdDate }}</td>
                                        </tr>
                                        @php  $i++; @endphp
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal fade" id="kt_modal_add_email" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered mw-950px">
                        <div class="modal-content">
                            <form class="form fv-plugins-bootstrap5 fv-plugins-framework"
                                action="{{ route('saveEmail') }}" method="post" id="kt_modal_add_email_form"
                                data-kt-redirect="">
                                @csrf
                                <div class="modal-header" id="kt_modal_add_email_header">
                                    <h2 class="fw-bold">Add a Email</h2>
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
                                            <div class="row-md-8 fv-row">
                                                <label class="form-label" for="flexCheckDefault">
                                                    <span>Location</span>
                                                </label>
                                                <div class="invalid-feedback" id="locaErr">
                                                    Please select Location
                                                </div>
                                                <div class="form-check" name="location[]" id="location">
                                                    <input class="form-check-input locations-checked" type="checkbox"
                                                        value="" />
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2"
                                                        for="flexCheckDefault">

                                                        <span>All &nbsp;</span>
                                                        @foreach ($data as $key => $value)
                                                            <div class="form-check">
                                                                <input class="form-check-input locations"
                                                                    name="locations[]" type="checkbox"
                                                                    value="{{ $value->location }}" />
                                                                <span>{{ $value->location }} &nbsp;</span>
                                                            </div>
                                                        @endforeach
                                                    </label>

                                                </div>
                                            </div>
                                            <div class="col-lg-6 fv-row">
                                                <label class="fs-6 fw-semibold"><span class="required">Email
                                                        Type</span></label>
                                                <div class="col-md-12">
                                                    <select name="emailType" id="emailType"
                                                        aria-label="Select Email Type" data-control="select2"
                                                        data-placeholder="Select Email Type..."
                                                        class="form-select mb-2">
                                                        <option value="">Select Email Type</option>
                                                        <option value="TO">TO</option>
                                                        <option value="CC">CC</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 fv-row">
                                                <label class="fs-6 fw-semibold"><span
                                                        class="required">Email</span></label>
                                                <input type="text" class="form-control" name="email"
                                                    id="email" placeholder="Enter Email" aria-label="Username"
                                                    aria-describedby="basic-addon1" />
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer flex-center">
                                    <button type="button" class="btn btn-light"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" id="kt_modal_add_email_submit" class="btn btn-primary">
                                        <span class="indicator-label">Submit</span>
                                        <span class="indicator-progress">Please wait...
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
<script src="{{ asset('utills/dist/assets/js/scripts.bundle.js') }}"></script>


<script>
    $(document).ready(function() {
        var table = $('#it_help_desk_table').DataTable({
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



<script>
    $(function() {
        $('.locations-checked').on('change', function() {
            if ($(this).is(":checked")) {
                $('.locations').attr("checked", true);
            } else {
                $('.locations').attr("checked", false);
            }
        });
    });

    function deleteEmail(email_id) {
        if (confirm("Are You Sure Want To Delete Email")) {
            $.get('delete-email/' + email_id, function(response) {
                if (response.success) {
                    toastr.success(response.message, "", {
                        toastClass: "toast-success",
                        progressBar: true
                    });
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }
                else {
                        toastr.error(response.message, "Error", {
                            toastClass: "toast-error",
                            progressBar: true
                        });
                    }
            });
        }
    }

    $(document).ready(function() {
        $('#kt_modal_add_email_form').submit(function(event) {
            event.preventDefault();
            $('.error-message').remove();
            let isValid = true;

            $(this).find('.required').each(function() {
                const input = $(this).closest('.fv-row').find(
                    '.form-control, select, check');
                if (!input.val()) {
                    isValid = false;
                    const fieldName = $(this).text();
                    const errorMessage = fieldName + ' is required.';
                    $('<div class="error-message text-danger">' + errorMessage + '</div>')
                        .insertAfter(input);
                }
            });

            if ($('input[type=checkbox]:checked').length == 0) {
                $('#locaErr').show();
                isValid = false;
            }
            if (isValid === true) {
                const formData = new FormData(this);
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false, // Prevent automatic data processing
                    contentType: false, // Prevent automatic content-type header
                    success: function(response) {

                        toastr.success(response.message, "Success", {
                            toastClass: "toast-success",
                            progressBar: true
                        });
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        toastr.error(response.message, "Error", {
                            toastClass: "toast-error",
                            progressBar: true
                        });
                        console.error(error);
                    }
                });
            } else {

                return false;
            }
        });
    })
</script>
