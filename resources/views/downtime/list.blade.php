@extends('includes.master')
@section('content')
@section('page-title', 'Downtime')
@section('page-heading', 'Downtime List')
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
\
                    </div>

                </div>
                <!--end::Card toolbar-->
            </div>
            
            <div class="card-body pt-0">
                <!--begin::Table-->
                <div id="kt_customers_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer"><div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer" id="kt_customers_table">
                    <thead>
                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                            <th class="min-w-125px sorting">Sr. No.</th>
                            <th class="min-w-125px sorting">Process</th>
                            <th class="min-w-125px sorting">Sub Process</th>
                            <th class="min-w-125px sorting">Quality ID</th>
                            <th class="min-w-125px sorting">Training ID</th>
                            <th class="min-w-125px sorting">Ops ID</th>
                            <th class="min-w-125px sorting">HR ID</th>
                            <th class="min-w-125px sorting">IT ID</th>
                            <th class="min-w-125px sorting">Reporting To</th>
                            <th class="text-end min-w-70px sorting_disabled">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                     @if(!@empty($lists))
                     @php $i = 1; @endphp
                     @foreach($lists as $list)
                    <tr class="even">

                        <td>{{ $i }}</td>
                        <td>{{ $list->Process }}</td>
                        <td>{{ $list->SubProcess }}</td>
                        <td>{{ $list->QualityID }}</td>
                        <td>{{ $list->TrainingID }}</td>
                        <td>{{ $list->OpsID }}</td>
                        <td>{{ $list->HRID }}</td>
                        <td>{{ $list->ITID }}</td>
                        <td>{{ $list->ReportsTo }}</td>


                        <td class="text-end">
                            <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                            <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                <div class="menu-item px-3">
                                    <a href="{{ __('javaScript::void(0)') }}" id="{{ $list->ID }}"  data-bs-toggle="modal" data-bs-target="#kt_modal_edit_downtime" class="menu-link px-3 edit-downtime">Edit</a>
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



<div class="modal fade" id="kt_modal_edit_downtime" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <form class="form fv-plugins-bootstrap5 fv-plugins-framework" action="{{ url('update-downtime') }}"  method="post" id="kt_modal_downtime_form" data-kt-redirect="">
                @csrf
                   <div class="modal-header" id="kt_modal_edit_downtime_header">
                          <h2 class="fw-bold">Manage Downtime Details</h2>
                   <div  data-bs-dismiss="modal"class="btn btn-icon btn-sm btn-active-icon-primary">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                 </div>
                <div class="modal-body">
                        <div class="row  fv-plugins-icon-container">
                            <div class="col-md-6 col-sm-6 col-lg-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Process</label>
                                <input type="hidden" class="form-control" id="downtime_id" name="downtime_id" value="" >
                                <input type="text" class="form-control " placeholder="" readonly id="process" name="process" value="" >
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Sub Process</label>
                                <input type="text" class="form-control" placeholder=""  readonly id="sub_process" name="sub_process" value="">
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="row fv-plugins-icon-container">
                            <div class="col-md-6 col-sm-6 col-lg-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Quality ID</label>
                                <input type="text" class="form-control" placeholder="" id="quality_id" name="quality_id" value="">
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Training ID</label>
                                <input type="text" class="form-control" placeholder="" id="training_id" name="training_id" value="">
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="row  fv-plugins-icon-container">
                            <div class="col-md-6 col-sm-6 col-lg-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">OPS ID</label>
                                <input type="text" class="form-control" placeholder="" id="ops_id" name="ops_id" value="">
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">HR ID</label>
                                <input type="text" class="form-control" placeholder="" id="hr_id" name="hr_id" value="">
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="row  fv-plugins-icon-container">
                            <div class="col-md-6 col-sm-6 col-lg-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">IT ID</label>
                                <input type="text" class="form-control" placeholder="" id="it_id" name="it_id" value="">

                            </div>

                            <div class="col-md-6 col-sm-6 col-lg-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Reporting To</label>
                                <input type="text" class="form-control" placeholder="" id="reporting_id" name="reporting_id" value="">

                            </div>
                        </div>
                </div>
                <div class="modal-footer flex-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" id="kt_modal_edit_downtime_submit" class="btn btn-primary">
                        <span class="indicator-label">Submit</span>
                        <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
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
        $('#kt_modal_downtime_form').on('submit',function(event){
             event.preventDefault();

            $('.error-message').remove();
             let isValid = true;

             $(this).find('.required').each(function() {
                 const input = $(this).closest('.fv-row').find('.form-control');

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

      $('.edit-downtime').on('click',function(){
        var processId =  $(this).attr('id');
        var url = "{{ url('edit-downtime') }}"+'/'+processId;
        $.get(url,function(response){
                        $('#downtime_id').val(response.row.ID);
                        $('#it_id').val(response.row.ITID);
                        $('#hr_id').val(response.row.HRID);
                        $('#reporting_id').val(response.row.ReportsTo);
                        $('#ops_id').val(response.row.OpsID);
                        $('#training_id').val(response.row.TrainingID);
                        $('#quality_id').val(response.row.QualityID);
                        $('#sub_process').val(response.row.SubProcess);
                        $('#process').val(response.row.Process);
        });


      });

});
</script>
