<input type="text" value="{{ $type }}" id="reqType" hidden>

<div id="forResponse">
   <!--begin::Table-->
   @if ($TravelData->isNotEmpty())
   <div class="card cardOutline">
      <div class="card-body">
         <div class="table-responsive">
            <!--begin::Table-->
            <table id="example" class="table align-middle table-row-dashed fs-6 gy-5">
               <thead>
                  <th class="text-end min-w-120px">Action</th>
                  <th class="text-end min-w-120px">EmployeeID</th>
                  <th class="text-end min-w-120px">Employee Name</th>
                  <th class="text-end min-w-120px">Date</th>
                  <th class="text-end min-w-120px">Place From</th>
                  <th class="text-end min-w-120px">Place To</th>
                  <th class="text-end min-w-120px">Travel Type</th>
                  <th class="text-end min-w-120px">returnDate</th>
                  <th class="text-end min-w-120px">car_km</th>
                  <th class="text-end min-w-120px">car_km_receipt</th>
                  <th class="text-end min-w-120px">car_parking_receipt</th>
                  <th class="text-end min-w-120px">car_toll_receipt</th>
                  <th class="text-end min-w-120px">Amount</th>
                  <th class="text-end min-w-120px">Receipt No</th>
                  <th class="text-end min-w-120px">Receipt</th>
                  <th class="min-w-200px">Remarks</th>
                  <th class="text-end min-w-120px">Status</th>
                  @if ($type === 'approve')
                  <th class="min-w-100px">Reviewer Status</th>
                  <th class="min-w-200px">Reviewer Comment</th>
                  @endif
                  <th class="text-end min-w-120px">Created On</th>
                  <th hidden>ID</th>
                  <th hidden>Receipt Image Path</th>
                  <th hidden>Receipt Image Path km</th>
                  <th hidden>Receipt Image Path pk</th>
                  <th hidden>Receipt Image Path toll</th>
               </thead>
               <tbody class="fw-semibold text-gray-600">

                  @foreach ($TravelData as $employeeData)
                  <tr>
                     <td><button onclick="editfoodModal(this)" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#food_edit_modal"><i class="bi bi-pencil-square text-success"></i></button></td>
                     <td id="empID">{{ $employeeData->EmployeeID }}</td>
                     <td id="empName">{{ $employeeData->empName }}</td>
                     <td id="tDate">{{ $employeeData->date }}</td>
                     <td id="placeFrom">{{ $employeeData->placeFrom }}</td>
                     <td id="placeTO">{{ $employeeData->placeTO }}</td>

                     <td id="modeOftravel">{{ $employeeData->modeOftravel }}</td>
                     <td id="returnDate">{{ $employeeData->returnDate }}</td>
                     <td id="car_km">{{ $employeeData->car_km }}</td>
                     @if($employeeData->car_km_receipt)
                     <td>
                        <a href="{{ asset('reimbursement/ExpenseTrevel/'.$employeeData->car_km_receipt) }}" download>
                           <i class="fas fa-download text-success" title="Download File"></i>
                        </a>
                     </td>
                     @else
                     <td><i class="bi bi-x text-danger"> </i></td>
                     @endif
                     @if($employeeData->car_parking_receipt)
                     <td>
                        <a href="{{ asset('reimbursement/ExpenseTrevel/'.$employeeData->car_parking_receipt) }}" download>
                           <i class="fas fa-download text-success" title="Download File"></i>
                        </a>
                     </td>
                     @else
                     <td><i class="bi bi-x text-danger"> </i></td>
                     @endif
                     @if($employeeData->car_toll_receipt)
                     <td>
                        <a href="{{ asset('reimbursement/ExpenseTrevel/'.$employeeData->car_toll_receipt) }}" download>
                           <i class="fas fa-download text-success" title="Download File"></i>
                        </a>
                     </td>
                     @else
                     <td><i class="bi bi-x text-danger"> </i></td>
                     @endif
                     <td id="tamount">{{ $employeeData->amount }}</td>
                     <td id="receipt_No">{{ $employeeData->receipt_no }}</td>
                     @if($employeeData->receipt_image)
                     <td>
                        <a href="{{ asset('reimbursement/ExpenseTrevel/'.$employeeData->receipt_image) }}" download>
                           <i class="fas fa-download text-success" title="Download File"></i>
                        </a>
                     </td>
                     @else
                     <td><i class="bi bi-x text-danger"> </i></td>
                     @endif

                     <td id="remakrs">{{ $employeeData->remarks }}</td>
                     <td>{{ $employeeData->req_status }}</td>
                     @if ($type === 'approve')
                     <td id="ReviewerStatus">{{ $employeeData->reviewerStatus }}</td>
                     <td id="ReviewerRemakrs">{{ $employeeData->reviewComment }}</td>
                     @endif
                     <td>{{ $employeeData->created_at }}</td>
                     <td hidden id="travelID">{{ $employeeData->id }}</td>
                     <td hidden id="receipt_File">{{ $employeeData->receipt_image }}</td>
                     <td hidden id="receipt_FileKm">{{ $employeeData->car_km_receipt }}</td>
                     <td hidden id="receipt_FilePk">{{ $employeeData->car_parking_receipt }}</td>
                     <td hidden id="receipt_FileTol">{{ $employeeData->car_toll_receipt }}</td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
         <!--end::Table-->
      </div>
      <!--end::Card body-->
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
   @if ($TravelData->isNotEmpty())
   <div class="modal fade" tabindex="-1" id="food_edit_modal">
      <div class="modal-dialog modal-dialog-scrollable" style="max-width: 900px ; width: 90%;"> <!-- Added modal-xl class for extra-large width -->
         <div class="modal-content">
            <div class="modal-header">
               <h3 class="modal-title">Travel Expense</h3>
               <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                  <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
               </div>
            </div>
            <div class="modal-body ">
               <form id="edit_food" class="form" method="POST" enctype="multipart/form-data">
                  @csrf
                  <input type="text" class="form-control" readonly maxlength="10" hidden placeholder="Receipt No" id="TravelReceiptFile" name="TravelReceiptFile" />
                  <input type="text" class="form-control" readonly maxlength="10" hidden placeholder="Receipt No" id="TravelID_" name="TravelID_" />
                  <div class="row g-9 mb-8">
                     <div class="col-md-4 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                           <span>Date</span>
                           <span class="ms-1" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference">
                           </span>
                        </label>
                        <input type="text" class="form-control" placeholder="Pick date rage" id="travelDate" name="travelDate" readonly />
                     </div>
                     <div class="col-md-4 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                           <span>Place From</span>
                        </label>

                        <input type="text" readonly class="form-control" placeholder="Enter Ammount" id="placeFrom_" name="placeFrom" />
                     </div>
                     <div class="col-md-4 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                           <span>Place To</span>
                           <span class="ms-1" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference">
                           </span>
                        </label>
                        <input type="text" class="form-control" readonly maxlength="10" placeholder="Receipt No" id="placeTo_" name="placeTo" />
                     </div>


                     <div class="col-md-4 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                           <span>Made Of Tarvel</span>
                        </label>

                        <input type="text" readonly class="form-control" placeholder="Enter Ammount" id="modeOftravel_" name="modeOftravel" />
                     </div>


                     <div class="col-md-4 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                           <span>Amount</span>
                        </label>

                        <input type="text" readonly class="form-control" placeholder="Enter Ammount" id="travelAmount" name="travelAmount" />
                     </div>
                     <div class="col-md-4 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                           <span>Receipt No</span>
                           <span class="ms-1" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference">
                           </span>
                        </label>
                        <input type="text" class="form-control" readonly maxlength="10" placeholder="Receipt No" id="travelReceiptNo" name="travelReceiptNo" />
                     </div>
                     <div class="row mt-4">
                        <div class="col-md-4 fv-row">
                           <a id="downloadLinkCarKm" class="btn btn-primary" href="#" download>
                              <i class="fas fa-download text-success" title="Download File"></i>
                              Car KM Receipt
                           </a>
                        </div>
                        <div class="col-md-4 fv-row">
                           <a id="downloadLinkCarPk" class="btn btn-primary" href="#" download>
                              <i class="fas fa-download text-success" title="Download File"></i>
                              Car PK Receipt
                           </a>
                        </div>
                        <div class="col-md-4 fv-row">
                           <a id="downloadLinkCarTol" class="btn btn-primary" href="#" download>
                              <i class="fas fa-download text-success" title="Download File"></i>
                              Car Toll Receipt
                           </a>
                        </div>
                     </div>
                     @if ($type === 'approve')
                     <div class="col-md-6 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                           <span>Reviewer</span>
                           <span class="ms-1" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference">
                           </span>
                        </label>
                        <input type="text" class="form-control" readonly id="reviewerStatus_" name="reviewerStatus_" />
                     </div>
                     <div class="col-md-6 fv-row ">
                        <a id="downloadLink" class="btn btn-primary" href="#" download style="margin-left: 13rem;">
                           <i class="fas fa-download text-success" title="Download File"></i>
                           Receipt File
                        </a>
                     </div>
                     <div class="col-md-6 fv-row">
                        <label class="fs-6 fw-semibold mb-2">Reviewer Remarks</label>
                        <textarea class="form-control" rows="3" name="FoodReviewerComment" readonly id="reviewComment_"></textarea>
                     </div>
                     <div class="col-md-6 fv-row">
                        <label class="fs-6 fw-semibold mb-2">Remarks</label>
                        <textarea class="form-control" rows="3" name="travelRemakrs" readonly id="travelRemakrs" placeholder="Type Comment Details"></textarea>
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
                           Please select Approver status.
                        </div>
                     </div>
                     <div class="d-flex flex-column mb-8">
                        <label class="required">Approver Comment</label>
                        <textarea class="form-control" rows="3" name="TravelCommentApprover" placeholder="Type Comment Details"></textarea>
                        <div class="invalid-feedback">
                           Please provide Approver comment.
                        </div>
                     </div>
                     @else
                     <div class="col-md-4 fv-row ">
                        <a id="downloadLink" class="btn btn-primary" href="#" download >
                           <i class="fas fa-download text-success" title="Download File"></i>
                            Receipt File
                        </a>
                     </div>

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
                        <textarea class="form-control" rows="3" name="TravelCommentReviewer" placeholder="Type Comment Details"></textarea>
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
         // $('#example').DataTable();
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
         //var commentTextarea = document.querySelector("[name='TravelCommentReviewer']");
         var commentTextarea = reqType === "review" ? document.querySelector("[name='TravelCommentReviewer']") :
            document.querySelector("[name='TravelCommentApprover']");
           

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
               url: "{{ route('createReiseTravel') }}",
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
         var travelID = tr.find('#travelID').text();
         var travelDate = tr.find('#tDate').text();
         var placeFrom = tr.find('#placeFrom').text();
         var placeTo = tr.find('#placeTO').text();
         var travelAmount = tr.find('#tamount').text();
         var modeOftravel = tr.find('#modeOftravel').text();
         var TravelReceipt_No = tr.find('#receipt_No').text();
         var TravelRemarks = tr.find('#remakrs').text();
         var travelreceipt_File = tr.find('#receipt_File').text();
         var ReviewerStatus = tr.find('#ReviewerStatus').text();
         var ReviewerRemakrs = tr.find('#ReviewerRemakrs').text();


         if (modeOftravel === "car") {
            $('#downloadLink').hide();
            $('#downloadLinkCarKm').show();
            $('#downloadLinkCarPk').show();
            $('#downloadLinkCarTol').show();
            let receipt_FileKm = tr.find('#receipt_FileKm').text();
            let receipt_FilePk = tr.find('#receipt_FilePk').text();
            let receipt_FileTol = tr.find('#receipt_FileTol').text();
            if (receipt_FileKm.trim() !== '') {
               let downloadLinkKm = $('#downloadLinkCarKm');
               let downloadUrl = `{{ asset('reimbursement/ExpenseTrevel/') }}/` + receipt_FileKm;
               downloadLinkKm.attr('href', downloadUrl);
            } else {
               $('#downloadLinkCarKm').hide()
            }
            if (receipt_FilePk.trim() !== '') {
               let downloadLinkCarPk = $('#downloadLinkCarPk');
               let downloadUrlPK = `{{ asset('reimbursement/ExpenseTrevel/') }}/` + receipt_FilePk;
               downloadLinkCarPk.attr('href', downloadUrlPK);
            } else {
               $('#downloadLinkCarPk').hide();
            }
            if (receipt_FileTol.trim() !== '') {
               let downloadLinkCarTol = $('#downloadLinkCarTol');
               let downloadUrlToll = `{{ asset('reimbursement/ExpenseTrevel/') }}/` + receipt_FileTol;
               downloadLinkCarTol.attr('href', downloadUrlToll);
            } else {
               $('#downloadLinkCarTol').hide();
            }

         } else {
            $('#downloadLink').show();

            $('#downloadLinkCarKm').hide();
            $('#downloadLinkCarPk').hide();
            $('#downloadLinkCarTol').hide();

            if (travelreceipt_File.trim() !== '') {
               var downloadLink = $('#downloadLink');
               var downloadUrl = `{{ asset('reimbursement/ExpenseTrevel/') }}/` + travelreceipt_File;
               downloadLink.attr('href', downloadUrl);
            } else {
               $('#downloadLink').hide();
            }
         }
         $('#TravelReceiptFile').val(travelreceipt_File);
         $('#travelDate').val(travelDate);
         $('#TravelID_').val(travelID);
         $('#travelAmount').val(travelAmount);
         $('#travelReceiptNo').val(TravelReceipt_No);
         $('#travelRemakrs').val(TravelRemarks);
         $('#modeOftravel_').val(modeOftravel);
         $('#placeFrom_').val(placeFrom);
         $('#placeTo_').val(placeTo);
         $('#reviewerStatus_').val(ReviewerStatus);
         $('#reviewComment_').val(ReviewerRemakrs);
      }
   </script>
</div>