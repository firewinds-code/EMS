<div class=" card" id="hotel">
   <div class="card cardOutline" id="food">
      <div class="card-body">
         <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <form id="createReiseHotel" action="{{ route('createReiseHotel') }}" class="form" method="POST" enctype="multipart/form-data">
               @csrf
               <div class="mb-13 text-right">
                  <h3 class="mb-3">Hotel Reimbursement</h3>
               </div>
               <div class="row g-9 mb-8">
                  <div class="col-md-4 fv-row">
                     <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span class="required">Date From</span>
                        <span class="ms-1" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference">
                        </span>
                     </label>
                     <input class="form-control" placeholder="Pick date rage" id="HotelDateFrom" name="HotelDateFrom" />
                  </div>
                  <div class="col-md-4 fv-row">
                     <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span class="required">Date To</span>
                        <span class="ms-1" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference">
                        </span>
                     </label>
                     <input class="form-control" placeholder="Pick date rage" id="HotelDateTo" name="HotelDateTo" />
                  </div>
                  <div class="col-md-4 fv-row">
                     <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        No Of Days
                     </label>

                     <input type="text" class="form-control" placeholder="" readonly name="NoOFDays" />
                  </div>
                  <div class="col-md-4 fv-row">
                     <label for="exampleFormControlInput1" class="form-label">
                        <span class="required">Visited Location</span>
                     </label>
                     <select class="form-select form-select-solid" data-control="select2" data-placeholder="--select--" name="visitedLocation">

                     </select>
                  </div>
                  <div class="col-md-4 fv-row">
                     <label for="exampleFormControlInput1" class="form-label">
                        <span class="required">Visited Client Name</span>
                     </label>
                     <select class="form-select form-select-solid" data-control="select2" data-placeholder="--select--" name="visitedClient">

                     </select>
                  </div>
                  <div class="col-md-4 fv-row">
                     <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span class="required">Hotel Name</span>
                     </label>
                     <input type="text" class="form-control" placeholder="Enter Hotel Name" name="hotelName" />
                  </div>
                  <div class="col-md-4 fv-row">
                     <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span class="required">Amount</span>
                     </label>
                     <input type="text" oninput="limitInput(this)" class="form-control" placeholder="Enter Amount" name="Amount" />
                  </div>
                  <div class="col-md-4 fv-row">
                     <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span class="required">Reciept No.</span>
                     </label>
                     <input type="text" class="form-control" maxlength="10" placeholder="Enter Reciept No" name="recieptNo" />
                  </div>
                  <div class="col-md-4 fv-row">
                     <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span class="required">Reciept</span>
                     </label>
                     <input type="file" class="form-control " name="ReceiptFile" />
                  </div>

               </div>

               <div class="d-flex flex-column mb-8">
                  <label class="fs-6 fw-semibold mb-2">Remarks</label>
                  <textarea class="form-control" rows="3" name="HotelRemakrs" placeholder="Type Remakrs Details"></textarea>
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
</div>
<br />

<!--Food Table-->
<div class="card cardOutline">
   <div class="card-body">


      <div class="table-responsive">

         <div class="card-body pt-0">
            <!--begin::Table-->
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="hotelTable">
               <thead>
                  <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                     <!-- <th>Sr No</th> -->
                     <th class="min-w-70px">Action</th>
                     <th class="min-w-70px">EmployeeID</th>
                     <th class="min-w-70px">Employee Name</th>
                     <th class="min-w-70px">Date From</th>
                     <th class="min-w-70px">Date To</th>
                     <th class="min-w-70px">No Of Days</th>
                     <th class="min-w-70px">Hotel Name</th>
                     <th class="min-w-70px">Amount</th>
                     <th class="min-w-70px">Receipt No</th>
                     <th class="min-w-70px">Receipt Image</th>
                     <th class="min-w-70px">Remarks</th>
                     <th class="min-w-70px">Reviewer Status</th>
                     <th class="min-w-70px">Reviewer Remark</th>
                     <th class="min-w-70px">Approver Status</th>
                     <th class="min-w-70px">Approver Remark</th>
                     <th class="min-w-70px">Created On</th>
                  </tr>
               </thead>
               <tbody class="fw-semibold text-gray-600">
                  @if ($hotelData->isNotEmpty())
                  @foreach ($hotelData as $employeeData)
                  <tr>
                     @if ($employeeData->reviewerStatus === 'Approve')
                     <td><i class="bi bi-x text-danger"></i></td>
                     @else
                     <td><button onclick="deleteHandler('{{ $employeeData->id }}')" class="btn btn-link"><i class="bi bi-trash text-danger"></i></button>
                     </td>
                     @endif

                     <td>{{ $employeeData->EmployeeID }}</td>
                     <td>{{ $employeeData->empName }}</td>
                     <td>{{ $employeeData->dateFrom }}</td>
                     <td>{{ $employeeData->dateTo }}</td>
                     <td>{{ $employeeData->noOfdays }}</td>
                     <td>{{ $employeeData->hotelName }}</td>
                     <td>{{ $employeeData->amount }}</td>
                     <td>{{ $employeeData->receipt_no }}</td>
                     <td>{{ $employeeData->receipt_image }}</td>
                     <td>{{ $employeeData->remarks }}</td>
                     <td>{{ $employeeData->reviewerStatus }}</td>
                     <td>{{ $employeeData->reviewComment }}</td>
                     <td>{{ $employeeData->mgrStatus }}</td>
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
   function limitInput(input) {

      input.value = input.value.replace(/\D/g, '');
      if (input.value.length > 7) {
         input.value = input.value.slice(0, 7);
      }
   }
   $(document).ready(function() {

      $('#hotelTable').DataTable({
         dom: 'Bfrtip',
         buttons: ['csv', 'excel'],
      });

      $("#HotelDateFrom").daterangepicker({
         singleDatePicker: true,
         autoUpdateInput: false,
         locale: {
            format: "YYYY-MM-DD",
         },
         maxDate: moment(),
      });

      $("#HotelDateTo").daterangepicker({
         singleDatePicker: true,
         autoUpdateInput: false,
         locale: {
            format: "YYYY-MM-DD",
         },
         maxDate: moment(),
      });

      $("#HotelDateFrom, #HotelDateTo").on("apply.daterangepicker", function(e, picker) {
         $(this).val(picker.startDate.format("YYYY-MM-DD"));
         const fromDate = $("#HotelDateFrom").val();
         const toDate = $("#HotelDateTo").val();
         console.log(fromDate);
         console.log(toDate);

         if (fromDate && toDate) {
            const numberOfDays = moment(toDate).diff(moment(fromDate), 'days') + 1;
            var NoOfDays = $('input[name=NoOFDays]');
            numberOfDays >= 0 ? (NoOfDays.val(numberOfDays)) : NoOfDays.val("NA");
         }
      });
      /*For Get Location*/
      $.ajax({
         url: "{{ route('getVisitedLocation') }}",
         type: "GET",
         dataType: "json",
         success: function(data) {
            var selectDropdown = $("select[name='visitedLocation']");
            selectDropdown.empty();
            selectDropdown.append('<option>--Select--</option>');
            $.each(data.getLocation, function(key, value) {
               selectDropdown.append('<option value="' + value.id + '">' + value.location + '</option>');
            });
         },
         error: function(xhr, status, error) {
            console.error(error);
         }
      });
      /*For Get Location Wise Client*/
      $("select[name='visitedLocation']").change(function() {
         var requestData = {
            locationID: $(this).val()
         };
         $.ajax({
            url: "{{ route('getVisitedClientName') }}",
            type: "GET",
            dataType: "json",
            data: requestData,
            success: function(data) {
               var selectDropdown = $("select[name='visitedClient']");
               selectDropdown.empty();
               selectDropdown.append('<option>--Select--</option>');

               if (data.Status === true) {
                  var options = data.getLocatioClinent.map(function(value) {
                     return '<option value="' + value.client_name + '">' + value.client_name + '</option>';
                  });

                  selectDropdown.append(options.join(''));
               }
            },
            error: function(xhr, status, error) {
               console.error(error);
            }
         });

      })


      $('#createReiseHotel').submit(function(event) {
         event.preventDefault();
         $('.error-message').remove();
         let isValid = true;

         $(this).find('.required').each(function() {
            const input = $(this).closest('.fv-row').find('.form-control, select, textarea');
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
                  $('#createReiseHotel')[0].reset();
                  updateHotelTable(response.hotelData);
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
            url: "{{ route('deleteHotel') }}",
            method: 'DELETE',
            data: {
               id: id,
            },
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
               updateHotelTable(response.hotelData);
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

   function updateHotelTable(foodData) {
      const tableBody = $('#hotelTable tbody');
      tableBody.empty(); // Clear existing rows

      // Iterate through each food data item and create table rows
      foodData.forEach(function(item) {
         const row = `
         <tr>
         ${item.reviewerStatus === 'Approve' ? `<td><i class="bi bi-x text-danger"></i></td>` :
    `<td><button onclick="deleteHandler('${item.id}')" class="btn btn-link"><i class="bi bi-trash text-danger"></i></button></td>`}
            <td>${item.EmployeeID}</td>
            <td>${item.empName}</td>
            <td>${item.dateFrom}</td>
            <td>${item.dateTo}</td>
            <td>${item.noOfdays}</td>
            <td>${item.hotelName}</td>
            <td>${item.amount}</td>  
            <td>${item.receipt_no}</td>
            <td>${item.receipt_image}</td>
            <td>${item.remarks}</td>
            <td>${item.reviewerStatus}</td>
            <td>${item.reviewComment}</td>
            <td>${item.mgrStatus}</td>
            <td>${item.mgrComment}</td>
            <td>${item.created_at}</td>
            
         </tr>
      `;
         tableBody.append(row);
      });
   }
</script>


<script src="{{ asset('utills/dist/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('utills/dist/assets/js/scripts.bundle.js') }}"></script>
<script src=" {{ asset('utills/dist/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>