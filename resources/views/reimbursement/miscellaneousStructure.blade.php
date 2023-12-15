<div class="card cardOutline" id="mobile">
   <div class="card-body">
      <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
         <meta name="csrf-token" content="{{ csrf_token() }}">
         <form id="Misc_Mobile" action="{{ route('createReiseMiscellaneous') }}" class="form" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-13 text-right">
               <h3 class="mb-3">Miscellaneous Reimbursement</h3>
            </div>
            <div class="row g-9 mb-8">
               <div class="col-md-6 fv-row">
                  <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                     <span class="required">Date</span>
                     <span class="ms-1" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference">
                     </span>
                  </label>
                  <input class="form-control" placeholder="Pick date rage" id="miscellaneousDate" name="miscellaneousDate" />
               </div>
               <div class="col-md-6 fv-row">
                  <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                     <span class="required">Ammount</span>
                  </label>
                  <input type="text" class="form-control" placeholder="Enter Ammount" oninput="limitInput(this)" name="miscellaneousAmount" />
               </div>
               <div class="col-md-6 fv-row">
                  <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                     <span class="required">Receipt No</span>
                     <span class="ms-1" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference">
                     </span>
                  </label>
                  <input type="text" class="form-control" maxlength="10" placeholder="Enter Amount" name="miscellaneousReceiptNo" maxlength=8 inputmode="numeric">
               </div>

               <div class="col-md-6 fv-row">
                  <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                     <span class="required">Receipt</span>
                  </label>
                  <input type="file" class="form-control " name="miscellaneousReceiptFile" />
               </div>

            </div>

            <div class="d-flex flex-column mb-8">
               <label class="fs-6 fw-semibold mb-2">Remarks</label>
               <textarea class="form-control" rows="3" name="miscellaneousRemakrs" placeholder="Type Remakrs Details"></textarea>
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

<!--Mis Table-->
<div class="card cardOutline">
   <div class="card-body">
      <div class="table-responsive">


         <div class="card-body pt-0">
            <!--begin::Table-->
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="miscTable">
               <thead>
                  <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
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
                  @if ($miscellaneousData->isNotEmpty())
                  @foreach ($miscellaneousData as $employeeData)
                  <tr>
                     <td><button onclick="deleteHandler(`{{ $employeeData->id }}`)" class="btn btn-link"><i class="bi bi-trash text-danger"></i></button></td>

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
                  @endforeach @else

                  <h1>No Data Found</h1>

                  @endif
               </tbody>
            </table>

         </div>

      </div>
   </div>
</div>

<script>
   //For Number Validation 
   function limitInput(input) {

      input.value = input.value.replace(/\D/g, '');
      if (input.value.length > 7) {
         input.value = input.value.slice(0, 7);
      }
   }

   $(document).ready(function() {
      
      $('#miscTable').DataTable({
         dom: 'Bfrtip',
         buttons: ['csv', 'excel'],
      });
      $("#miscellaneousDate").daterangepicker({
         singleDatePicker: true,
         autoUpdateInput: false, // Set to false to prevent automatic input update
         locale: {
            format: "YYYY-MM-DD", // Desired date format
         },
         maxDate: moment(),
      });
      $("#miscellaneousDate").on("apply.daterangepicker", function(e, picker) {
         $(this).val(picker.startDate.format("YYYY-MM-DD"));
      });
      $('#Misc_Mobile').submit(function(event) {
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
                  $('#Misc_Mobile')[0].reset();
                  updateMiscTable(response.miscellaneousData);
                  toastr.success(response.message, "", {
                     toastClass: "toast-success",
                     progressBar: true
                  });

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
            url: "{{ route('deleteMiscellaneous') }}",
            method: 'DELETE',
            data: {
               id: id,
            },
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
               updateMiscTable(response.miscellaneousData);
               toastr.success(response.message, "", {
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

   function updateMiscTable(miscData) {
      const tableBody = $('#miscTable tbody');
      tableBody.empty(); // Clear existing rows

      // Iterate through each food data item and create table rows
      miscData.forEach(function(item) {
         const row = `
         <tr>
         <td><button onclick="deleteHandler('${item.id}')" class="btn btn-link"><i class="bi bi-trash text-danger"></i></button></td>
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
</script>