<!-- Travel Form -->
<div class="card cardOutline" id="travel">
   <div class="card-body">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
         <form id="form_travel" action="{{ route('createReiseTravel') }}" class="form" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-13 text-right">
               <h3 class="mb-3">Travel Reimbursement</h3>
            </div>
            <div class="row g-9 mb-8">
               <div class="col-md-4 fv-row">
                  <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                     <span class="required">Date</span>
                     <span class="ms-1" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference">
                     </span>
                  </label>
                  <!--end::Label-->
                  <input class="form-control " placeholder="Pick date rage" name="travel_date" id="travel_date" />
               </div>
               <div class="col-md-4 fv-row">
                  <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                     <span class="required">Place from</span>
                  </label>
                  <!--end::Label-->
                  <input type="text" class="form-control " placeholder="Enter Ammount" name="travel_place_from" />
               </div>
               <div class="col-md-4 fv-row">
                  <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                     <span class="required">Place To</span>
                     <span class="ms-1" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference">
                     </span>
                  </label>
                  <input type="text" class="form-control " placeholder="Receipt No" name="travel_place_to" />
               </div>
               <div class="col-md-4 fv-row">
                  <label for="exampleFormControlInput1" class="form-label">
                     <span class="required">Made of travel</span>
                  </label>
                  <select class="form-select " data-control="select2" data-hide-search="true" data-placeholder="--select--" name="travel_type">
                     <option></option>
                     <option value="car">Car</option>
                     <option value="flight">Flight</option>
                     <option value="train">Train</option>
                     <option value="bus">Bus</option>
                     <option value="Cab/Auto">Cab/Auto</option>
                  </select>
               </div>
               <div class="col-md-4 fv-row" id="travel_return_date">
                  <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                     Return Date
                     <span class="ms-1" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference">
                     </span>
                  </label>

                  <input class="form-control " placeholder="Pick Return Date" name="travel_return_date" id="travel_return_date1" />
               </div>

               <div class="col-md-4 fv-row" id="travel_km">
                  <label class="d-flex align-items-center fs-6 fw-semibold mb-2">Kilometer </label>
                  <input type="number" class="form-control " placeholder="Enter Ammount" name="travel_km" />
               </div>
               <div class="col-md-4 fv-row" id="travel_km_ammount">
                  <label class="d-flex align-items-center fs-6 fw-semibold mb-2"> Kilometer Amount</label>
                  <input type="number" class="form-control " placeholder="Enter Ammount" name="travel_km_ammount" readonly />
               </div>
               <div class="col-md-4 fv-row" id="travel_km_receipt_file">
                  <label class="d-flex align-items-center fs-6 fw-semibold mb-2"> Km Receipt </label>
                  <input type="file" class="form-control " name="travel_km_receipt_file" />
               </div>
               <div class="col-md-4 fv-row" id="travel_pk_receipt_file">
                  <label class="d-flex align-items-center fs-6 fw-semibold mb-2"> Parking Receipt </label>
                  <input type="file" class="form-control " name="travel_pk_receipt_file" />
               </div>
               <div class="col-md-4 fv-row" id="travel_toll_receipt_file">
                  <label class="d-flex align-items-center fs-6 fw-semibold mb-2"> Toll Receipt </label>
                  <input type="file" class="form-control " name="travel_toll_receipt_file" />
               </div>
               <div class="col-md-4 fv-row" id="travel_pk_ammount">
                  <label class="d-flex align-items-center fs-6 fw-semibold mb-2"> Parking Amount </label>
                  <input type="number" class="form-control " placeholder="Enter Ammount" name="travel_pk_ammount" />
               </div>
               <div class="col-md-4 fv-row" id="travel_toll_ammount">
                  <label class="d-flex align-items-center fs-6 fw-semibold mb-2">Toll Amount </label>
                  <input type="number" class="form-control " placeholder="Enter Ammount" name="travel_toll_ammount" />
               </div>
               <div class="col-md-4 fv-row" id="travel_total_ammount">
                  <label class="d-flex align-items-center fs-6 fw-semibold mb-2"> Total Amount </label>
                  <input type="number" class="form-control " placeholder="Enter Ammount" name="travel_total_ammount" readonly />
               </div>
               <div class="col-md-4 fv-row" id="travel_ammount">
                  <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                     <span class="required">Amount</span>
                  </label>

                  <input type="text" oninput="limitInput(this)" class="form-control " placeholder="Enter Ammount" name="travel_ammount" />
               </div>

               <div class="col-md-4 fv-row" id="travel_receipt_no">
                  <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                     <span class="required">Receipt No</span>
                  </label>
                  <input type="text" class="form-control" maxlength="10" placeholder="Enter Ammount" name="travel_receipt_no" />
               </div>

               <div class="col-md-4 fv-row" id="travel_receipt_file">
                  <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                     <span class="required">Receipt</span>
                  </label>
                  <input type="file" class="form-control " name="travel_receipt_file" />
               </div>
            </div>

            <div class="d-flex flex-column mb-8">
               <label class="fs-6 fw-semibold mb-2">
                  Remarks </label>
               <textarea class="form-control " rows="3" name="travel_remarks" placeholder="Type Remakrs Details"></textarea>
            </div>
            <div class="text-center">
               <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                  <span class="indicator-label">Submit</span>
                  <span class="indicator-progress">Please wait...
                     <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
               </button>
            </div>
         </form>
      </div>
   </div>

</div>
<br />

<!--Travel Table-->

<div class="card cardOutline">
   <div class="card-body">
      <div class="card-body pt-0">
         <!-- Add responsive wrapper -->
         <div class="table-responsive">

            <div class="card-body pt-0">
               <!--begin::Table-->
               <table class="table align-middle table-row-dashed fs-6 gy-5" id="travelTable">
                  <thead>
                     <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                        <th>Action</th>
                        <th>EmployeeID</th>
                        <th class="min-w-70px">Name</th>
                        <th class="min-w-70px">Date</th>
                        <th class="min-w-70px">Place From</th>
                        <th class="min-w-70px">Place To</th>
                        <th class="min-w-70px">Made Of Travel</th>
                        <th class="min-w-100px">Return Date</th>
                        <th class="min-w-100px">Amount</th>
                        <th class="min-w-70px">Receipt No.</th>
                        <th class="min-w-70px">Receipt Image</th>
                        <th class="min-w-70px">Car Km</th>
                        <th class="min-w-70px">Car Km Receipt</th>
                        <th class="min-w-70px">Car Toll Receipt</th>
                        <th class="min-w-70px">Car Parking Receipt </th>
                        <th class="min-w-70px">Remakrs</th>
                        <th class="min-w-70px">Reviewer Status</th>
                        <th class="min-w-70px">Reviewer Remakrs</th>
                        <th class="min-w-70px">Approver Status</th>
                        <th class="min-w-70px">Approver Remakrs</th>
                        <th class="min-w-70px">Remakrs</th>
                     </tr>
                  </thead>
                  <tbody class="fw-semibold text-gray-600">
                     @if ($TravelData->isNotEmpty())
                     @foreach ($TravelData as $employeeData)
                     <tr>
                        <td><button onclick="deleteHandler(`{{ $employeeData->id }}`)" class="btn btn-link"><i class="bi bi-trash text-danger"></i></button></td>

                        <td>{{ $employeeData->EmployeeID }}</td>
                        <td>{{ $employeeData->empName }}</td>
                        <td>{{ $employeeData->date }}</td>
                        <td>{{ $employeeData->placeFrom }}</td>
                        <td>{{ $employeeData->placeTO }}</td>
                        <td>{{ $employeeData->modeOftravel }}</td>
                        <td>{{ $employeeData->returnDate }}</td>
                        <td>{{ $employeeData->amount }}</td>
                        <td>{{ $employeeData->receipt_no }}</td>
                        <td>{{ $employeeData->receipt_image }}</td>
                        <td>{{ $employeeData->car_km }}</td>
                        <td>{{ $employeeData->car_km_receipt }}</td>
                        <td>{{ $employeeData->car_toll_receipt }}</td>
                        <td>{{ $employeeData->car_parking_receipt }}</td>
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
</div>

<script>
   function limitInput(input) {

      input.value = input.value.replace(/\D/g, '');
      if (input.value.length > 7) {
         input.value = input.value.slice(0, 7);
      }
   }

   $("#travel_date").daterangepicker({
      singleDatePicker: true,
      autoUpdateInput: false,
      locale: {
         format: "YYYY-MM-DD",
      },
      maxDate: moment(),
   }).on("apply.daterangepicker", function(e, picker) {
      $(this).val(picker.startDate.format("YYYY-MM-DD"));
   });
   $("#travel_return_date1").daterangepicker({
      singleDatePicker: true,
      autoUpdateInput: false,
      locale: {
         format: "YYYY-MM-DD",
      },
      maxDate: moment(),
   }).on("apply.daterangepicker", function(e, picker) {
      $(this).val(picker.startDate.format("YYYY-MM-DD"));
   });
   $(document).ready(function() {
      $("#travel_return_date,#travel_km,#travel_km_ammount,#travel_km_receipt_file,#travel_pk_receipt_file,#travel_toll_receipt_file,#travel_pk_ammount,#travel_toll_ammount,#travel_total_ammount")
         .hide();
      $("select[name='travel_type']").change(function() {
         var selectedValue = $(this).val();
         if (selectedValue === "car") {
            $("#travel_km, #travel_km_ammount, #travel_km_receipt_file, #travel_pk_receipt_file, #travel_toll_receipt_file, #travel_pk_ammount, #travel_toll_ammount,#travel_total_ammount ")
               .show();
            $(" #travel_return_date,#travel_ammount,#travel_receipt_no,#travel_receipt_file", ).hide();

         } else if (selectedValue === "flight") {
            $(" #travel_km, #travel_km_ammount, #travel_km_receipt_file, #travel_pk_receipt_file,#travel_toll_receipt_file, #travel_pk_ammount, #travel_toll_ammount,#travel_total_ammount ")
               .hide();
            $("#travel_return_date").show();
         } else {
            $(" #travel_return_date,#travel_return_date, #travel_km, #travel_km_ammount, #travel_km_receipt_file, #travel_pk_receipt_file, #travel_toll_receipt_file, #travel_pk_ammount, #travel_toll_ammount, #travel_total_ammount ")
               .hide();
            $(" #travel_ammount,#travel_receipt_no,#travel_receipt_file", ).show();
         }
      });
   });
</script>


<script>
   $(document).ready(function() {
      $('#travelTable').DataTable({
         dom: 'Bfrtip',
         buttons: ['csv', 'excel'],
      });





      $('input[name=travel_km]').keyup(function() {
         let kmValueWithAmmount = $(this).val() == "" ? 0 : $(this).val() * 10;
         var travel_km_ammount = $('input[name=travel_km_ammount]');
         var travel_total_ammount = $('input[name=travel_total_ammount]');
         travel_km_ammount.val(kmValueWithAmmount);
         var travel_pk_amount = $('input[name=travel_pk_ammount]').val() == "" ? 0 : $(
            'input[name=travel_pk_ammount]').val();
         var travel_toll_amount = $('input[name=travel_toll_ammount]').val() == "" ? 0 : $(
            'input[name=travel_toll_ammount]').val();
         var travel_total_ammount_assign = $('input[name=travel_total_ammount]');
         travel_total_ammount_assign.val(parseInt(kmValueWithAmmount) + parseInt(travel_pk_amount) +
            parseInt(travel_toll_amount));
      });
      $('input[name=travel_toll_ammount]').keyup(function() {
         var travel_toll_ammount = $(this).val() == '' ? 0 : $(this).val();
         var travel_km_amount = $('input[name=travel_km_ammount]').val() == "" ? 0 : $(
            'input[name=travel_km_ammount]').val();
         var travel_pk_amount = $('input[name=travel_pk_ammount]').val() == "" ? 0 : $(
            'input[name=travel_pk_ammount]').val();
         var travel_total_ammount_assign = $('input[name=travel_total_ammount]');
         travel_total_ammount_assign.val(parseInt(travel_toll_ammount) + parseInt(travel_km_amount) +
            parseInt(travel_pk_amount));
      });
      $('input[name=travel_pk_ammount]').keyup(function() {
         var travel_pk_amount = $(this).val() == '' ? 0 : $(this).val();
         var travel_km_amount = $('input[name=travel_km_ammount]').val() == "" ? 0 : $(
            'input[name=travel_km_ammount]').val();
         var travel_toll_amount = $('input[name=travel_toll_ammount]').val() == "" ? 0 : $(
            'input[name=travel_toll_ammount]').val();
         var travel_total_ammount_assign = $('input[name=travel_total_ammount]');
         travel_total_ammount_assign.val(parseInt(travel_pk_amount) + parseInt(travel_km_amount) +
            parseInt(travel_toll_amount));
      });
      $('#form_travel').submit(function(event) {
         event.preventDefault();
         $('.error-message').remove();
         let isValid = true;

         $(this).find('.required').each(function() {
            const input = $(this).closest('.fv-row').find(
               '.form-control, select, textarea');
            const isHidden = $(this).closest('.fv-row').is(':hidden');
            const isTextarea = input.is('textarea');
            if (!input.val() && !isTextarea && !isHidden) {
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
            // this.submit();
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
                  $('#form_travel')[0].reset();
                  updateTravelTable(response.travelData);
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
            url: "{{ route('deleteTravel') }}",
            method: 'DELETE',
            data: {
               id: id,
            },
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
               updateTravelTable(response.travelData);
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

   function updateTravelTable(foodData) {
      const tableBody = $('#travelTable tbody');
      tableBody.empty(); // Clear existing rows

      // Iterate through each food data item and create table rows
      foodData.forEach(function(item) {
         const row = `
         <tr>
         <td><button onclick="deleteHandler('${item.id}')" class="btn btn-link"><i class="bi bi-trash text-danger"></i></button></td>
            <td>${item.EmployeeID}</td>
            <td>${item.empName}</td>
            <td>${item.date}</td>
            <td>${item.placeFrom}</td>
            <td>${item.placeTO}</td>
            <td>${item.modeOftravel}</td>
            <td>${item.returnDate}</td>  
            <td>${item.amount}</td>
            <td>${item.receipt_no}</td>
            <td>${item.receipt_image}</td>
            <td>${item.car_km}</td>
            <td>${item.car_km_receipt}</td>
            <td>${item.car_toll_receipt}</td>
            <td>${item.car_parking_receipt}</td>
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

