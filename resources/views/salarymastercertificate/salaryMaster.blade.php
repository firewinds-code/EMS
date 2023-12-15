@extends('includes.master')
@section('content')
@section('page-title', 'Adminstrator')
@section('page-heading', 'Salary Master')


<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl ">
        <!--begin::Card-->
        <div class="card  cardOutline">
            <div class="card-body">
                <form action="{{route('salarymaster')}}" method="post" id="create_salary_master">
                    <input type="text" name="ReqType" hidden id="ReqType" value="Submit">
                    @csrf
                    <div class="row g-9 mb-8">
                        <div class="col-md-6 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Employee ID</span>
                                <span class="ms-1" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference">
                                </span>
                            </label>
                            <input type="text" class="form-control" maxlength="10" placeholder="Employee ID" name="EmpID" id="employeeID_" />
                            <div class="invalid-feedback">
                                Please provide EmployeeID
                            </div>
                            @if($errors->has('EmpID'))
                            <span class="text-danger">{{$errors->first('EmpID')}}</span>
                            @endif
                        </div>

                        <div class="row-md-3">
                            <div class="form-check">
                                <label class="required form-label" for="flexCheckDefault">
                                    <span>Location</span>
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="flexCheckDefault">
                                    @foreach($data as $key => $value)
                                    <div class="form-check">
                                        <input class="form-check-input" name="location[]" id="locationID{{$value->location}}" type="checkbox" value="{{$value->id}}" />
                                        <span>{{$value->location}} &nbsp;</span>
                                        <div class="invalid-feedback">
                                            Please provide EmployeeID
                                        </div>
                                    </div>
                                    @endforeach
                                    <div>
                                </label>
                            </div>
                            </label>
                            <br>
                            <div class="text-center">
                                <button type="submit" id="submit_" class="btn btn-primary">
                                    <span class="indicator-label">Submit</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br>
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
            <table class="table align-middle table-row-dashed fs-6 fw-semibold mb-2" id="kt_datatable_example">
                <thead>
                    <tr class="text-start fs-4 fw-semibold mb-2">
                        <th class="min-w-70px">Employee Id</th>
                        <th class="min-w-70px">Location</th>
                        <th class="min-w-70px">Action</th>
                </thead>

                <tbody class="fs-6 fw-semibold mb-2">
                    @foreach($results as $result)
                    <tr>
                        <td class="empId">{{$result->EmpID}}</td>
                        <td class="loction_">{{$result->location}}</td>
                        <td><button class="btn btn-link">
                                <i class="bi bi-pencil-square text-success" onclick="javascript:return EditData(this);">
                                </i>
                                </a>
                                <button onclick="deletesalary('{{ $result->EmpID }}')" class="btn btn-link"><i class="bi bi-trash text-danger"></i></button>
                                </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
            <!--end::Table-->
        </div>
    </div>


    <!-- Begaim  Data Table Script -->
</div>
<br>
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
<script>
    function EditData(el) {
        const submitBtn = document.getElementById('submit_');
        submitBtn.textContent = "Update";
        document.getElementById("ReqType").value = "update";
        $(".form-check-input").prop("checked", false);
        var tr = $(el).closest('tr');
        var Emp_id = tr.find('.empId').text();
        var loc = tr.find('.loction_').text();
        var locID = loc.split(",");
        var hidValue = tr.find('.hiddenIDs').text();
        var locLength = locID.length;
        for (var j = 0; j < locLength; j++) {
            console.log('#locationID' + locID[j]);
            $('#locationID' + locID[j]).prop('checked', true);
        }
        $('#employeeID_').val(Emp_id);
        $('#hid').val(hidValue);
        // $('#update').show();
        // $('#submit_').hide();
    }
</script>
<script>
    document.getElementById("create_salary_master").addEventListener("submit", function(event) {
        event.preventDefault();
        var isValid = true;
        var reviewerSelect = document.querySelector("[name='EmpID']");
        if (!reviewerSelect.value) {
            reviewerSelect.classList.add("is-invalid");
            isValid = false;
        } else {
            reviewerSelect.classList.remove("is-invalid");
        }
        if ($('input[type=checkbox]:checked').length == 0) {

            alert('Please select atleast one checkbox');
        }
        if (isValid) {
            this.submit();
        }
    });

    function deletesalary(EmpID) {
        if (confirm("Are You Sure Want To Delete Salary Record")) {
            $.get('salarymasterdelete/' + EmpID, function(response) {
                if (response.success) {
                    toastr.success(response.message, "", {
                        toastClass: "toast-success",
                        progressBar: true
                    });
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }

            });
        }
    }
</script>
@endsection