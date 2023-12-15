@extends('includes.master')
@section('content')
@section('page-title', 'Add/ Update Bank Name')
@section('page-heading', 'Add/ Update Bank Name')
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
                        <button type="button" class="btn btn-primary add-details" data-bs-toggle="modal" data-bs-target="#kt_modal_add_details">Add/Update Bank Name</button>
                    </div>
                </div>
                <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                    <button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <i class="ki-duotone ki-exit-down fs-2"><span class="path1"></span><span class="path2"></span></i>
                        Export
                    </button>
                    <div id="kt_datatable_example_export_menu" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4" data-kt-menu="true">
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
                        <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer" id="RMDetailsTbale">
                            <thead>
                                <tr class="text-start fs-4 fw-semibold mb-2">
                                    <th>Action</th>
                                    <th>Bank Name</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($results as $result)
                                <tr>
                                    <td><button onclick="editfoodModal('{{ $result->id }}')" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#kt_modal_edit_details"><i class="bi bi-pencil-square text-success"></i></button></td>
                                    <td>{{$result->BankName}} </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal fade" id="kt_modal_add_details" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered mw-950px">
                        <div class="modal-content">
                            <form action="{{ url('addbank') }}" method="post" id="kt_modal_add_details_form" data-kt-redirect="">
                                @csrf

                                <div class="modal-body py-10 px-lg-17">
                                    <div class="scroll-y me-n7 pe-7" id="kt_modal_add_email_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_email_header" data-kt-scroll-wrappers="#kt_modal_add_email_scroll" data-kt-scroll-offset="300px">
                                        <div class="row g-9 mb-10">
                                            <div class="col-lg-6 fv-row">
                                                <label for="BankName" class="fs-6 fw-semibold"><span class="required">Add Bank Name</span></label>
                                                <input type="text" class="form-control" id="BankName" name="BankName" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer flex-center">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" id="kt_modal_add_submit" class="btn btn-primary">
                                        <span class="indicator-label">Submit</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Edit Bank -->

                <div class="modal fade" id="kt_modal_edit_details" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered mw-950px">
                        <div class="modal-content">
                            <form class="form fv-plugins-bootstrap5 fv-plugins-framework" id="editForm" class="kt_modal_add_details_form" id>
                                @csrf
                                <div class="modal-body py-10 px-lg-17">
                                    <div class="scroll-y me-n7 pe-7" id="kt_modal_add_email_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_email_header" data-kt-scroll-wrappers="#kt_modal_add_email_scroll" data-kt-scroll-offset="300px">
                                        <div class="row g-9 mb-10">
                                            <div class="col-lg-6 fv-row">
                                                <label for="editBankName" class="fs-6 fw-semibold"><span class="required"> Edit Bank Name</span></label>
                                                <input type="text" class="form-control" id="editBankName" value="" name="editBankName" />
                                                <input type="hidden" class="form-control" id="id"name="id" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer flex-center">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" id="kt_modal_add_submit" class="btn btn-primary">
                                        <span class="indicator-label">Update</span>
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
   
    function editfoodModal(el) {
        var bacnkid = el;
        var url = "{{ url('editbank') }}" + '/' + bacnkid;
        $.get(url, function(response) {
            $('#editBankName').val(response.data.BankName);
            $('#id').val(response.data.id);
        });
    }

    $(function() {
        $('#editForm').on('submit', function(event) {
            event.preventDefault();
            var form = $('#editForm').serialize();
            var url = "{{route('Save')}}";

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