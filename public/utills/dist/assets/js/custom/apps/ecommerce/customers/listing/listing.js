"use strict";
var KTList=function(){
    var t,e,n
       return{init:function(){(e=document.querySelector("#kt_customers_table"))&&(e.querySelectorAll("tbody tr").forEach((t=>{const e=t.querySelectorAll("td"),o=moment(e[1].innerHTML,"DD MMM YYYY, LT").format();e[1].setAttribute("data-order",o)})),
(t=$(e).DataTable({info:!1,order:[],columnDefs:[{orderable:!1,targets:0},{orderable:!1,targets:1}]})).on("draw",(function(){})),document.querySelector('[data-kt-customer-table-filter="search"]').addEventListener("keyup",(function(e){t.search(e.target.value).draw()})),(()=>{const e=document.querySelector('[data-kt-ecommerce-order-filter="status"]');$(e).on("change",(e=>{let o=e.target.value;"all"===o&&(o=""),t.column(1).search(o).draw()}))})())}}}();KTUtil.onDOMContentLoaded((function(){KTList.init()}));









// o=()=>{e.querySelectorAll('[data-kt-customer-table-filter="delete_row"]').forEach((e=>
//     {e.addEventListener("click",(function(e){e.preventDefault();const o=e.target.closest("tr"),
//     n=o.querySelectorAll("td")[1].innerText;Swal.fire({text:"Are you sure you want to delete "+n+"?",icon:"warning",showCancelButton:!0,buttonsStyling:!1,confirmButtonText:"Yes, delete!",cancelButtonText:"No, cancel",
//     customClass:{confirmButton:"btn fw-bold btn-danger",cancelButton:"btn fw-bold btn-active-light-primary"}}).then((function(e){e.value?Swal.fire({text:"You have deleted "+n+"!.",icon:"success",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn fw-bold btn-primary"}}).then((function(){t.row($(o)).remove().draw()})):"cancel"===e.dismiss&&Swal.fire({text:n+" was not deleted.",icon:"error",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn fw-bold btn-primary"}})}))}))}))}
//     ,n=()=>{const o=e.querySelectorAll('[type="checkbox"]'),n=document.querySelector('[data-kt-customer-table-select="delete_selected"]');o.forEach((t=>{t.addEventListener("click",(function(){setTimeout((function(){c()}),50)}))})),n.addEventListener("click",(function(){Swal.fire({text:"Are you sure you want to delete selected customers?",icon:"warning",showCancelButton:!0,buttonsStyling:!1,confirmButtonText:"Yes, delete!",cancelButtonText:"No, cancel",customClass:{confirmButton:"btn fw-bold btn-danger",cancelButton:"btn fw-bold btn-active-light-primary"}}).then((function(n){n.value?Swal.fire({text:"You have deleted all selected customers!.",icon:"success",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn fw-bold btn-primary"}}).then((function(){o.forEach((e=>{e.checked&&t.row($(e.closest("tbody tr"))).remove().draw()}));e.querySelectorAll('[type="checkbox"]')[0].checked=!1})):"cancel"===n.dismiss&&Swal.fire({text:"Selected customers was not deleted.",icon:"error",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn fw-bold btn-primary"}})}))}))};


