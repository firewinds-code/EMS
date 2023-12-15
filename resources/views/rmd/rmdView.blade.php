@extends('includes.master')
@section('content')
@section('page-title', 'Reference Master Details')
@section('page-heading', 'Reference Master Details')
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
                            id="RMDetailsTbale">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="text-center min-w-90px sorting_disabled">Manage Ref.</th>
                                    <th class="min-w-125px sorting">S No</th>
                                    <th class="min-w-125px sorting">Type</th>
                                    <th class="min-w-125px sorting">Contact Person</th>
                                    <th class="min-w-125px sorting">Contact No.</th>
                                    <th class="min-w-125px sorting">Ref. Name</th>
                                    <th class="min-w-125px sorting">Payout</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                @if (!@empty($refData))
                                    @php  $i = 1; @endphp
                                    @foreach ($refData as $result)
                                        <tr class="even">
                                            <td>
                                                <button class="btn btn-link">
                                                    <a href="{{ __('javaScript::void(0)') }}"
                                                        id="{{ $result->ref_id }}" data-bs-toggle="modal"
                                                        data-bs-target="#kt_modal_edit_details"
                                                        class="menu-link px-3 edit-details">
                                                        <i class="bi bi-pencil-square text-success">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </a>
                                                </button>
                                            </td>
                                            <td>{{ $i }}</td>
                                            <td>{{ $result->Type }}</td>
                                            <td>{{ $result->ContactPerson }}</td>
                                            <td>{{ $result->ContactNo }}</td>
                                            <td>{{ $result->RefName }}</td>
                                            <td>{{ $result->Payout }}</td>
                                        </tr>
                                        @php  $i++; @endphp
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal fade" id="kt_modal_add_details" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered mw-950px">
                        <div class="modal-content">
                            <form class="form fv-plugins-bootstrap5 fv-plugins-framework" action="{{ url('rmdAdd') }}"
                                method="post" id="kt_modal_add_details_form" data-kt-redirect="">
                                @csrf
                                <div class="modal-header" id="kt_modal_add_email_header">
                                    <h2 class="fw-bold">Add Client Master Details</h2>
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
                                                <label for="Consultancy" class="fs-6 fw-semibold"><span
                                                        class="required">Consultancy Name</span></label>
                                                <input type="text" class="form-control" id="Consultancy"
                                                    name="Consultancy" placeholder="Enter Consultancy Name" />
                                            </div>
                                            <div class="col-lg-6 fv-row">
                                                <label for="ContactPerson" class="fs-6 fw-semibold"><span
                                                        class="required">Contact Person</span></label>
                                                <input type="text" class="form-control" id="ContactPerson"
                                                    name="ContactPerson" placeholder="Enter Contact Person" />
                                            </div>
                                            <div class="col-lg-6 fv-row">
                                                <label for="number" class="fs-6 fw-semibold"><span
                                                        class="required">Contact
                                                        No.</span></label>
                                                <input type="tel" oninput="limitInput(this)" class="form-control"
                                                    placeholder="Enter Contact No. " id="number" name="number" />
                                            </div>
                                            <div class="col-lg-6 fv-row">
                                                <label for="payout" class="fs-6 fw-semibold"><span
                                                        class="required">Payout</span></label>
                                                <input type="number" oninput="limitInput(this)" class="form-control"
                                                    placeholder="Enter Amount " id="payout" name="payout" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer flex-center">
                                    <button type="button" class="btn btn-light"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" id="kt_modal_add_submit" class="btn btn-primary">
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

                <div class="modal fade" id="kt_modal_edit_details" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered mw-950px">
                        <div class="modal-content">
                            <form class="form fv-plugins-bootstrap5 fv-plugins-framework" id="editForm">
                                @csrf

                                <div class="modal-header" id="kt_modal_add_email_header">
                                    <h2 class="fw-bold">Manage Client Master Details</h2>
                                    <div id="kt_modal_add_email_close"
                                        class="btn btn-icon btn-sm btn-active-icon-primary">
                                    </div>
                                </div>
                                <div class="modal-body py-10 px-lg-17" id="edit_body">
                                    <div class="scroll-y me-n7 pe-7" id="kt_modal_add_email_scroll"
                                        data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                                        data-kt-scroll-max-height="auto"
                                        data-kt-scroll-dependencies="#kt_modal_add_email_header"
                                        data-kt-scroll-wrappers="#kt_modal_add_email_scroll"
                                        data-kt-scroll-offset="300px" style="">
                                        <div class="row g-9 mb-10">
                                            <div class="col-lg-6 fv-row">
                                                <input type="hidden" name="id" id="id" />
                                                <label for="Consultancy" class="fs-6 fw-semibold">Consultancy
                                                    Name</label>
                                                <input type="text" class="form-control" id="refName"
                                                    name="refName" placeholder="Enter Consultancy Name" />
                                            </div>
                                            <div class="col-lg-6 fv-row">
                                                <label for="Contact_person" class="fs-6 fw-semibold"><span
                                                        class="required">Contact Person</span></label>
                                                <input type="text" class="form-control" id="Contact_person"
                                                    name="Contact_person" placeholder="Enter Contact Person" />
                                            </div>
                                            <div class="col-lg-6 fv-row">
                                                <label for="ContactNo" class="fs-6 fw-semibold"><span
                                                        class="required">Contact
                                                        No.</span></label>
                                                <input type="tel" oninput="limitInput(this)" class="form-control"
                                                    placeholder="Enter Contact No. " id="ContactNo"
                                                    name="ContactNo" />
                                            </div>
                                            <div class="col-lg-6 fv-row">
                                                <label for="amount" class="fs-6 fw-semibold"><span
                                                        class="required">Payout</span></label>
                                                <input type="number" oninput="limitInput(this)" class="form-control"
                                                    placeholder="Enter Amount" id="amount" name="amount" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer flex-center">
                                    <button type="button" class="btn btn-light"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" id="kt_modal_edit_submit" class="btn btn-primary">
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
        var table = $('#RMDetailsTbale').DataTable({
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
    function limitInput(input) {
        input.value = input.value.replace(/\D/g, '');
        if (input.value.length > 10) {
            input.value = input.value.slice(0, 10);
        }
    }
    $(document).ready(function() {

        $('#kt_modal_add_details_form').submit(function(event) {
            event.preventDefault();
            $('.error-message').remove();
            let isValid = true;

            $(this).find('.required').each(function() {
                const input = $(this).closest('.fv-row').find(
                    '.form-control');
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
    $(function() {
        $('.edit-details').on('click', function() {
            var id = $(this).attr('id');
            $.ajax({
                type: "get",
                url: "{{ route('rmdUpdate') }}",
                data: {
                    "id": id
                },
                success: function(response) {
                    $('#refName').val(response.data.RefName);
                    $('#Contact_person').val(response.data.ContactPerson);
                    $('#ContactNo').val(response.data.ContactNo);
                    $('#amount').val(response.data.Payout);
                    $('#id').val(response.data.ref_id);
                }
            });
        });


        $('#editForm').on('submit', function(event) {
            event.preventDefault();
            var form = $('#editForm').serialize();
            var url = "{{ route('rmdSave') }}";

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
</script>
