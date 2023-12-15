<div class="card cardOutline" id="food">
    <div class="card-body">
        <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <form id="form_food" action="{{ route('CreateRaiseFood') }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-13 text-right">
                    <h3 class="mb-3">Food Reimbursement</h3>
                </div>
                <div class="row g-9 mb-8">
                    <div class="col-md-6 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Date</span>
                            <span class="ms-1" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference">
                            </span>
                        </label>
                        <input class="form-control" placeholder="Pick date rage" id="FoodDate" name="FoodDate" />
                    </div>
                    <div class="col-md-6 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Amount</span>
                        </label>

                        <input type="text" oninput="limitInput(this)" class="form-control" placeholder="Enter Ammount" name="FoodAmount" />
                    </div>
                    <div class="col-md-6 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Receipt No</span>
                            <span class="ms-1" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference">
                            </span>
                        </label>
                        <input type="text" class="form-control" maxlength="10" placeholder="Receipt No" name="FoodReceiptNo" />
                    </div>
                    <div class="col-md-6 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Receipt</span>
                        </label>
                        <input type="file" class="form-control " name="FoodReceiptFile" />
                    </div>

                </div>

                <div class="d-flex flex-column mb-8">
                    <label class="fs-6 fw-semibold mb-2">Remarks</label>
                    <textarea class="form-control" rows="3" name="FoodRemakrs" placeholder="Type Remakrs Details"></textarea>
                </div>
                <div class="text-center">
                    <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                        <span class="indicator-label">Submit</span>
                        <span class="indicator-progress" style="display: none;">
                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<br />
<!--Food Table-->
<div class="card cardOutline">
    <div class="card-body">



        <div class="card-body pt-0">
            <!-- Add responsive wrapper -->
            <div class="table-responsive">
                <!--begin::Table-->
                <table id="foodTable" class="table align-middle table-row-dashed fs-6 gy-5">
                    <thead class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                        <tr>
                            <th>Action</th>
                            <th>EmployeeID</th>
                            <th class="min-w-70px">Name</th>
                            <th class="min-w-70px">Date</th>
                            <th class="min-w-100px">Amount</th>
                            <th class="min-w-100px">Receipt No</th>
                            <th class="min-w-70px">Image</th>
                            <th class="min-w-70px">Remarks</th>
                            <th class="min-w-70px">Reviewer Status</th>
                            <th class="min-w-70px">Reviewer Remarks</th>
                            <th class="min-w-70px">Approve Status</th>
                            <th class="min-w-70px">Approve Remarks</th>
                            <th class="min-w-70px">Created On</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                        @if ($foodData->isNotEmpty())
                        @foreach ($foodData as $employeeData)
                        <tr>
                            @if ($employeeData->reviewerStatus === 'Approve')
                            <td><i class="bi bi-x text-danger"></i></td>
                            @else
                            <td><button onclick="deleteHandler('{{ $employeeData->id }}')" class="btn btn-link"><i class="bi bi-trash text-danger"></i></button>
                            </td>
                            @endif
                            <td>{{ $employeeData->EmployeeID }}</td>
                            <td>{{ $employeeData->empName }}</td>
                            <td>{{ $employeeData->date }}</td>
                            <td>{{ $employeeData->amount }}</td>
                            <td>{{ $employeeData->receipt_no }}</td>
                            <td>{{ $employeeData->receipt_image }}</td>
                            <td>{{ $employeeData->remarks }}</td>
                            <td>{{ $employeeData->reviewerStatus }}</td>
                            <td>{{ $employeeData->reviewComment }}</td>
                            <td>{{ $employeeData->approverStatus }}</td>
                            <td>{{ $employeeData->mgrComment }}</td>
                            <td>{{ $employeeData->created_at }}</td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="13">
                                <h1>No Data Found</h1>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>



    </div>
</div>



<script>
    function limitInput(input) {

        input.value = input.value.replace(/\D/g, '');
        if (input.value.length > 7) {
            input.value = input.value.slice(0, 7);
        }
    }
    $(document).ready(function() {
        $("#FoodDate").daterangepicker({
            singleDatePicker: true,
            autoUpdateInput: false, // Set to false to prevent automatic input update
            locale: {
                format: "YYYY-MM-DD", // Desired date format
            },
            maxDate: moment(),
        });
        $("#FoodDate").on("apply.daterangepicker", function(e, picker) {
            $(this).val(picker.startDate.format("YYYY-MM-DD"));
        });
        $('#form_food').submit(function(event) {
            event.preventDefault();
            $('.error-message').remove();
            let isValid = true;

            $(this).find('.required').each(function() {
                const input = $(this).closest('.fv-row').find(
                    '.form-control, select, textarea');
                const isTextarea = input.is('textarea');
                if (!input.val() && !isTextarea) {
                    isValid = false;
                    const fieldName = $(this).text();
                    const errorMessage = fieldName + ' is required.';
                    $('<div class="error-message text-danger">' + errorMessage + '</div>')
                        .insertAfter(input);
                }
            });

            if (!isValid) {
                return false;
            } else {

                $('#kt_modal_new_target_submit .indicator-label').hide();
                $('#kt_modal_new_target_submit .indicator-progress').show();
                $('#kt_modal_new_target_submit').attr('disabled', true);
                // Serialize form data
                const formData = new FormData(this);

                // Send form data using AJAX
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false, // Prevent automatic data processing
                    contentType: false, // Prevent automatic content-type header
                    success: function(response) {
                        // Re-enable the submit button and hide loading indicator
                        $('#kt_modal_new_target_submit .indicator-label').show();
                        $('#kt_modal_new_target_submit .indicator-progress').hide();
                        $('#kt_modal_new_target_submit').attr('disabled', false);


                        // Refresh the table by reloading the fetched data
                        $('#form_food')[0].reset();
                        updateFoodTable(response.foodData);
                        toastr.success("Record created successfully", "", {
                            toastClass: "toast-success",
                            progressBar: true
                        });
                        // toastr.success('Record created successfully');
                    },
                    error: function(xhr, status, error) {
                        // Re-enable the submit button and hide loading indicator
                        $('#kt_modal_new_target_submit .indicator-label').show();
                        $('#kt_modal_new_target_submit .indicator-progress').hide();
                        $('#kt_modal_new_target_submit').attr('disabled', false);
                        toastr.error("Something went wrong !!", "Error", {
                            toastClass: "toast-error",
                            progressBar: true
                        });
                        console.error(error);
                    }
                });

            }
        });
    });

    function deleteHandler(id) {
        if (confirm("Are you sure you want to delete this record?")) {
            $.ajax({
                url: "{{ route('deleteFood') }}",
                method: 'DELETE',
                data: {
                    id: id,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    updateFoodTable(response.foodData);
                    // toastr.success('Record deleted successfully');
                    toastr.success("Record deleted successfully", "", {
                        toastClass: "toast-success",
                        progressBar: true
                    });
                },
                error: function(xhr, status, error) {
                    toastr.error("Something went wrong !!", "Error", {
                        toastClass: "toast-error",
                        progressBar: true
                    });
                    console.error(error);
                }
            });
        }
    }

    function updateFoodTable(foodData) {
        const tableBody = $('#foodTable tbody');
        tableBody.empty(); // Clear existing rows
        // Iterate through each food data item and create table rows
        foodData.forEach(function(item) {
            const row = `
         <tr>
         ${item.reviewerStatus === 'Approve' ? `<td><i class="bi bi-x text-danger"></i></td>` :
         `<td><button onclick="deleteHandler('${item.id}')" class="btn btn-link"><i class="bi bi-trash text-danger"></i></button></td>`}
            <td>${item.EmployeeID}</td>
            <td>${item.empName}</td>
            <td>${item.date}</td>
            <td>${item.amount}</td>
            <td>${item.receipt_no}</td>
            <td>${item.receipt_image}</td>
            <td>${item.remarks}</td>  
            <td>${item.reviewerStatus}</td>
            <td>${item.reviewComment}</td>
            <td>${item.approverStatus}</td>
            <td>${item.mgrComment}</td>
            <td>${item.created_at}</td>
            
         </tr>
      `;
            tableBody.append(row);
        });
    }
    $(document).ready(function() {
        $('#foodTable').DataTable({
            dom: 'Bfrtip',
            buttons: ['csv', 'excel'],
        });
    });
</script>