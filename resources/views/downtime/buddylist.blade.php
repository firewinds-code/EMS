@extends('includes.master')
@section('content')
@section('page-title', 'Buddy Downtime')
@section('page-heading', 'Buddy Downtime List')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl">
        <!--begin::Card-->
        <div class="card">
            <!--begin::Card header-->
            <div class="card-header border-0 pt-6">
                <!--begin::Card title-->
                <div class="card-title">
                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <input type="text" data-kt-customer-table-filter="search" class="form-control  w-250px ps-13" placeholder="Search Process">
                    </div>
                    <!--end::Search-->
                </div>
                <!--begin::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">

                        <!--begin::Add customer-->
                        <button type="button" class="btn btn-primary add-buddy-downtime" data-bs-toggle="modal" data-bs-target="#kt_buddy_edit_downtime">Add</button>
                        <!--end::Add customer-->
                    </div>

                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Table-->
                <div id="kt_customers_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer"><div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer" id="kt_customers_table">
                    <thead>
                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                            <th class="min-w-15px sorting">Sr. No.</th>
                            <th class="min-w-200px sorting">Process</th>
                            <th class="min-w-25px sorting">Min Time</th>
                            <th class="min-w-25px sorting">Max Time</th>
                           <th class="text-end min-w-10px sorting_disabled">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                     @if(!@empty($buddyList))
                     @php $i = 1; @endphp
                     @foreach($buddyList as $list)
                    <tr class="even">
                        <td>{{ $i }}</td>
                        <td>{{ $list->client_name }} | {{ $list->process }} | {{ $list->sub_process }} </td>
                        <td>{{ $list->Min_Time }}</td>
                        <td>{{ $list->Max_Time }}</td>
                        <td class="text-end">
                            <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                            <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                <div class="menu-item px-3">
                                    <a href="{{ __('javaScript::void(0)') }}" id="{{ $list->ID }}"  data-bs-toggle="modal" data-bs-target="#kt_buddy_edit_downtime" class="menu-link px-3 edit-buddy-downtime">Edit</a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="{{ __('javaScript::void(0)') }}" id="{{ $list->ID }}" class="menu-link px-3 delete-buddy-downtime">Delete</a>
                                </div>
                             </div>

                        </td>
                    </tr>
                     @php $i++; @endphp
                    @endforeach
                    @endif
                    </tbody>
                <!--end::Table body-->
                </table>

                <!--end::Table-->
            </div>
            <!--end::Card body-->
        </div>
</div>
    <!--end::Content container-->
</div>



<div class="modal fade" id="kt_buddy_edit_downtime" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <form class="form fv-plugins-bootstrap5 fv-plugins-framework" action="{{ url('save-buddy-downtime') }}"  method="post" id="kt_modal_downtime_form" data-kt-redirect="">
                @csrf
                   <div class="modal-header" id="kt_modal_edit_downtime_header">
                          <h2 class="fw-bold">Manage Buddy Downtime Details</h2>
                   <div  data-bs-dismiss="modal"class="btn btn-icon btn-sm btn-active-icon-primary">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                 </div>
                <div class="modal-body">
                        <div class="row  fv-plugins-icon-container">
                            <div class="col-md-12 col-sm-12 col-lg-12 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Process</label>
                                <select  aria-label="Select DownTime Time" id="buddyprocess" name="buddyprocess" data-control="select2" data-placeholder="Select DownTime Process" class="form-select form-select-solid form-select-lg fw-semibold">

                                </select>
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                <input type="hidden" name="buddy_id" id="buddy_id">
                            </div>
                        </div>

                        <div class="row fv-plugins-icon-container">
                            <div class="col-md-6 col-sm-6 col-lg-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Min Time</label>
                                <select  aria-label="Select DownTime Time" id="min_time" name="min_time" data-control="select2" data-placeholder="Select DownTime Min Time" class="form-select form-select-lg ">
                                    <option value="">Please Select Min Time</option>
                                    <option value="00:00:00">00:00:00</option>
                                    <option value="00:30:00">00:30:00</option>
                                    <option value="01:00:00">01:00:00</option>
                                    <option value="01:30:00">01:30:00</option>
                                    <option value="02:00:00">02:00:00</option>
                                    <option value="02:30:00">02:30:00</option>
                                    <option value="03:00:00">03:00:00</option>
                                    <option value="03:30:00">03:30:00</option>
                                    <option value="04:00:00">04:00:00</option>
                                    <option value="04:30:00">04:30:00</option>
                                    <option value="05:00:00">05:00:00</option>
                                    <option value="05:30:00">05:30:00</option>
                                    <option value="06:00:00">06:00:00</option>
                                    <option value="06:30:00">06:30:00</option>
                                    <option value="07:00:00">07:00:00</option>
                                    <option value="07:30:00">07:30:00</option>
                                    <option value="08:00:00">08:00:00</option>
                                </select>
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Max Time</label>
                                <select  aria-label="Select DownTime Time" id="max_time" name="max_time" data-control="select2" data-placeholder="Select DownTime Max Time" class="form-select  form-select-lg ">
                                    <option value="">Please Select Max Time</option>
                                    <option value="00:00:00">00:00:00</option>
                                    <option value="00:30:00">00:30:00</option>
                                    <option value="01:00:00">01:00:00</option>
                                    <option value="01:30:00">01:30:00</option>
                                    <option value="02:00:00">02:00:00</option>
                                    <option value="02:30:00">02:30:00</option>
                                    <option value="03:00:00">03:00:00</option>
                                    <option value="03:30:00">03:30:00</option>
                                    <option value="04:00:00">04:00:00</option>
                                    <option value="04:30:00">04:30:00</option>
                                    <option value="05:00:00">05:00:00</option>
                                    <option value="05:30:00">05:30:00</option>
                                    <option value="06:00:00">06:00:00</option>
                                    <option value="06:30:00">06:30:00</option>
                                    <option value="07:00:00">07:00:00</option>
                                    <option value="07:30:00">07:30:00</option>
                                    <option value="08:00:00">08:00:00</option>
                                </select>
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                            </div>
                        </div>



                </div>
                <div class="modal-footer flex-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" id="kt_modal_edit_downtime_update" class="btn btn-primary">
                        <span class="indicator-label">Update</span>
                    </button>
                    <button type="submit" id="kt_modal_edit_downtime_submit" class="btn btn-primary">
                        <span class="indicator-label">Save</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@include('includes.commonjs')
<script>
    $(function(){
        $('#kt_modal_edit_downtime_update').hide();
        $('#kt_modal_downtime_form').on('submit',function(event){
             event.preventDefault();

            $('.error-message').remove();
             let isValid = true;

             $(this).find('.required').each(function() {
                 const input = $(this).closest('.fv-row').find('.form-select');

                 if (!input.val()) {
                     isValid = false;
                     const fieldName = $(this).text();
                     input.addClass('is-invalid');
                     const errorMessage = fieldName + ' is required.';
                }
             });

             if (isValid === true) {
                var url = $(this).attr('action');
                var form = $(this).serialize();
                $.post(url,form,function(response){
                    if(response.success)
                    {
                        toastr.success(response.message, "Success", {
                            toastClass: "toast-success",
                            progressBar: true
                         });
                         setTimeout(function() { window.location=window.location; },3000);

                    }
                    if(response.error)
                    {
                        toastr.error(response.message, "Error", {
                            toastClass: "toast-error",
                            progressBar: true
                         });
                         setTimeout(function() { window.location=window.location; },3000);
                    }

                });
             }else{
                return false;
             }

           });




           $('.add-buddy-downtime').on('click',function(){
            $('#kt_modal_edit_downtime_submit').show();
            $('#kt_modal_edit_downtime_update').hide();
              var buddyId = $('#buddy_id').val('');
              var url = "{{ url('buddy-downtime-process') }}"+'/'+buddyId;
            $.get(url,function(response){
                    $.each(response.processList,function(val, text){
                    $('#buddyprocess').append($('<option></option>').val(text.cm_id).html(text.client_name +'|'+ text.process +'|'+ text.sub_process));
                    });
                });
             });



        $('.edit-buddy-downtime').on('click',function(){
            $('#kt_modal_edit_downtime_submit').hide();
            $('#kt_modal_edit_downtime_update').show();
            var buddyId = $(this).attr('id');
            $('#buddy_id').val(buddyId);
            var url = "{{ url('buddy-downtime-process') }}"+'/'+buddyId;
            $.get(url,function(response){
                $.each(response.processList,function(val, text){
                $('#buddyprocess').append($('<option></option>').val(text.cm_id).html(text.client_name +'|'+ text.process +'|'+ text.sub_process));
                    });

                    $('#buddyprocess').val(response.editRow.cm_id).select2();
                    $('#max_time').val(response.editRow.Max_Time).select2();
                    $('#min_time').val(response.editRow.Min_Time).select2();
                });
            });


            $('.delete-buddy-downtime').on('click',function(events){
                var buddyId = $(this).attr('id');
                var url = "{{ url('delete-buddy-downtime') }}"+'/'+buddyId;

                if(confirm('Are you sure want to deleted !'))
                {
                    $.get(url,function(response){
                        if(response.success)
                        {  toastr.success(response.message, "Success", {
                                toastClass: "toast-success",
                                progressBar: true
                             });
                             setTimeout(function() { window.location=window.location; },3000);
                        }
                        if(response.error)
                        { toastr.error(response.message, "Error", {
                                toastClass: "toast-error",
                                progressBar: true
                             });
                             setTimeout(function() { window.location=window.location; },3000);
                        }
                     });
                }

            });







});
</script>
