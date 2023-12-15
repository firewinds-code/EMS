"use strict";
var KTModalCustomersAdd =
function()
{var t,e,o,n,r,i;
    return{
        init:function()
        {
            i=new bootstrap.Modal(document.querySelector("#kt_modal_add_customer")),
            r=document.querySelector("#kt_modal_add_customer_form"),
            t=r.querySelector("#kt_modal_add_customer_submit"),
            e=r.querySelector("#kt_modal_add_customer_cancel"),
            o=r.querySelector("#kt_modal_add_customer_close"),
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
                              var url = $("#kt_modal_add_customer_form").attr('action');
                              var form = $("#kt_modal_add_customer_form").serialize();
                              $.post(url,form,function(response){


                                response.success == true  ? (t.setAttribute("data-kt-indicator","on"),t.disabled=!0,setTimeout((function(){t.removeAttribute("data-kt-indicator"),
                                Swal.fire({text:response.message,icon:"success",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn btn-primary"}}).then((function(e){e.isConfirmed&&(i.hide(),t.disabled=!1,window.location=r.getAttribute("data-kt-redirect"))}))}),2e3)):Swal.fire({text:response.message,icon:"error",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn btn-primary"}})



                              });
                        }

          }))})),e.addEventListener("click",(function(t){t.preventDefault(),Swal.fire({text:"Are you sure you would like to cancel?",icon:"warning",showCancelButton:!0,buttonsStyling:!1,confirmButtonText:"Yes, cancel it!",cancelButtonText:"No, return",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-active-light"}}).then((function(t){t.value?(r.reset(),i.hide()):"cancel"===t.dismiss&&Swal.fire({text:"Your form has not been cancelled!.",icon:"error",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn btn-primary"}})}))})),o.addEventListener("click",(function(t){t.preventDefault(),Swal.fire({text:"Are you sure you would like to cancel?",icon:"warning",showCancelButton:!0,buttonsStyling:!1,confirmButtonText:"Yes, cancel it!",cancelButtonText:"No, return",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-active-light"}}).then((function(t){t.value?(r.reset(),i.hide()):"cancel"===t.dismiss&&Swal.fire({text:"Your form has not been cancelled!.",icon:"error",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn btn-primary"}})}))}))}}}();
          KTUtil.onDOMContentLoaded((function(){KTModalCustomersAdd.init()}));






var KTModalDesignationAdd =
function()
{var t,e,o,n,r,i;
    return{
        init:function()
        {
            i=new bootstrap.Modal(document.querySelector("#kt_modal_add_designation")),
            r=document.querySelector("#kt_modal_add_designation_form"),
            t=r.querySelector("#kt_modal_add_designation_submit"),
            e=r.querySelector("#kt_modal_add_designation_cancel"),
            o=r.querySelector("#kt_modal_add_designation_close"),
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
                              var url = $("#kt_modal_add_designation_form").attr('action');
                              var form = $("#kt_modal_add_designation_form").serialize();
                              $.post(url,form,function(response){


                                response.success == true  ? (t.setAttribute("data-kt-indicator","on"),t.disabled=!0,setTimeout((function(){t.removeAttribute("data-kt-indicator"),
                                Swal.fire({text:response.message,icon:"success",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn btn-primary"}}).then((function(e){e.isConfirmed&&(i.hide(),t.disabled=!1,window.location=r.getAttribute("data-kt-redirect"))}))}),2e3)):Swal.fire({text:response.message,icon:"error",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn btn-primary"}})



                              });
                        }

          }))})),e.addEventListener("click",(function(t){t.preventDefault(),Swal.fire({text:"Are you sure you would like to cancel?",icon:"warning",showCancelButton:!0,buttonsStyling:!1,confirmButtonText:"Yes, cancel it!",cancelButtonText:"No, return",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-active-light"}}).then((function(t){t.value?(r.reset(),i.hide()):"cancel"===t.dismiss&&Swal.fire({text:"Your form has not been cancelled!.",icon:"error",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn btn-primary"}})}))})),o.addEventListener("click",(function(t){t.preventDefault(),Swal.fire({text:"Are you sure you would like to cancel?",icon:"warning",showCancelButton:!0,buttonsStyling:!1,confirmButtonText:"Yes, cancel it!",cancelButtonText:"No, return",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-active-light"}}).then((function(t){t.value?(r.reset(),i.hide()):"cancel"===t.dismiss&&Swal.fire({text:"Your form has not been cancelled!.",icon:"error",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn btn-primary"}})}))}))}}}();
          KTUtil.onDOMContentLoaded((function(){KTModalDesignationAdd.init()}));











