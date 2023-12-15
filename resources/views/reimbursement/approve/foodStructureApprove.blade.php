  <div id="forResponse">
     <!--begin::Table-->
     @if ($foodData->isNotEmpty())
     <div class="card card-flush">
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
                       <a href="#" class="menu-link px-3" data-kt-export="copy">
                          Copy to clipboard
                       </a>
                    </div>
                    <!--end::Menu item-->
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
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                       <a href="#" class="menu-link px-3" data-kt-export="pdf">
                          Export as PDF
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
           </div>
           <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->

        <div class="card-body pt-0">
           <!--begin::Table-->
           <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_datatable_example">
              <thead>
                 <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                    <th class="text-end min-w-70px">Action</th>
                    <th class="text-end min-w-100px">EmployeeID</th>
                    <th class="text-end min-w-150px">Employee Name</th>
                    <th class="text-end min-w-100px">Date</th>
                    <th class="text-end min-w-100px">Amount</th>
                    <th class="text-end min-w-100px">Receipt No</th>
                    <th class="text-end min-w-120px">Receipt Image</th>
                    <th class="min-w-200px">Remarks</th>
                    <th class="text-end min-w-100px">Status</th>
                    <th class="text-end min-w-120px">Reviewer Status</th>
                    <th class="text-end min-w-120px">Reviewer Comment</th>
                    <th class="text-end min-w-100px">Created On</th>
                    <th hidden>ID</th>
                    <th hidden>Receipt Image Path</th>
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
                    <td id="receipt_No">{{ $employeeData->receipt_no }}</td>
                    <td>
                       <a href="{{ asset('reimbursement/ExpenseFood/'.$employeeData->receipt_image) }}" download>
                          <i class="fas fa-download text-success" title="Download File"></i>
                       </a>
                    </td>

                    <td id="remakrs">{{ $employeeData->remarks }}</td>
                    <td>{{ $employeeData->req_status }}</td>
                    <td id="reviewerStatus">{{ $employeeData->reviewerStatus }}</td>
                    <td id="reviewComment">{{ $employeeData->reviewComment }}</td>
                    <td>{{ $employeeData->created_at }}</td>
                    <td hidden id="foodID">{{ $employeeData->id }}</td>
                    <td hidden id="receipt_File">{{ $employeeData->receipt_image }}</td>
                 </tr>
                 @endforeach

              </tbody>
           </table>
           <!--end::Table-->
        </div>
        @else
        <script>
           toastr.success('No Data Found !!', "", {
              toastClass: "toast-success",
              progressBar: true
           });
        </script>
        @endif
        <!--end::Card body-->
     </div>
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

                       <div class="col-md-6 fv-row">
                          <a id="downloadLink" class="btn btn-primary" href="#" download style="margin-top: 25px;">
                             <i class="fas fa-download text-success" title="Download File"></i>
                             Download Receipt File
                          </a>
                       </div>
                       <div class="col-md-6 fv-row">
                          <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                             <span>Reviewer</span>
                             <span class="ms-1" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference">
                             </span>
                          </label>
                          <input type="text" class="form-control" readonly id="FoodRReviewrsStatus" name="FoodRReviewrsStatus" />
                       </div>
                       <div class="col-md-6 fv-row">
                          <label class="fs-6 fw-semibold mb-2">Remarks</label>
                          <textarea class="form-control" rows="3" name="FoodRemakrs" readonly id="FoodRemakrs" placeholder="Type Comment Details"></textarea>
                       </div>
                       <div class="col-md-6 fv-row">
                          <label class="fs-6 fw-semibold mb-2">Reviewer Remarks</label>
                          <textarea class="form-control" rows="3" name="FoodReviewerComment" readonly id="FoodReviewerComment"></textarea>
                       </div>



                       <div class="col-md-6 fv-row">
                          <label for="exampleFormControlInput1" class="form-label">
                             <span class="required">Approver</span>
                          </label>
                          <select class="form-select" data-control="select2" data-hide-search="true" data-placeholder="--select--" name="Approver">
                             <option value="">--select--</option>
                             <option value="Approve">Approve</option>
                             <option value="Decline">Decline</option>
                          </select>
                          <div class="invalid-feedback">
                             Please select a reviewer status.
                          </div>
                       </div>
                       <div class="col-md-6 fv-row">
                          <label class="required">Approver Comment</label>
                          <textarea class="form-control" rows="3" name="FoodCommentApprover" placeholder="Type Comment Details"></textarea>
                          <div class="invalid-feedback">
                             Please provide a reviewer comment.
                          </div>
                       </div>

                    </div>



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

     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
     <link href="{{ asset('utills/dist/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
     <script src=" {{ asset('utills/dist/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
     <script>
        var KTDatatablesExample = function() {
           // Shared variables
           var table;
           var datatable;

           // Private functions
           var initDatatable = function() {
              // Set date data order
              const tableRows = table.querySelectorAll('tbody tr');

              tableRows.forEach(row => {
                 const dateRow = row.querySelectorAll('td');
                 const realDate = moment(dateRow[3].innerHTML, "DD MMM YYYY, LT").format(); // select date from 4th column in table
                 dateRow[3].setAttribute('data-order', realDate);
              });

              // Init datatable --- more info on datatables: https://datatables.net/manual/
              datatable = $(table).DataTable({
                 "info": false,
                 'order': [],
                 'pageLength': 10,
              });
           }
           // Refresh the datatable
           var refreshDatatable = function() {
              datatable.clear().draw(); // Clear the existing data
              datatable.ajax.reload(); // Fetch and load new data from the server (if applicable)
           }

           // Hook export buttons
           var exportButtons = () => {
              const documentTitle = 'Customer Orders Report';
              var buttons = new $.fn.dataTable.Buttons(table, {
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
              const exportButtons = document.querySelectorAll('#kt_datatable_example_export_menu [data-kt-export]');
              exportButtons.forEach(exportButton => {
                 exportButton.addEventListener('click', e => {
                    e.preventDefault();

                    // Get clicked export value
                    const exportValue = e.target.getAttribute('data-kt-export');
                    const target = document.querySelector('.dt-buttons .buttons-' + exportValue);

                    // Trigger click event on hidden datatable export buttons
                    target.click();
                 });
              });
           }

           // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
           var handleSearchDatatable = () => {
              const filterSearch = document.querySelector('[data-kt-filter="search"]');
              filterSearch.addEventListener('keyup', function(e) {
                 datatable.search(e.target.value).draw();
              });
           }

           // Public methods
           return {
              init: function() {
                 table = document.querySelector('#kt_datatable_example');

                 if (!table) {
                    return;
                 }

                 initDatatable();
                 exportButtons();
                 handleSearchDatatable();
              },
              refreshTable: refreshDatatable // Add the refresh function to the returned object
           };
        }();
        KTUtil.onDOMContentLoaded(function() {
           KTDatatablesExample.init();
        });
        // Call the refreshTable function whenever you need to refresh the table
        function someFunctionThatNeedsTableRefresh() {
           KTDatatablesExample.refreshTable(); // Call the refresh function from your KTDatatablesExample object
        }
     </script>


     <script>
        document.getElementById("edit_food").addEventListener("submit", function(event) {
           event.preventDefault();
           var isValid = true;
           var reviewerSelect = document.querySelector("[name='Approver']");
           if (!reviewerSelect.value) {
              reviewerSelect.classList.add("is-invalid");
              isValid = false;
           } else {
              reviewerSelect.classList.remove("is-invalid");
           }

           var commentTextarea = document.querySelector("[name='FoodCommentApprover']");
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
              formData.append('reqType', 'Approver');
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
           var foodReviewerStatus = tr.find('#reviewerStatus').text();
           var foodReviewComment = tr.find('#reviewComment').text();



           var downloadLink = $('#downloadLink');
           var downloadUrl = `{{ asset('reimbursement/ExpenseFood/') }}/` + foodreceipt_File;
           downloadLink.attr('href', downloadUrl);
           $('#FoodReceiptFile').val(foodreceipt_File);
           $('#FoodDate').val(foodDate);
           $('#foodID_').val(foodID);
           $('#FoodAmount').val(foodAmount);
           $('#FoodReceiptNo').val(foodReceipt_No);
           $('#FoodRemakrs').val(foodRemarks);
           $('#FoodReviewerComment').val(foodRemarks);
           $('#FoodRReviewrsStatus').val(foodReviewerStatus);
        }
     </script>
  </div>