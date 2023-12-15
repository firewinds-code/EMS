<input type="text" value="{{ $type }}" id="reqType" hidden>
<div id="forResponse">
    <!--begin::Table-->
    @if ($hotelData->isNotEmpty())
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
                                    <th class="min-w-100px">Date From</th>
                                    <th class="min-w-100px">Date To</th>
                                    <th class="min-w-100px">No Of Days</th>
                                    <th class="min-w-120px">Visited Location</th>
                                    <th class="min-w-100px">Visited Clien</th>
                                    <th class="min-w-100px">Hotel Name</th>
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
                                @if ($hotelData->isNotEmpty())
                                    @foreach ($hotelData as $employeeData)
                                        <tr>
                                            <td><button onclick="editfoodModal(this)" class="btn btn-link"
                                                    data-bs-toggle="modal" data-bs-target="#food_edit_modal"><i
                                                        class="bi bi-pencil-square text-success"></i></button></td>
                                            <td id="HempId">{{ $employeeData->EmployeeID }}</td>
                                            <td id="HempName">{{ $employeeData->empName }}</td>
                                            <td id="HdateFrom">{{ $employeeData->dateFrom }}</td>
                                            <td id="HdateTo">{{ $employeeData->dateTo }}</td>
                                            <td id="HnoOfDays">{{ $employeeData->noOfdays }}</td>
                                            <td id="HLocation">{{ $employeeData->location }}</td>
                                            <td id="HClientName">{{ $employeeData->client_name }}</td>
                                            <td id="HotelName">{{ $employeeData->hotelName }}</td>
                                            <td id="Hammount">{{ $employeeData->amount }}</td>
                                            <td id="HStatus">{{ $employeeData->req_status }}</td>
                                            <td id="HRecipt">{{ $employeeData->receipt_no }}</td>
                                            <td id="HDownloadRecipt">
                                                <a href="{{ asset('reimbursement/ExpenseHotel/' . $employeeData->receipt_image) }}"
                                                    download>
                                                    <i class="fas fa-download text-success" title="Download File"></i>
                                                </a>
                                            </td>
                                            <td id="HRemakrs">{{ $employeeData->remarks }}</td>
                                            @if ($type === 'approve')
                                                <td id="ReviewerStatus">{{ $employeeData->reviewerStatus }}</td>
                                                <td id="ReviewerRemakrs">{{ $employeeData->reviewComment }}</td>
                                            @endif
                                            <td>{{ $employeeData->created_at }}</td>
                                            <td hidden id="hotelID">{{ $employeeData->id }}</td>
                                            <td hidden id="receipt_File">{{ $employeeData->receipt_image }}</td>
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
    @else
        <script>
            toastr.success('No Data Found !!', "", {
                toastClass: "toast-success",
                progressBar: true
            });
        </script>
    @endif
    <!--end::Table-->
    @if ($hotelData->isNotEmpty())
        <div class="modal fade" tabindex="-1" id="food_edit_modal">
            <div class="modal-dialog modal-dialog-scrollable" style="max-width: 900px ; width: 90%;">
                <!-- Added modal-xl class for extra-large width -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Food Expense</h3>
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </div>
                    </div>
                    <div class="modal-body ">
                        <form id="edit_hotel" class="form" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="text" class="form-control" readonly maxlength="10" hidden
                                placeholder="Receipt No" id="HotelReceiptFile" name="HotelReceiptFile" />
                            <input type="text" class="form-control" readonly maxlength="10" hidden
                                placeholder="Receipt No" id="HotelID_" name="HotelID_" />
                            <div class="row g-9 mb-8">
                                <div class="col-md-3 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span>Date From</span>
                                        <span class="ms-1" data-bs-toggle="tooltip"
                                            title="Specify a target name for future usage and reference">
                                        </span>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Pick date rage"
                                        id="hotelDateFrom" name="hotelDateFrom" readonly />
                                </div>
                                <div class="col-md-3 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span>Date To</span>
                                        <span class="ms-1" data-bs-toggle="tooltip"
                                            title="Specify a target name for future usage and reference">
                                        </span>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Pick date rage"
                                        id="hotelDateTo" name="hotelDateTo" readonly />
                                </div>
                                <div class="col-md-3 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span>No Of Days</span>
                                        <span class="ms-1" data-bs-toggle="tooltip"
                                            title="Specify a target name for future usage and reference">
                                        </span>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Pick date rage"
                                        id="noOfDays" name="noOfDays" readonly />
                                </div>
                                <div class="col-md-3 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span>Amount</span>
                                    </label>

                                    <input type="text" readonly class="form-control" placeholder="Enter Ammount"
                                        id="hotelAmount" name="hotelAmount" />
                                </div>
                                <div class="col-md-3 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span>Visited Location</span>
                                        <span class="ms-1" data-bs-toggle="tooltip"
                                            title="Specify a target name for future usage and reference">
                                        </span>
                                    </label>
                                    <input type="text" class="form-control" readonly maxlength="10"
                                        placeholder="Receipt No" id="visitedLocation" name="visitedLocation" />
                                </div>
                                <div class="col-md-3 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span>Visited Client</span>
                                        <span class="ms-1" data-bs-toggle="tooltip"
                                            title="Specify a target name for future usage and reference">
                                        </span>
                                    </label>
                                    <input type="text" class="form-control" readonly maxlength="10"
                                        id="visitedCleint" name="visitedCleint" />
                                </div>
                                <div class="col-md-3 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span>Hotel Name</span>
                                        <span class="ms-1" data-bs-toggle="tooltip"
                                            title="Specify a target name for future usage and reference">
                                        </span>
                                    </label>
                                    <input type="text" class="form-control" readonly maxlength="10"
                                        placeholder="Receipt No" id="hotelName" name="hotelName" />
                                </div>
                                <div class="col-md-3 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span>Receipt No</span>
                                        <span class="ms-1" data-bs-toggle="tooltip"
                                            title="Specify a target name for future usage and reference">
                                        </span>
                                    </label>
                                    <input type="text" class="form-control" readonly maxlength="10"
                                        placeholder="Receipt No" id="hotelReceiptNo" name="hotelReceiptNo" />
                                </div>
                                <div class="col-md-6 fv-row mt-17">
                                    <a id="downloadLink" class="btn btn-primary" href="#" download
                                        style="margin-top: 25px;">
                                        <i class="fas fa-download text-success" title="Download File"></i>
                                        Download Receipt File
                                    </a>
                                </div>
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Remarks</label>
                                    <textarea class="form-control" rows="3" name="hotelRemakrs" readonly id="hotelRemakrs"
                                        placeholder="Type Comment Details"></textarea>
                                </div>

                                @if ($type === 'approve')
                                    <div class="col-md-6 fv-row">
                                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                            <span>Reviewer Status</span>
                                            <span class="ms-1" data-bs-toggle="tooltip"
                                                title="Specify a target name for future usage and reference">
                                            </span>
                                        </label>
                                        <input type="text" class="form-control" readonly maxlength="10"
                                            placeholder="Receipt No" id="hotelStatusReviewer"
                                            name="hotelStatusReviewer" />
                                    </div>
                                    <div class="col-md-6 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">Reviewer Remarks</label>
                                        <textarea class="form-control" rows="3" name="hotelRemakrsReviewer" readonly id="hotelRemakrsReviewer"
                                            placeholder="Type Comment Details"></textarea>
                                    </div>
                                    <div class="col-md-12 fv-row">
                                        <label for="exampleFormControlInput1" class="form-label">
                                            <span class="required">Approver</span>
                                        </label>
                                        <select class="form-select" data-control="select2" data-hide-search="true"
                                            data-placeholder="--select--" name="Approver">
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
                                        <textarea class="form-control" rows="3" name="HotelCommentApprover" placeholder="Type Comment Details"></textarea>
                                        <div class="invalid-feedback">
                                            Please provide a Approver comment.

                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-12 fv-row">
                                        <label for="exampleFormControlInput1" class="form-label">
                                            <span class="required">Reviewer</span>
                                        </label>
                                        <select class="form-select" data-control="select2" data-hide-search="true"
                                            data-placeholder="--select--" name="Reviewer">
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
                                        <textarea class="form-control" rows="3" name="HotelCommentReviewer" placeholder="Type Comment Details"></textarea>
                                        <div class="invalid-feedback">
                                            Please provide a reviewer comment.
                                        </div>
                                    </div>
                                @endif

                                <div class="modal-footer">
                                    <button type="button" id="closeModalBtn" class="btn btn-light"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" id="submitButtonLoading" class="btn btn-primary">
                                        <span class="indicator-label">Submit</span>
                                        <span class="indicator-progress" style="display: none;">
                                            Please wait... <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span>
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
    <link href="{{ asset('utills/dist/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />
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
                    const realDate = moment(dateRow[3].innerHTML, "DD MMM YYYY, LT")
                        .format(); // select date from 4th column in table
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
        $(document).ready(function() {
            // $('#example').DataTable();
            $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: ['csv', 'excel'],
            });
        });
        document.getElementById("edit_hotel").addEventListener("submit", function(event) {
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


            var commentTextarea = reqType === "review" ? document.querySelector("[name='HotelCommentReviewer']") :
                document.querySelector("[name='HotelCommentApprover']");
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
                var form = $("#edit_hotel")[0];
                var formData = new FormData(form);
                let reqType = $('#reqType').val();
                formData.append('reqType', reqType);
                $.ajax({
                    url: "{{ route('createReiseHotel') }}",
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#forResponse').hide();
                        $('#edit_hotel')[0].reset();
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
            var hotelID = tr.find('#hotelID').text();
            var DateFrom = tr.find('#HdateFrom').text();
            var DateTo = tr.find('#HdateTo').text();
            var HotelAmount = tr.find('#Hammount').text();
            var HnoOfDays = tr.find('#HnoOfDays').text();
            var HLocation = tr.find('#HLocation').text();
            var HClientName = tr.find('#HClientName').text();
            var HotelName = tr.find('#HotelName').text();
            var Hammount = tr.find('#Hammount').text();
            var HRemakrs = tr.find('#HRemakrs').text();
            var hotelReceiptNo = tr.find('#HRecipt').text();
            var foodreceipt_File = tr.find('#receipt_File').text();
            /*if Req Type = Approve*/
            var ReviewerStatus = tr.find('#ReviewerStatus').text();
            var ReviewerRemakrs = tr.find('#ReviewerRemakrs').text();
            $('#hotelStatusReviewer').val(ReviewerStatus);
            $('#hotelRemakrsReviewer').val(ReviewerRemakrs);
            var downloadLink = $('#downloadLink');
            var downloadUrl = `{{ asset('reimbursement/ExpenseHotel/') }}/` + foodreceipt_File;
            downloadLink.attr('href', downloadUrl);
            $('#hotelDateFrom').val(DateFrom);
            $('#hotelDateTo').val(DateTo);
            $('#hotelAmount').val(Hammount);
            $('#visitedCleint').val(HClientName);
            $('#hotelName').val(HotelName);
            $('#hotelRemakrs').val(HRemakrs);
            $('#noOfDays').val(HnoOfDays);
            $('#visitedLocation').val(HLocation);
            $('#hotelReceiptNo').val(hotelReceiptNo);
            $('#HotelID_').val(hotelID);


        }
    </script>
</div>
