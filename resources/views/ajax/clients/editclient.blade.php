<form action="{{ url('updateClient') }}" class="form mb-15" method="post" id="update_clients_form">
    <!--begin::Input group-->
  @csrf
   <div class="row mb-5">
    <input type="hidden" name="cm_id" id="cm_id">
       <!--begin::Col-->
       <div class="col-md-4 fv-row mb-7 fv-plugins-icon-container" >
           <label class="required fs-6 fw-semibold mb-2">Location</label>
           <select  aria-label="Select a Location" id="editlocation" name="location"  data-control="select2"  data-placeholder="Select a Location..." class="form-select form-select-solid form-select-lg fw-semibold">
               @php  $location = getlocation(); @endphp
               <option  value="">Please Select Location</option>
               @foreach($location as $list)
                  <option  value="{{ $list->id }}">{{ $list->location }}</option>
               @endforeach
           </select>

      </div>

       <!--end::Col-->
       <!--begin::Col-->
       <div class="col-md-4 fv-row">
           <!--end::Label-->
           <label class="fs-5 fw-semibold mb-2">Client Name</label>
           <!--end::Label-->
           <!--end::Input-->
           <input type="text" class="form-control form-control-solid" placeholder="Enter Client Name" name="editclientname" id="editclientname" />
           <!--end::Input-->
       </div>

      <div class="col-md-4 fv-row mb-7 fv-plugins-icon-container" >
           <label class="required fs-6 fw-semibold mb-2">Account Head</label>
           <select  aria-label="Select Account Head" id="edit_account_head" name="edit_account_head" data-control="select2" data-placeholder="Select Account Head" class="form-select form-select-solid form-select-lg fw-semibold">
           </select>
       </div>
      <!--end::Col-->
      </div>

      <div class="row mb-5">
       <!--begin::Col-->
       <div class="col-md-4 fv-row mb-7 fv-plugins-icon-container" >
           <label class="required fs-6 fw-semibold mb-2">Vertical Head</label>
           <select  aria-label="Select a Vertical Head" id="edit_vertical_head" name="edit_vertical_head" data-control="select2" data-placeholder="Select a Vertical Head..." class="form-select form-select-solid ">

           </select>

      </div>


      <div class="col-md-4 fv-row mb-7 fv-plugins-icon-container" >
           <label class="required fs-6 fw-semibold mb-2">Department</label>
           <select  aria-label="Select Department" id="edit_department" name="edit_department" data-control="select2" data-placeholder="Select Department" class="form-select form-select-solid form-select-lg fw-semibold">

           </select>

      </div>
      <!--end::Col-->


      <div class="col-md-4 fv-row">
       <!--end::Label-->
       <label class="required fs-5 fw-semibold mb-2">Process Name</label>
       <!--end::Label-->
       <!--end::Input-->
       <input type="text" class="form-control form-control-solid" placeholder="Enter Process Name" id="edit_process_name" name="edit_process_name" />
       <!--end::Input-->
      </div>
      </div>


      <div class="row mb-5">
       <!--begin::Col-->
       <div class="col-md-4 fv-row mb-7 fv-plugins-icon-container" >
           <label class="required fs-6 fw-semibold mb-2">Operation Head</label>
           <select  aria-label="Select a Operation Head" id="edit_operation_head" name="edit_operation_head" data-control="select2" data-placeholder="Select a Operation Head..." class="form-select form-select-solid form-select-lg fw-semibold">

           </select>

      </div>

       <!--end::Col-->
       <!--begin::Col-->

      <div class="col-md-4 fv-row mb-7 fv-plugins-icon-container" >
           <label class="required fs-6 fw-semibold mb-2">Quality Head</label>
           <select  aria-label="Select Quality Head" id="edit_quality_head" name="edit_quality_head" data-control="select2" data-placeholder="Select Quality Head" class="form-select form-select-solid form-select-lg fw-semibold">

           </select>

      </div>
      <!--end::Col-->
      <div class="col-md-4 fv-row">
       <!--end::Label-->
       <label class="required fs-5 fw-semibold mb-2">Training Head</label>
       <select  aria-label="Select Training Head" id="edit_training_head" name="edit_training_head" data-control="select2" data-placeholder="Select Training Head" class="form-select form-select-solid form-select-lg fw-semibold">

       </select>

       <!--end::Input-->
   </div>
      </div>

      <div class="row mb-5">
       <!--begin::Col-->
       <div class="col-md-4 fv-row mb-7 fv-plugins-icon-container" >
           <label class="required fs-6 fw-semibold mb-2">ER SPOC</label>
           <select  aria-label="Select a ER SPOC" id="edit_er_spoc" name="edit_er_spoc" data-control="select2" data-placeholder="Select a ER SPOC..." class="form-select form-select-solid form-select-lg fw-semibold">

           </select>

      </div>

       <!--end::Col-->
       <!--begin::Col-->

      <div class="col-md-4 fv-row mb-7 fv-plugins-icon-container" >
           <label class="required fs-6 fw-semibold mb-2">ER SPOC 2</label>
           <select  aria-label="Select ER SPOC 2" id="edit_er_spoc2" name="edit_er_spoc2" data-control="select2" data-placeholder="Select ER SPOC 2" class="form-select form-select-solid form-select-lg fw-semibold">

           </select>

      </div>
      <!--end::Col-->
      <div class="col-md-4 fv-row">
       <!--end::Label-->

       <label class="required fs-5 fw-semibold mb-2">ER SPOC 3</label>
       <select  aria-label="Select ER SPOC 3" id="edit_er_spoc3" name="edit_er_spoc3" data-control="select2" data-placeholder="Select ER SPOC 3" class="form-select form-select-solid form-select-lg fw-semibold">

       </select>

      <!--end::Input-->
   </div>
</div>


<div class="row mb-5">

   <div class="col-md-4 fv-row">
       <!--end::Label-->
       <label class="required fs-5 fw-semibold mb-2">Sub Process Name</label>
       <!--end::Label-->
       <!--end::Input-->
       <input type="text" class="form-control form-control-solid" placeholder="Enter Sub Process Name" id="edit_sub_process_name" name="edit_sub_process_name" />
       <!--end::Input-->
      </div>
   <!--begin::Col-->
   <div class="col-md-4 fv-row mb-7 fv-plugins-icon-container" >
       <label class="required fs-6 fw-semibold mb-2">DownTime Quality</label>
       <select  aria-label="Select a DownTime Quality" id="edit_downtime_quality" name="edit_downtime_quality" data-control="select2" data-placeholder="Select a DownTime Quality..." class="form-select form-select-solid form-select-lg fw-semibold">

       </select>

  </div>


  <div class="col-md-4 fv-row mb-7 fv-plugins-icon-container" >
       <label class="required fs-6 fw-semibold mb-2">DownTime Training</label>
       <select  aria-label="Select DownTime Training" id="edit_downtime_training" name="edit_downtime_training" data-control="select2" data-placeholder="Select DownTime Training" class="form-select form-select-solid form-select-lg fw-semibold">

       </select>

  </div>
  <!--end::Col-->
</div>


<div class="row mb-5">

   <div class="col-md-4 fv-row mb-7 fv-plugins-icon-container" >
       <label class="required fs-6 fw-semibold mb-2">DownTime OPS</label>
       <select  aria-label="Select DownTime OPS" id="edit_downtime_ops" name="edit_downtime_ops" data-control="select2" data-placeholder="Select DownTime OPS" class="form-select form-select-solid form-select-lg fw-semibold">

       </select>

  </div>

   <div class="col-md-4 fv-row">
       <!--end::Label-->
       <label class="required fs-5 fw-semibold mb-2">IT</label>
       <!--end::Label-->
       <!--end::Input-->
       <input type="text" class="form-control form-control-solid" maxlength="12" placeholder="IT" name="edit_it" id="edit_it" />
       <!--end::Input-->
      </div>
   <!--begin::Col-->

   <div class="col-md-4 fv-row">
       <!--end::Label-->
       <label class="required fs-5 fw-semibold mb-2">HR</label>
       <!--end::Label-->
       <!--end::Input-->
       <input type="text" class="form-control form-control-solid" maxlength="12"  placeholder="HR" name="edit_hr" id="edit_hr" />
       <!--end::Input-->
      </div>
   <!--end::Col-->
</div>

<div class="row mb-5">

   <div class="col-md-4 fv-row">
       <!--end::Label-->
       <label class="required fs-5 fw-semibold mb-2">Reports To</label>
       <!--end::Label-->
       <!--end::Input-->
       <input type="text" class="form-control form-control-solid" maxlength="12" placeholder="Reports To" id="edit_reports_to" name="edit_reports_to" />
       <!--end::Input-->
      </div>

   <div class="col-md-4 fv-row mb-7 fv-plugins-icon-container" >
       <label class="required fs-6 fw-semibold mb-2">Exception Approver</label>
       <select  aria-label="Select Exception Approver" id="edit_exception_approver" name="edit_exception_approver" data-control="select2" data-placeholder="Select Exception Approver" class="form-select form-select-solid form-select-lg fw-semibold">

       </select>

  </div>

   <div class="col-md-4 fv-row">
       <!--end::Label-->
       <label class="required fs-5 fw-semibold mb-2">Site Spoc</label>
       <select  aria-label="Select Site Spoc" id="edit_site_spoc" name="edit_site_spoc" data-control="select2" data-placeholder="Select Site Spoc" class="form-select form-select-solid form-select-lg fw-semibold">

       </select>

      </div>
   <!--begin::Col-->


   <!--end::Col-->
</div>

<div class="row mb-5">



      <div class="col-md-4 fv-row">
       <!--end::Label-->
       <label class="required fs-5 fw-semibold mb-2">Stipends</label>
       <!--end::Label-->
       <!--end::Input-->
       <input type="text" class="form-control form-control-solid" maxlength="10" id="edit_Stipen2"  name="edit_Stipen2" onkeypress="javascript:return isNumber(event)" placeholder="Stipends"  />
       <!--end::Input-->
      </div>



      <div class="col-md-4 fv-row">
       <!--end::Label-->
       <label class="required fs-5 fw-semibold mb-2">Stipends Days</label>
       <!--end::Label-->
       <!--end::Input-->
       <input type="text" maxlength="2" name="edit_StipendDays" id="edit_StipendDays" onkeypress="javascript:return isNumber(event)"  class="form-control form-control-solid" placeholder="Stipends Days"  />
       <!--end::Input-->
      </div>

   <!--end::Col-->


   <div class="col-md-4 fv-row">
       <!--end::Label-->
       <label class="required fs-5 fw-semibold mb-2">Induction</label>
       <!--end::Label-->
       <!--end::Input-->
       <input type="text" class="form-control form-control-solid" placeholder="Induction" id="edit_induction" name="edit_induction" />
       <!--end::Input-->
      </div>
</div>


<div class="row mb-5">

      <div class="col-md-4 fv-row">
       <!--end::Label-->
       <label class="required fs-5 fw-semibold mb-2">ER Induction</label>
       <!--end::Label-->
       <!--end::Input-->
       <input type="text" maxlength="3"  onkeypress="javascript:return isNumber(event)"  class="form-control form-control-solid" placeholder="ER Induction" name="edit_er_induction" id="edit_er_induction" />
       <!--end::Input-->
      </div>


      <div class="col-md-4 fv-row">
       <!--end::Label-->
       <label class="required fs-5 fw-semibold mb-2">ER Induction Period</label>
       <!--end::Label-->
       <!--end::Input-->
       <input type="text"  id="edit_er_induction_period"  maxlength="3" onkeypress="javascript:return isNumber(event)" class="form-control form-control-solid" placeholder="ER Induction Period" name="edit_er_induction_period" />
       <!--end::Input-->
      </div>

   <!--end::Col-->
</div>
</div>


<div class="card cardOutline">
   <div class="card-header border-0">
       <div class="card-title">
           <span class="card-icon">
               <i class="flaticon2-chat-1 "></i>
           </span>
           <h3 class="card-label">
               Background Verification (BGA)
           </h3>
       </div>
   </div>
   <div class="separator separator-solid separator-white opacity-20"></div>
   <div class="card-body ">
       <div class="form-group row">
           <label class="col-lg-4 col-form-label  fw-semibold fs-6">For Support</label>
             <div class="col-lg-8 fv-row fv-plugins-icon-container fv-plugins-bootstrap5-row-invalid">
               <div class="d-flex align-items-center mt-3">
                   <label class="form-check form-check-custom form-check-inline form-check-solid me-5 is-valid">
                       <input class="form-check-input" name="address_for_support" id="address_for_support" type="checkbox" value="Yes">
                       <span class="fw-semibold ps-2 fs-6">Address</span>
                   </label>

                   <label class="form-check form-check-custom form-check-inline form-check-solid is-invalid">
                       <input class="form-check-input" name="education_for_support" id="education_for_support" type="checkbox" value="Yes">
                       <span class="fw-semibold ps-2 fs-6">Education</span>
                   </label>

                   <label class="form-check form-check-custom form-check-inline form-check-solid me-5 is-valid">
                       <input class="form-check-input" name="employment_for_support" id="employment_for_support" type="checkbox" value="Yes">
                       <span class="fw-semibold ps-2 fs-6">Employment</span>
                   </label>

                   <label class="form-check form-check-custom form-check-inline form-check-solid is-invalid">
                       <input class="form-check-input" name="criminal_for_support" id="criminal_for_support"  type="checkbox" value="Yes">
                       <span class="fw-semibold ps-2 fs-6">Criminal</span>
                   </label>

               </div>

           </div>
        </div>

     <div class="form-group row">

           <label class="col-lg-4 col-form-label  fw-semibold fs-6">For CSA</label>
           <div class="col-lg-8 fv-row fv-plugins-icon-container fv-plugins-bootstrap5-row-invalid">

               <div class="d-flex align-items-center mt-3">
                   <label class="form-check form-check-custom form-check-inline form-check-solid me-5 is-valid">
                       <input class="form-check-input" name="address_for_csa" id="address_for_csa" type="checkbox" value="Yes">
                       <span class="fw-semibold ps-2 fs-6">Address</span>
                   </label>

                   <label class="form-check form-check-custom form-check-inline form-check-solid is-invalid">
                       <input class="form-check-input" name="education_for_csa" id="education_for_csa" type="checkbox" value="Yes">
                       <span class="fw-semibold ps-2 fs-6">Education</span>
                   </label>

                   <label class="form-check form-check-custom form-check-inline form-check-solid me-5 is-valid">
                       <input class="form-check-input" name="employment_for_csa" id="employment_for_csa"  type="checkbox" value="Yes">
                       <span class="fw-semibold ps-2 fs-6">Employment</span>
                   </label>

                   <label class="form-check form-check-custom form-check-inline form-check-solid is-invalid">
                       <input class="form-check-input" name="criminal_for_csa" id="criminal_for_csa" type="checkbox" value="Yes">
                       <span class="fw-semibold ps-2 fs-6">Criminal</span>
                   </label>

               </div>

           </div>
       </div>

   </div>
</div>
   <div class="col-md-4 mt-5 float-right">
       <button type="submit" class="btn btn-primary" id="kt_contact_submit_button">
           <!--begin::Indicator label-->
           <span class="indicator-label">Update Client</span>
           <!--end::Indicator label-->
           <!--begin::Indicator progress-->
           <span class="indicator-progress">Please wait...
           <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
           <!--end::Indicator progress-->
       </button>
   <div>
<!--end::Submit-->
</form>
@include('includes.commonjs')
<script>
$(function(){

$('#update_clients_form').submit(function(event) {
    event.preventDefault();
    $('.error-message').remove();
    let isValid = true;

    $(this).find('.required').each(function() {
        const input = $(this).closest('.fv-row').find(
            '.form-control, select, check');
        if (!input.val()) {
            isValid = false;
            const fieldName = $(this).text();
            const errorMessage = fieldName + ' is required.';
            $('<div class="error-message text-danger">' + errorMessage + '</div>')
                .insertAfter(input);
        }
    });

    if ($('input[type=checkbox]:checked').length == 0) {
        $('#locaErr').show();
        isValid = false;
    }

    if (isValid === true) {

        var url =  $('#update_clients_form').attr('action');
        var form = $('#update_clients_form').serialize();
        $.post(url, form, function(response){
          response.success == true  ?
          Swal.fire({text:response.message,icon:"success",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn btn-primary"}})
          :Swal.fire({text:response.message,icon:"error",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn btn-primary"}})
         });
    } else {



        return false;
    }
});



$('#editlocation').on('change', function(e){
    var location = $(this).val();
     $.ajax({
       url: "{{ url('get-dropdown') }}/" + location +'/excep',
       success: function(result) {
           $("#edit_exception_approver").html(result.html);


       }
   });

   $.ajax({

       url: "{{ url('get-dropdown') }}/" + location +'/excep',
       success: function(result) {
          $("#edit_downtime_quality").html(result.html);
        }
   });

   $.ajax({
       url: "{{ url('get-dropdown') }}/" + location +'/excep',
       success: function(result) {
            $("#edit_downtime_training").html(result.html);
        }
   });

   $.ajax({
       url: "{{ url('get-dropdown') }}/" + location +'/excep',
       success: function(result) {
            $("#edit_downtime_ops").html(result.html);

        }
   });

   $.ajax({
       url: "{{ url('get-dropdown') }}/" + location +'/vh',
       success: function(result) {
            $("#edit_vertical_head").html(result.html);
      }
   });

   $.ajax({
       url: "{{ url('get-dropdown') }}/" + location +'/ah',
       success: function(result) {
          $("#edit_operation_head").html(result.html);
          $("#edit_account_head").html(result.html);
        }
   });

   $.ajax({
       url: "{{ url('get-dropdown') }}/" + location +'/ah',
       success: function(result) {
            $("#edit_quality_head").html(result.html);
       }
   });

   $.ajax({
       url: "{{ url('get-dropdown') }}/" + location +'/ah',
       success: function(result) {
            $("#edit_training_head").html(result.html);
       }
   });

   $.ajax({
       url: "{{ url('get-dropdown') }}/" + location +'/site',
       success: function(result) {
         $("#edit_site_spoc").html(result.html);
         }
   });

   $.ajax({
       url: "{{ url('get-dropdown') }}/" + location +'/hr',
       success: function(result) {
          $("#edit_er_spoc").html(result.html);
        }
   });

   $.ajax({
       url: "{{ url('get-dropdown') }}/" + location +'/hr',
       success: function(result) {
           $("#edit_er_spoc2").html(result.html);
        }
   });


   $.ajax({
        url: "{{ url('get-dropdown') }}/" + location +'/hr',
       success: function(result) {
               $("#edit_er_spoc3").html(result.html);
           }
   });






   });


 $.ajax({
       url: "{{ url('get-department') }}/",
      success: function(result) {
              $("#edit_department").html(result.html);
          }
  });


});


</script>
