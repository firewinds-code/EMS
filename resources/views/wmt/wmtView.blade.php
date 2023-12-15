@extends('includes.master')
@section('content')
@section('page-title', 'Manage Mail Template')
@section('page-heading', 'Manage Mail Template')
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
            <div class="card-body align-items-center py-5 gap-2 gap-md-5">
                <form action="{{ url('wmtUpdate') }}" method="POST" id="formWmt">
                    @csrf
                    <br>
                    <div class="row">
                        <div class="col-lg-4 fv-row">
                            <input type="hidden" name="id" id="id" />
                            <label for="EmployeeID" class="fs-6 fw-semibold">Employee ID</label>
                            <input type="text" class="form-control" id="EmployeeID" name="EmployeeID" readonly />
                        </div>
                        <div class="col-lg-4 fv-row">
                            <label for="EmployeeName" class="fs-6 fw-semibold"><span class="required">Employee
                                    Name</span></label>
                            <input type="text" class="form-control" id="EmployeeName" name="EmployeeName"
                                placeholder="Enter Employee Name" />
                        </div>
                        <div class="col-lg-4 fv-row">
                            <label for="email" class="fs-6 fw-semibold"><span class="required">Email</span></label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Enter Email" />
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-4 fv-row">
                            <label for="location" class="fs-6 fw-semibold">Location</label>
                            <input type="text" class="form-control" id="location" name="location" readonly="true" />
                        </div>
                        <div class="col-lg-4 fv-row">
                            <label for="doj" class="fs-6 fw-semibold"><span class="required">DOJ</span></label>
                            <input class="form-control" placeholder="Pick Date of Joining" id="kt_flatpickr"
                                name="doj" />
                        </div>
                        <div class="col-lg-4 fv-row">
                            <label for="number" class="fs-6 fw-semibold"><span class="required">Contact
                                    No.</span></label>
                            <input type="tel" oninput="limitInput(this)" class="form-control"
                                placeholder="Enter Contact No. " id="number" name="number" />
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-4 fv-row">
                            <label for="designation" class="fs-6 fw-semibold"><span
                                    class="required">Designation</span></label>
                            <input type="text" class="form-control" id="designation" name="designation"
                                placeholder="Enter Designation" />
                        </div>
                        <div class="col-lg-4 fv-row">
                            <label for="assignment" class="fs-6 fw-semibold"><span
                                    class="required">Assignment</span></label>
                            <input type="text" class="form-control" id="assignment" name="assignment"
                                placeholder="Enter Assignment" />
                        </div>
                        <div class="col-lg-4 fv-row">
                            <label for="manager" class="fs-6 fw-semibold"><span class="required">Immediate
                                    Manager</span></label>
                            <input type="text" class="form-control" id="manager" name="manager"
                                placeholder="Enter Immediate Manager" />
                        </div>
                    </div>
                    <br>
                    <div class="col-lg-6 fv-row">
                        <label for="url" class="fs-6 fw-semibold"><span class="required">LinkedIn
                                Link</span></label>
                        <input type="text" onkeypress="isValidURL(this)" class="form-control lable_item"
                            id="url" name="url" placeholder="Enter LinkedIn Link" />

                    </div>

                    <br>
                    <div class="text-center">
                        <button type="submit" id="submit" class="btn btn-primary">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </form>
                <br>
                <hr>
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
                                id="kt_customers_tabl">
                                <thead>
                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="text-end min-w-70px sorting_disabled">Employee ID</th>
                                        <th class="min-w-125px sorting">Employee Name</th>
                                        <th class="min-w-125px sorting">Email</th>
                                        <th class="min-w-125px sorting">Contact No</th>
                                        <th class="min-w-125px sorting">DOJ</th>
                                        <th class="min-w-125px sorting">Designation</th>
                                        <th class="min-w-125px sorting">Location</th>
                                        <th class="min-w-125px sorting">Immediate Manager</th>
                                        <th class="min-w-125px sorting">Assignment</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                    @if (!@empty($sqlConnect))
                                        @foreach ($sqlConnect as $result)
                                            <tr class="even">
                                                <td class="manage_item" style="text-align:center">
                                                    <button
                                                        onclick="EditEmail('{{ $result->id }}','{{ $result->EmployeeID }}','{{ $result->EmployeeName }}','{{ $result->email }}','{{ $result->number }}','{{ $result->doj }}','{{ $result->designation }}','{{ $result->location }}','{{ $result->manager }}','{{ $result->assignment }}','{{ $result->url }}')"
                                                        class="btn btn-link ">
                                                        <i class="bi bi-pencil-square text-success">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </button>
                                                </td>
                                                <td>{{ $result->EmployeeID }}</td>
                                                <td>{{ $result->EmployeeName }}</td>
                                                <td>{{ $result->email }}</td>
                                                <td>{{ $result->number }}</td>
                                                <td>{{ $result->doj }}</td>
                                                <td>{{ $result->designation }}</td>
                                                <td>{{ $result->location }}</td>
                                                <td>{{ $result->manager }}</td>
                                                <td>{{ $result->assignment }}</td>

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
    function isValidURL(url) {
        const urlRegex = /^(https?:\/\/)?([\w.-]+)\.([a-zA-Z]{2,})(\S+)?$/;
        return urlRegex.test(url);
        //comparing url with the format
    }

    function limitInput(input) {
        input.value = input.value.replace(/\D/g, '');
        if (input.value.length > 10) {
            input.value = input.value.slice(0, 10);
        }
    }
    $(document).ready(function() {

        $('#formWmt').submit(function(event) {
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


            //URL validation
            const urlInput = $('#url');
            const urlValue = urlInput.val();
            //comparing value in function to the url value
            if (!isValidURL(urlValue)) {
                isValid = false;
                const errorMessage = 'Invalid URL. Please enter a valid URL.';
                $('<div class="error-message text-danger">' + errorMessage + '</div>')
                    .insertAfter(urlInput);
            }


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
    function EditEmail(id, EmployeeID, EmployeeName, email, number, doj, designation, location, manager, assignment,
        url) {
        $("input[name='EmployeeID']").val(EmployeeID);
        $("input[name='EmployeeName']").val(EmployeeName);
        $("input[name='email']").val(email);
        $("input[name='location']").val(location);
        $("input[name='doj']").val(doj);
        $("input[name='number']").val(number);
        $("input[name='designation']").val(designation);
        $("input[name='assignment']").val(assignment);
        $("input[name='url']").val(url);
        $("input[name='manager']").val(manager);
        $("input[name='id']").val(id);
        $(".lable_item").addClass("active");
    }
</script>

<script>
    $(document).ready(function() {
        $("#kt_flatpickr").flatpickr();
        // $("#kt_datepicker_3").flatpickr({
        //     enableTime: true,
        //     dateFormat: "Y-m-d H:i",
        // });

        var table = $('#kt_customers_tabl').DataTable({
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

        function EditEmail(id) {
            $.get('edit-email/' + id, function(response) {
                if (response.success) {
                    toastr.success(response.message, "", {
                        toastClass: "toast-success",
                        progressBar: true
                    });
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                } else {
                    toastr.error(response.message, "Error", {
                        toastClass: "toast-error",
                        progressBar: true
                    });
                }
            });

        }
    });
</script>
