"use strict";
var KTModalDepartmentUpdate =
function()
{var t,e,o,n,r,i;
    return{
        init:function()
        {
            i=new bootstrap.Modal(document.querySelector("#kt_modal_edit_customer")),
            r=document.querySelector("#kt_modal_edit_customer_form"),
            t=r.querySelector("#kt_modal_edit_customer_submit"),
            e=r.querySelector("#kt_modal_edit_customer_cancel"),
            o=r.querySelector("#kt_modal_edit_customer_close"),
            n= FormValidation.formValidation(r,
                {
                    fields:{
                        name:{
                            validators:{
                                notEmpty:{
                                    message:"Department name is required"
                                }
                            }
                        },

            },
            plugins:{
                trigger:new FormValidation.plugins.Trigger,bootstrap:new FormValidation.plugins.Bootstrap5({rowSelector:".fv-row",eleInvalidClass:"",eleValidClass:""})
            }}),

                t.addEventListener("click",(function(e)
                {
                    e.preventDefault(),n&&n.validate().then((function(e)
                    {
                         if("Valid" == e)
                         {

                              var url = $("#kt_modal_edit_customer_form").attr('action');
                              var form = $("#kt_modal_edit_customer_form").serialize();
                              $.post(url,form,function(response){


                                response.success == true  ? (t.setAttribute("data-kt-indicator","on"),t.disabled=!0,setTimeout((function(){t.removeAttribute("data-kt-indicator"),
                                Swal.fire({text:response.message,icon:"success",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn btn-primary"}}).then((function(e){e.isConfirmed&&(i.hide(),t.disabled=!1,window.location=r.getAttribute("data-kt-redirect"))}))}),2e3)): Swal.fire({text:response.message,icon:"error",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn btn-primary"}})



                              });
                        }

          }))})),e.addEventListener("click",(function(t){t.preventDefault(),Swal.fire({text:"Are you sure you would like to cancel?",icon:"warning",showCancelButton:!0,buttonsStyling:!1,confirmButtonText:"Yes, cancel it!",cancelButtonText:"No, return",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-active-light"}}).then((function(t){t.value?(r.reset(),i.hide()):"cancel"===t.dismiss&&Swal.fire({text:"Your form has not been cancelled!.",icon:"error",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn btn-primary"}})}))})),o.addEventListener("click",(function(t){t.preventDefault(),Swal.fire({text:"Are you sure you would like to cancel?",icon:"warning",showCancelButton:!0,buttonsStyling:!1,confirmButtonText:"Yes, cancel it!",cancelButtonText:"No, return",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-active-light"}}).then((function(t){t.value?(r.reset(),i.hide()):"cancel"===t.dismiss&&Swal.fire({text:"Your form has not been cancelled!.",icon:"error",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn btn-primary"}})}))}))}}}();
          KTUtil.onDOMContentLoaded((function(){KTModalDepartmentUpdate.init()}));


          var KTModalDepartmentEdit =
          function(){
                $('.edit-department').on('click', function(){
                 var editid =  $(this).attr('id');
                 var url = 'edit-department/'+editid;
                 $.get(url,function(response){
                  if(response.success)
                  {
                      $('#edit_department').html(response.html);
                  }

                 });


              });

          }();



 var KTModalDesignationUpdate=
function()
{ var t,e,o,n,r,i;
    return{
        init:function()
        {
            i=new bootstrap.Modal(document.querySelector("#kt_modal_edit_designation")),
            r=document.querySelector("#kt_modal_edit_designation_form"),
            t=r.querySelector("#kt_modal_edit_designation_submit"),
            e=r.querySelector("#kt_modal_edit_designation_cancel"),
            o=r.querySelector("#kt_modal_edit_designation_close"),
            n= FormValidation.formValidation(r,
                {
                    fields:{
                        name:{
                            validators:{
                                notEmpty:{
                                    message:"Designation name is required"
                                }
                            }
                        },

            },
            plugins:{
                trigger:new FormValidation.plugins.Trigger,bootstrap:new FormValidation.plugins.Bootstrap5({rowSelector:".fv-row",eleInvalidClass:"",eleValidClass:""})
            }}),

                t.addEventListener("click",(function(e)
                {
                    e.preventDefault(),n&&n.validate().then((function(e)
                    {
                         if("Valid" == e)
                         {
                              var url = $("#kt_modal_edit_designation_form").attr('action');
                              var form = $("#kt_modal_edit_designation_form").serialize();
                              $.post(url,form,function(response){


                                response.success == true  ? (t.setAttribute("data-kt-indicator","on"),t.disabled=!0,setTimeout((function(){t.removeAttribute("data-kt-indicator"),
                                Swal.fire({text:response.message,icon:"success",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn btn-primary"}}).then((function(e){e.isConfirmed&&(i.hide(),t.disabled=!1,window.location=r.getAttribute("data-kt-redirect"))}))}),2e3)):Swal.fire({text:response.message,icon:"error",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn btn-primary"}})



                              });
                        }

          }))})),e.addEventListener("click",(function(t){t.preventDefault(),Swal.fire({text:"Are you sure you would like to cancel?",icon:"warning",showCancelButton:!0,buttonsStyling:!1,confirmButtonText:"Yes, cancel it!",cancelButtonText:"No, return",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-active-light"}}).then((function(t){t.value?(r.reset(),i.hide()):"cancel"===t.dismiss&&Swal.fire({text:"Your form has not been cancelled!.",icon:"error",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn btn-primary"}})}))})),o.addEventListener("click",(function(t){t.preventDefault(),Swal.fire({text:"Are you sure you would like to cancel?",icon:"warning",showCancelButton:!0,buttonsStyling:!1,confirmButtonText:"Yes, cancel it!",cancelButtonText:"No, return",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-active-light"}}).then((function(t){t.value?(r.reset(),i.hide()):"cancel"===t.dismiss&&Swal.fire({text:"Your form has not been cancelled!.",icon:"error",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn btn-primary"}})}))}))}}}();
          KTUtil.onDOMContentLoaded((function(){KTModalDesignationUpdate.init()}));

          var KTModalDesignationEdit =
          function(){
                $('.edit-designation').on('click', function(){
                 var editid =  $(this).attr('id');
                 var url = 'edit-designation/'+editid;
                 $.get(url,function(response){
                  if(response.success)
                  {
                      $('#edit_designation').html(response.html);
                  }
               });

            });

          }();


          var KTModalProcessUpdate =
          function()
          { var t,e,o,n,r,i;
              return{
                  init:function()
                    {
                      i=new bootstrap.Modal(document.querySelector("#kt_modal_edit_process")),
                      r=document.querySelector("#kt_modal_edit_process_form"),
                      t=r.querySelector("#kt_modal_edit_process_submit"),
                      e=r.querySelector("#kt_modal_edit_process_cancel"),
                      o=r.querySelector("#kt_modal_edit_process_close"),
                      n= FormValidation.formValidation(r,
                          {
                              fields:{
                                client:{
                                      validators:{
                                          notEmpty:{
                                              message:"Client name is required Please Select"
                                          }
                                      }
                                  },

                                  status:{
                                    validators:{
                                        notEmpty:{
                                            message:"Status is required Please Select"
                                        }
                                    }
                                },
                                },

                    plugins:{
                          trigger:new FormValidation.plugins.Trigger,bootstrap:new FormValidation.plugins.Bootstrap5({rowSelector:".fv-row",eleInvalidClass:"",eleValidClass:""})
                      }}),

                          t.addEventListener("click",(function(e)
                          {
                              e.preventDefault(),n&&n.validate().then((function(e)
                              {
                                   if("Valid" == e)
                                   {
                                        var url = $("#kt_modal_edit_process_form").attr('action');
                                        var form = $("#kt_modal_edit_process_form").serialize();
                                        $.post(url,form,function(response){
                                          response.success == true  ? (t.setAttribute("data-kt-indicator","on"),t.disabled=!0,setTimeout((function(){t.removeAttribute("data-kt-indicator"),
                                          Swal.fire({text:response.message,icon:"success",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn btn-primary"}}).then((function(e){e.isConfirmed&&(i.hide(),t.disabled=!1,window.location=r.getAttribute("data-kt-redirect"))}))}),2e3)):Swal.fire({text:response.message,icon:"error",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn btn-primary"}})
                                         });
                                   }

                    }))})),e.addEventListener("click",(function(t){t.preventDefault(),Swal.fire({text:"Are you sure you would like to cancel?",icon:"warning",showCancelButton:!0,buttonsStyling:!1,confirmButtonText:"Yes, cancel it!",cancelButtonText:"No, return",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-active-light"}}).then((function(t){t.value?(window.reload(), r.reset(),i.hide()):"cancel"===t.dismiss&&Swal.fire({text:"Your form has not been cancelled!.",icon:"error",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn btn-primary"}})}))})),o.addEventListener("click",(function(t){t.preventDefault(),Swal.fire({text:"Are you sure you would like to cancel?",icon:"warning",showCancelButton:!0,buttonsStyling:!1,confirmButtonText:"Yes, cancel it!",cancelButtonText:"No, return",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-active-light"}}).then((function(t){t.value?(r.reset(),i.hide(),window.reload()):"cancel"===t.dismiss&&Swal.fire({text:"Your form has not been cancelled!.",icon:"error",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn btn-primary"}})}))}))}}}();
                    KTUtil.onDOMContentLoaded((function(){KTModalProcessUpdate.init()}));

     var KTModalProcessEdit =
    function(){
          $('.edit-process').on('click', function(){
           var editid =  $(this).attr('id');
           var url = 'edit-process/'+editid;
           $.get(url,function(response){
            if(response.success)
            {
                $('#edit_process').html(response.html);
            }
         });

      });

    }();







