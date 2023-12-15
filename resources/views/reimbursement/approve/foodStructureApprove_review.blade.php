<input type="text" value="{{ $type }}" id="reqType" hidden>
<div id="forResponse">
   <!--begin::Table-->
   @if ($foodData->isNotEmpty())
   <div class="card cardOutline">
      <div class="card-body">
         <div class="card-body pt-0">
            <!-- Add responsive wrapper -->
            <div class="table-responsive">
               <!--begin::Table-->
               <table id="example" class="table align-middle table-row-dashed fs-6 gy-5">
                  <thead class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                     <tr>
                        <th>Action</th>
                        <th>EmployeeID</th>
                        <th class="min-w-100px">Name</th>
                        <th class="min-w-100px">Date</th>
                        <th class="min-w-100px">Amount</th>
                        <th class="min-w-100px">Status</th>
                        <th class="min-w-100px">Receipt No</th>
                        <th class="min-w-100px">Receipt</th>
                        <th class="min-w-200px">Remarks</th>
                        @if ($type === 'approve')
                        <th class="min-w-100px">Reviewer Status</th>
                        <th class="min-w-200px">Reviewer Comment</th>
                        @endif
                        <th class="min-w-100px">Created On</th>
                        <th hidden>ID</th>
                        <th hidden>Recipt Image</th>
                     </tr>
                  </thead>
                  <tbody class="fw-semibold text-gray-600">

                     @foreach ($foodData as $employeeData)
                     <tr>
                        <td><button onclick="editfoodModal(this)" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#food_edit_modal"><i class="bi bi-pencil-square text-success"></i></button></td>
                        <td id="empID">{{ $employeeData->EmployeeID }}</td>
                        <td id="empName">{{ $employeeData->empName }}</td>
                        <td id="fDate">{{ $employeeData->date }}</td>
                        <td id="fAmount">{{ $employeeData->amount }}</td>
                        <td id="fAmount">{{ $employeeData->req_status }}</td>
                        <td id="receipt_No">{{ $employeeData->receipt_no }}</td>
                        <td>
                           <a href="{{ asset('reimbursement/ExpenseFood/'.$employeeData->receipt_image) }}" download>
                              <i class="fas fa-download text-success" title="Download File"></i>
                           </a>
                        </td>

                        <td id="remakrs">{{ $employeeData->remarks }}</td>
                        @if ($type === 'approve')
                        <td id="ReviewerStatus">{{ $employeeData->reviewerStatus }}</td>
                        <td id="ReviewerRemakrs">{{ $employeeData->reviewComment }}</td>
                        @endif
                        <td>{{ $employeeData->created_at }}</td>
                        <td hidden id="foodID">{{ $employeeData->id }}</td>
                        <td hidden id="receipt_File">{{ $employeeData->receipt_image }}</td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>



      </div>
   </div>
   @else
   <script>
      toastr.success('No Data Found !!', "", {
         toastClass: "toast-success",
         progressBar: true
      });
   </script>
   @endif
   <!--end::Table-->
   @if ($foodData->isNotEmpty())
   <div class="modal fade" tabindex="-1" id="food_edit_modal">
      <div class="modal-dialog modal-dialog-scrollable" style="max-width: 900px ; width: 90%;"> <!-- Added modal-xl class for extra-large width -->
         <div class="modal-content">
            <div class="modal-header">
               <h3 class="modal-title">Food Expense</h3>
               <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                  <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
               </div>
            </div>
            <div class="modal-body ">
               <form id="edit_food" class="form" method="POST" enctype="multipart/form-data">
                  @csrf
                  <input type="text" class="form-control" readonly maxlength="10" hidden placeholder="Receipt No" id="FoodReceiptFile" name="FoodReceiptFile" />
                  <input type="text" class="form-control" readonly maxlength="10" hidden placeholder="Receipt No" id="foodID_" name="foodID_" />
                  <div class="row g-9 mb-8">
                     <div class="col-md-4 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                           <span>Date</span>
                           <span class="ms-1" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference">
                           </span>
                        </label>
                        <input type="text" class="form-control" placeholder="Pick date rage" id="FoodDate" name="FoodDate" readonly />
                     </div>
                     <div class="col-md-4 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                           <span>Amount</span>
                        </label>

                        <input type="text" readonly class="form-control" placeholder="Enter Ammount" id="FoodAmount" name="FoodAmount" />
                     </div>
                     <div class="col-md-4 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                           <span>Receipt No</span>
                           <span class="ms-1" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference">
                           </span>
                        </label>
                        <input type="text" class="form-control" readonly maxlength="10" placeholder="Receipt No" id="FoodReceiptNo" name="FoodReceiptNo" />
                     </div>
                     <div class="col-md-12 fv-row">
                        <label class="fs-6 fw-semibold mb-2">Remarks</label>
                        <textarea class="form-control" rows="3" name="FoodRemakrs" readonly id="FoodRemakrs" placeholder="Type Comment Details"></textarea>
                     </div>

                     <div class="col-md-6 fv-row">
                        <a id="downloadLink" class="btn btn-primary" href="#" download style="margin-top: 25px;">
                           <i class="fas fa-download text-success" title="Download File"></i>
                           Download Receipt File
                        </a>
                     </div>

                     @if ($type === 'approve')
                     <div class="col-md-6 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                           <span>Reviewer Status</span>
                           <span class="ms-1" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference">
                           </span>
                        </label>
                        <input type="text" class="form-control" readonly maxlength="10" placeholder="Receipt No" id="foodStatusReviewer" name="hotelStatusReviewer" />
                     </div>
                     <div class="col-md-12 fv-row">
                        <label class="fs-6 fw-semibold mb-2">Reviewer Remarks</label>
                        <textarea class="form-control" rows="3" name="hotelRemakrsReviewer" readonly id="foodRemakrsReviewer" placeholder="Type Comment Details"></textarea>
                     </div>
                     <div class="col-md-12 fv-row">
                        <label for="exampleFormControlInput1" class="form-label">
                           <span class="required">Approver</span>
                        </label>
                        <select class="form-select" data-control="select2" data-hide-search="true" data-placeholder="--select--" name="Approver">
                           <option value="">--select--</option>
                           <option value="Approve">Approve</option>
                           <option value="Decline">Decline</option>
                        </select>
                        <div class="invalid-feedback">
                           Please select a Approver status.
                        </div>
                     </div>
                     <div class="d-flex flex-column mb-8">
                        <label class="required">Reviewer Comment</label>
                        <textarea class="form-control" rows="3" name="FoodCommentApprover" placeholder="Type Comment Details"></textarea>
                        <div class="invalid-feedback">
                           Please provide a Approver comment.

                        </div>
                     </div>
                     @else
                     <div class="col-md-12 fv-row">
                        <label for="exampleFormControlInput1" class="form-label">
                           <span class="required">Reviewer</span>
                        </label>
                        <select class="form-select" data-control="select2" data-hide-search="true" data-placeholder="--select--" name="Reviewer">
                           <option value="">--select--</option>
                           <option value="Approve">Approve</option>
                           <option value="Decline">Decline</option>
                        </select>
                        <div class="invalid-feedback">
                           Please select a reviewer status.
                        </div>
                     </div>

                     <div class="d-flex flex-column mb-8">
                        <label class="required">Reviewer Comment</label>
                        <textarea class="form-control" rows="3" name="FoodCommentReviewer" placeholder="Type Comment Details"></textarea>
                        <div class="invalid-feedback">
                           Please provide a reviewer comment.
                        </div>
                     </div>
                     @endif

                     <div class="modal-footer">
                        <button type="button" id="closeModalBtn" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="submitButtonLoading" class="btn btn-primary">
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
   @endif


   <script>
      $(document).ready(function() {
         $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: ['csv', 'excel'],
         });
      });
      document.getElementById("edit_food").addEventListener("submit", function(event) {
         event.preventDefault();
         var isValid = true;
         let reqType = $('#reqType').val();
         var reviewer_approver_Select = reqType === "review" ? document.querySelector("[name='Reviewer']") :
            document.querySelector("[name='Approver']");

         if (!reviewer_approver_Select.value) {
            reviewer_approver_Select.classList.add("is-invalid");
            isValid = false;
         } else {
            reviewer_approver_Select.classList.remove("is-invalid");
         }


         var commentTextarea = reqType === "review" ? document.querySelector("[name='FoodCommentReviewer']") :
            document.querySelector("[name='FoodCommentApprover']");
         if (!commentTextarea.value) {
            commentTextarea.classList.add("is-invalid");
            isValid = false;
         } else {
            commentTextarea.classList.remove("is-invalid");
         }

         if (isValid) {
            $('#submitButtonLoading .indicator-label').hide();
            $('#submitButtonLoading .indicator-progress').show();
            $('#submitButtonLoading').attr('disabled', true);
            var form = $("#edit_food")[0];
            var formData = new FormData(form);
            let reqType = $('#reqType').val();
            formData.append('reqType', reqType);
            $.ajax({
               url: "{{ route('CreateRaiseFood') }}",
               method: 'POST',
               data: formData,
               processData: false,
               contentType: false,
               success: function(response) {
                  $('#forResponse').hide();
                  $('#edit_food')[0].reset();
                  $('#closeModalBtn').trigger('click');
                  $('#submitButtonLoading .indicator-label').show();
                  $('#submitButtonLoading .indicator-progress').hide();
                  $('#submitButtonLoading').attr('disabled', false);
                  toastr.success('Record Update successfully !!', "", {
                     toastClass: "toast-success",
                     progressBar: true
                  });
               },
               error: function(xhr, status, error) {
                  $('#submitButtonLoading .indicator-label').show();
                  $('#submitButtonLoading .indicator-progress').hide();
                  $('#submitButtonLoading').attr('disabled', false);
                  toastr.error("Something went wrong !!", "Error", {
                     toastClass: "toast-error",
                     progressBar: true
                  });
                  console.error(error);
               }
            });
         }
      });

      function editfoodModal(el) {
         var tr = $(el).closest('tr');
         var foodID = tr.find('#foodID').text();
         var foodDate = tr.find('#fDate').text();
         var foodAmount = tr.find('#fAmount').text();
         var foodReceipt_No = tr.find('#receipt_No').text();
         var foodreceipt_File = tr.find('#receipt_File').text();
         var foodRemarks = tr.find('#remakrs').text();
         var downloadLink = $('#downloadLink');
         var downloadUrl = `{{ asset('reimbursement/ExpenseFood/') }}/` + foodreceipt_File;
         downloadLink.attr('href', downloadUrl);
         $('#FoodReceiptFile').val(foodreceipt_File);
         $('#FoodDate').val(foodDate);
         $('#foodID_').val(foodID);
         $('#FoodAmount').val(foodAmount);
         $('#FoodReceiptNo').val(foodReceipt_No);
         $('#FoodRemakrs').val(foodRemarks);

         /*if Req Type = Approve*/
         var ReviewerStatus = tr.find('#ReviewerStatus').text();
         var ReviewerRemakrs = tr.find('#ReviewerRemakrs').text();
         $('#foodStatusReviewer').val(ReviewerStatus);
         $('#foodRemakrsReviewer').val(ReviewerRemakrs);
      }
   </script>
</div>