@extends('includes.master')
@section('content')


<div id="kt_app_content_container" class="app-container container-xxl">
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class=" card-header text-white cardHeader">
               <h4 class="card-title" style=" color: white">Weekly Covid-19 Health Concern</h4>
            </div>
            <div class="card-body">
               <form action="{{ route('covidAckReq') }}" id="covid_Ack" method="POST">
                  @csrf
                  <p class="fw-semibold fs-6 text-gray-500" style="float: right;"><br>
                     Date: {{ date('d-m-Y') }}
                  </p>

                  <p class="fw-semibold fs-6 text-gray-500">To</p>
                  @if($location == "1")
                  <p class="fw-semibold fs-6 text-gray-500">The HR Manager,<br>
                     Cogent E-Services Limited,<br>
                     C-121, Sector 63,<br>
                     Noida- 201301.<br>
                     Uttar Pradesh.
                  </p>
                  @elseif($location == "2")
                  <p class="fw-semibold fs-6 text-gray-500">The HR Manager,<br>
                     Cogent E-Services Limited,<br>
                     C-121, Sector 63,<br>
                     Noida- 201301.<br>
                     Uttar Pradesh.
                  </p>
                  @elseif($location == "3")
                  <p class="fw-semibold fs-6 text-gray-500">The HR Manager,<br>
                     Cogent E-Services Limited, <br>3rd Floor Apex Tower, <br>1/1, Mangal Pandey Nagar, Meerut<br>Uttar Pradesh.
                  </p>
                  @elseif($location == "4")
                  <p class="fw-semibold fs-6 text-gray-500">The HR Manager,<br>
                     Cogent E-Services Limited, <br>3rd floor, JJ Mall, Ayub khan chawraha, <br>Civil lines, Bareilly (U.P) – 243001
                  </p>
                  @elseif($location == "5")
                  <p class="fw-semibold fs-6 text-gray-500">The HR Manager,<br>
                     Cogent E-Services Limited, <br>Zenith tins compound, <br>Opp Ramakaka dairy chhani,<br>391740 Vadodara Gujrat.
                  </p>
                  @endif


                  <h4 class="text-gray-700 text-center w-bolder mb-4">Subject: Employee Health Declaration</h4>
                  <p class="fw-semibold fs-6 text-gray-500">This is to inform you that I am working with Cogent E-Services Limited and have resumed the services in a healthy state. I declare that my residence is not sealed/marked in any CONTAINMENT ZONE as defined under COVID guidelines.</p>

                  <p class="fw-semibold fs-6 text-gray-500">Further I also declare, if my area or residence where I reside is marked as CONTAINMENT AREA in the future, I will immediately inform the status change on 9891886100.</p>

                  <p class="fw-semibold fs-6 text-gray-500">It is further stated that in case I feel unwell or come in contact with any COVID infected person, I will inform my reporting supervisor on an immediate basis. I declare to take all precautions and keep social distancing at my workplace.</p>
                  <p class="fw-semibold fs-6 text-gray-500 mb-2 ">Yours Sincerely,<br>
                     Employee Name: <b>{{ session('EmployeeName')}}</b><br>
                     Employee ID: <b>{{ session('EmployeeID')}}</b></p>
                  <div class="row g-9 mb-8">
                     <div class="col-md-6 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                           <span class="required">Mobile No.</span>
                           <span class="ms-1" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference">
                           </span>
                        </label>
                        <input class="form-control" placeholder="Enter Mobile No." oninput="limitInput(this)" id="mobileNo" name="mobileNo" />
                        <div class="invalid-feedback">
                           Please provide Mobile Number.
                        </div>
                     </div>
                     <div class="col-md-6 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                           <span class="required">Address</span>
                           <span class="ms-1" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference">
                           </span>
                        </label>
                        <input class="form-control" placeholder="Enter Address" id="address" name="address" />
                        <div class="invalid-feedback">
                           Please provide Address.
                        </div>
                     </div>

                  </div>
                  <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary" style="float: right;">
                     Acknowledge
                  </button>
               </form>
            </div>
         </div>
      </div>
   </div>
   <script>
      function limitInput(input) {

         input.value = input.value.replace(/\D/g, '');
         if (input.value.length > 7) {
            input.value = input.value.slice(0, 10);
         }
      }
      document.getElementById("covid_Ack").addEventListener("submit", function(event) {
         event.preventDefault();
         var isValid = true;
         var reviewerSelect = document.querySelector("[name='mobileNo']");
         if (!reviewerSelect.value) {
            reviewerSelect.classList.add("is-invalid");
            isValid = false;
         } else {
            reviewerSelect.classList.remove("is-invalid");
         }

         var commentTextarea = document.querySelector("[name='address']");
         if (!commentTextarea.value) {
            commentTextarea.classList.add("is-invalid");
            isValid = false;
         } else {
            commentTextarea.classList.remove("is-invalid");
         }

         if (isValid) {
            this.submit();
         }
      });
   </script>



   @endsection