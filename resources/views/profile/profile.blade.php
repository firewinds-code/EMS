@extends('includes.master')
@section('content')
@section('page-title', 'Profile')
@section('page-heading', 'My Profile')
<div id="kt_app_content_container" class="app-container container-xxl">

   <div class="card bg-light shadow-sm cardOutline">
      <div class="card-body">
         <div class="row g-9 mb-8">
            <!-- Left Column for Images -->
            <div class="col-md-3">
               <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative mb-4">
                  <img src="{{ asset('utills/dist/assets/media/avatars/default-small.png') }}" alt="image" class="Profile Image">
                  <div class="position-absolute top-50 start-50 translate-middle text-center" style="background: rgb(233 224 224 / 54%); padding: 8px; border-radius: 5%; left: 50%; transform: translate(-50%, -50%); margin-top: 3rem;">
                     <span class="card-title white-text text-darken-4" style="font-size: 14px;">{{ session("EmployeeID") }}</span>
                  </div>
                  <h4 class="text-center mt-3">{{ session("EmployeeName") }}</h4>
               </div>

               <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                  <img src="https://cogentems.in/erpm/QrSetup/Noida//Q0UwMjIzOTUwMzU3-Ref.png" alt="QR Image">
                  <h4>Download QR Code</h4>
               </div>
            </div>

            <!-- Right Column for Accordion -->
            <div class="col-md-9">
               <!--begin::Accordion-->
               <div class="accordion" id="kt_accordion_1">

                  <div class="accordion-item">
                     <h2 class="accordion-header" id="kt_accordion_1_header_1">
                        <button class="accordion-button   fs-6 fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#profileData" id="profileDetails" aria-expanded="true" aria-controls="kt_accordion_1_body_1" style="height: 3.8rem">
                           Personal Details
                        </button>
                     </h2>
                     <div id="profileData" class="accordion-collapse collapse" aria-labelledby="kt_accordion_1_header_1" data-bs-parent="#kt_accordion_1">
                        <div class="accordion-body" id="getProfileDetails">
                           <div class="spinner-container text-center">
                              <div class="spinner-border m-5" role="status">
                                 <span class="sr-only">Loading...</span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="accordion-item">
                     <h2 class="accordion-header" id="kt_accordion_1_header_2">
                        <button class="accordion-button heightAccrodianHeader fs-6 fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#contectDetails" aria-expanded="false" aria-controls="contectDetails" style="height: 3.8rem">
                           Contact Details
                        </button>
                     </h2>
                     <div id="contectDetails" class="accordion-collapse collapse" aria-labelledby="kt_accordion_1_header_2" data-bs-parent="#kt_accordion_1">
                        <div class="accordion-body" id="getContectDetails">
                           <div class="spinner-container text-center">
                              <div class="spinner-border m-5" role="status">
                                 <span class="sr-only">Loading...</span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="accordion-item">
                     <h2 class="accordion-header" id="kt_accordion_1_header_2">
                        <button class="accordion-button  fs-6 fw-semibold collapsed custom-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#addressDetails" aria-expanded="false" aria-controls="addressDetails" style="height: 3.8rem">
                           Address Details
                        </button>
                     </h2>
                     <div id="addressDetails" class="accordion-collapse collapse" aria-labelledby="kt_accordion_1_header_2" data-bs-parent="#kt_accordion_1">
                        <div class="accordion-body" id="getAddressDetails">
                           <div class="spinner-container text-center">
                              <div class="spinner-border m-5" role="status">
                                 <span class="sr-only">Loading...</span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="accordion-item">
                     <h2 class="accordion-header" id="kt_accordion_1_header_2">
                        <button class="accordion-button fs-6 fw-semibold collapsed custom-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#eduDetails" aria-expanded="false" aria-controls="eduDetails" style="height: 3.8rem">
                           Education Details
                        </button>
                     </h2>
                     <div id="eduDetails" class="accordion-collapse collapse" aria-labelledby="kt_accordion_1_header_2" data-bs-parent="#kt_accordion_1">
                        <div class="accordion-body" id="getEduDetails">
                           <div class="spinner-container text-center">
                              <div class="spinner-border m-5" role="status">
                                 <span class="sr-only">Loading...</span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>



                  <div class="accordion-item">
                     <h2 class="accordion-header" id="kt_accordion_1_header_2">
                        <button class="accordion-button fs-6 fw-semibold collapsed custom-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#documents" aria-expanded="false" aria-controls="documents" style="height: 3.8rem">
                           Documents
                        </button>
                     </h2>
                     <div id="documents" class="accordion-collapse collapse" aria-labelledby="kt_accordion_1_header_2" data-bs-parent="#kt_accordion_1">
                        <div class="accordion-body" id="getDocuments">
                           <div class="spinner-container text-center">
                              <div class="spinner-border m-5" role="status">
                                 <span class="sr-only">Loading...</span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="accordion-item">
                     <h2 class="accordion-header" id="kt_accordion_1_header_2">
                        <button class="accordion-button fs-6 fw-semibold collapsed custom-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#expDetails" aria-expanded="false" aria-controls="expDetails" style="height: 3.8rem">
                           Experience Details
                        </button>
                     </h2>
                     <div id="expDetails" class="accordion-collapse collapse" aria-labelledby="kt_accordion_1_header_2" data-bs-parent="#kt_accordion_1">
                        <div class="accordion-body" id="getExpDetails">
                           <div class="spinner-container text-center">
                              <div class="spinner-border m-5" role="status">
                                 <span class="sr-only">Loading...</span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>


                  <div class="accordion-item">
                     <h2 class="accordion-header" id="kt_accordion_1_header_2">
                        <button class="accordion-button fs-6 fw-semibold collapsed custom-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#empMap" aria-expanded="false" aria-controls="empMap" style="height: 3.8rem">
                           Employee Map
                        </button>
                     </h2>
                     <div id="empMap" class="accordion-collapse collapse" aria-labelledby="kt_accordion_1_header_2" data-bs-parent="#kt_accordion_1">
                        <div class="accordion-body" id="getEmpMapDetails">
                           <div class="spinner-container text-center">
                              <div class="spinner-border m-5" role="status">
                                 <span class="sr-only">Loading...</span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>


                  <div class="accordion-item">
                     <h2 class="accordion-header" id="kt_accordion_1_header_2">
                        <button class="accordion-button fs-6 fw-semibold collapsed custom-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#reportingMap" aria-expanded="false" aria-controls="reportingMap" style="height: 3.8rem">
                           Reporting Map
                        </button>
                     </h2>
                     <div id="reportingMap" class="accordion-collapse collapse" aria-labelledby="kt_accordion_1_header_2" data-bs-parent="#kt_accordion_1">
                        <div class="accordion-body" id="getReportingMap">
                           <div class="spinner-container text-center">
                              <div class="spinner-border m-5" role="status">
                                 <span class="sr-only">Loading...</span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>



                  <div class="accordion-item">
                     <h2 class="accordion-header" id="kt_accordion_1_header_2">
                        <button class="accordion-button fs-6 fw-semibold collapsed custom-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#mngmtContect" aria-expanded="false" aria-controls="mngmtContect" style="height: 3.8rem">
                           Management Contact
                        </button>
                     </h2>
                     <div id="mngmtContect" class="accordion-collapse collapse" aria-labelledby="kt_accordion_1_header_2" data-bs-parent="#kt_accordion_1">
                        <div class="accordion-body" id="getManagementContect">
                           <div class="spinner-container text-center">
                              <div class="spinner-border m-5" role="status">
                                 <span class="sr-only">Loading...</span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  
                  <div class="accordion-item">
                     <h2 class="accordion-header" id="kt_accordion_1_header_2">
                        <button class="accordion-button fs-6 fw-semibold collapsed custom-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#processMap" aria-expanded="false" aria-controls="processMap" style="height: 3.8rem">
                           Process Map
                        </button>
                     </h2>
                     <div id="processMap" class="accordion-collapse collapse" aria-labelledby="kt_accordion_1_header_2" data-bs-parent="#kt_accordion_1">
                        <div class="accordion-body" id="getProcessMap">
                           <div class="spinner-container text-center">
                              <div class="spinner-border m-5" role="status">
                                 <span class="sr-only">Loading...</span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="accordion-item">
                     <h2 class="accordion-header" id="kt_accordion_1_header_2">
                        <button class="accordion-button fs-6 fw-semibold collapsed custom-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#WarnDocs" aria-expanded="false" aria-controls="WarnDocs" style="height: 3.8rem">
                           Warning Docs
                        </button>
                     </h2>
                     <div id="WarnDocs" class="accordion-collapse collapse" aria-labelledby="kt_accordion_1_header_2" data-bs-parent="#kt_accordion_1">
                        <div class="accordion-body" id="getWarnDocs">
                           <div class="spinner-container text-center">
                              <div class="spinner-border m-5" role="status">
                                 <span class="sr-only">Loading...</span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="accordion-item">
                     <h2 class="accordion-header" id="kt_accordion_1_header_2">
                        <button class="accordion-button fs-6 fw-semibold collapsed custom-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#bankPF" aria-expanded="false" aria-controls="bankPF" style="height: 3.8rem">
                           Bank,PF & ESIC Details
                        </button>
                     </h2>
                     <div id="bankPF" class="accordion-collapse collapse" aria-labelledby="kt_accordion_1_header_2" data-bs-parent="#kt_accordion_1">
                        <div class="accordion-body" id="getbankPF">
                           <div class="spinner-container text-center">
                              <div class="spinner-border m-5" role="status">
                                 <span class="sr-only">Loading...</span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

               </div>

               <!--end::Accordion-->

            </div>
         </div>
      </div>
   </div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
   var processedIds = {};

   function callAjax(targetId) {
      // Check if the ID has already been processed
      if (!processedIds[targetId]) {
         processedIds[targetId] = true; // Mark the ID as processed
         var requestData = {
            reqType: `${targetId}`
         };
         console.log(processedIds);

         $('#loader').show();
         $.ajax({
            url: "{{ route('profileDetails') }}",
            method: 'POST',
            data: requestData,
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
               $('#loader').hide();
               if (targetId === '#contectDetails') {
                  $('#getContectDetails').html(response);
               } else if (targetId === '#profileData') {
                  $('#getProfileDetails').html(response);
               } else if (targetId === '#addressDetails') {
                  $('#getAddressDetails').html(response);
               } else if (targetId === "#eduDetails") {
                  $('#getEduDetails').html(response);
               } else if (targetId === '#expDetails') {
                  $('#getExpDetails').html(response);
               } else if (targetId === '#empMap') {
                  $('#getEmpMapDetails').html(response);
               } else if (targetId === '#mngmtContect') {
                  $('#getManagementContect').html(response);
               } else if (targetId === '#reportingMap') {
                  $('#getReportingMap').html(response);
               } else if (targetId === '#processMap') {
                  $('#getProcessMap').html(response);
               } else if (targetId === '#WarnDocs') {
                  $('#getWarnDocs').html(response);
               } else if (targetId === '#bankPF') {
                  $('#getbankPF').html(response);
               } else if (targetId === '#documents') {
                  $('#getDocuments').html(response);
               }
            },
            error: function(xhr, status, error) {
               $('#loader').hide();
               console.error(error);
            }
         });
      }
   }

   $(document).ready(function() {
      var $previousAccordion = null; // Store the previously clicked accordion

      $('.accordion-button').click(function() {
         var $clickedAccordion = $(this);

         if (!$clickedAccordion.hasClass('bgColor')) {
            if ($previousAccordion !== null) {
               $previousAccordion.removeClass('bgColor');
            }

            $clickedAccordion.addClass('bgColor');
            $previousAccordion = $clickedAccordion;
            callAjax($clickedAccordion.data('bs-target'));
         }
      });

      // When an accordion is hidden (closed), remove bgColor class
      $('.accordion-button').on('hidden.bs.collapse', function() {
         $(this).removeClass('bgColor');
      });
   });
</script>
@endsection