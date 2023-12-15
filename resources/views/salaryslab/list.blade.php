@extends('includes.master')
@section('content')
@section('page-title', 'Salary Slab')
@section('page-heading', 'Salary Slab List')
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
                        <input type="text" data-kt-customer-table-filter="search" class="form-control  w-250px ps-13" placeholder="Search Salary Slab">
                    </div>
                    <!--end::Search-->
                </div>
                <!--begin::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                        <button type="button" class="btn btn-primary add-salary-slab" data-bs-toggle="modal" data-bs-target="#edit-salary-slab">Add</button>
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
                            <th class="min-w-15px sorting"  aria-controls="kt_customers_table"  aria-label="Sr No: activate to sort column ascending" style="width: 17.25px;">Sr. No.</th>
                            <th class="min-w-200px sorting"  aria-controls="kt_customers_table" aria-label="Process: activate to sort column ascending" style="width: 200.20px;">Process</th>
                           <th class="min-w-15px sorting"  aria-controls="kt_customers_table"  aria-label="Minimum Value: activate to sort column ascending" style="width: 17.25px;">Minimum Value</th>
						   <th class="min-w-15px sorting"  aria-controls="kt_customers_table"  aria-label="Maximum Value: activate to sort column ascending" style="width: 17.25px;">Maximum Value</th>
						   <th class="min-w-15px sorting"  aria-controls="kt_customers_table"  aria-label="Average: activate to sort column ascending" style="width: 17.25px;">Average</th>
						   <th  class="min-w-15px sorting"  aria-controls="kt_customers_table"  aria-label="Location: activate to sort column ascending" style="width: 17.25px;">Location</th>
						    <th  class="min-w-15px sorting"  aria-controls="kt_customers_table"  aria-label="Created On: activate to sort column ascending" style="width: 17.25px;">Created On</th>
                           <th class="text-end min-w-10px sorting_disabled"  aria-label="Actions" style="width: 25.906px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                     @if(!@empty($lists))
                     @php $i = 1; @endphp
                     @foreach($lists as $list)
                    <tr class="even">
                            <td>{{ $i }}</td>
                            <td class="cm_id" data="{{ $list->cm_id }}">{{ $list->client_name }}  || {{ $list->process }} || {{ $list->sub_process }}</td>
							<td class="client_training">{{ $list->min_lim }}</td>
							<td class="location">{{ $list->max_lim }}</td>
							<td class="client_time_ttl">{{ $list->avg_sal }}</td>
							<td class="client_time_min">{{ $list->location }}</td>
							<td class="client_time_max">{{ $list->createdon }}</td>
                            <td class="text-end">
                            <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                            <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                <div class="menu-item px-3">
                                    <a href="{{ __('javaScript::void(0)') }}"  onclick="editSalarySlab({{ $list->cm_id }})" id="{{ $list->cm_id }}"  data-bs-toggle="modal" data-bs-target="#edit-salary-slab" class="menu-link px-3 edit-salary-slab">Edit</a>
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



<div class="modal fade" id="edit-salary-slab" tabindex="-1" aria-hidden="true" role="dialog">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <!--begin::Modal content-->
        <div class="modal-content">
            <form class="form fv-plugins-bootstrap5 fv-plugins-framework" action="{{ url('save-salary-slab') }}"  method="post" id="edit-salary-slab_form" data-kt-redirect="">
                @csrf
                   <div class="modal-header" id="kt_modal_edit_downtime_header">
                          <h2 class="fw-bold">Salary Slab Details</h2>
                   <div  data-bs-dismiss="modal"class="btn btn-icon btn-sm btn-active-icon-primary">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                 </div>

                <div class="modal-body">
                        <div class="row fv-plugins-icon-container">
                            <div class="col-md-4 col-sm-4 col-lg-4 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Location</label>
                                <input name="edit_slab_id" id="edit_slab_id" type="hidden">
                                <select  aria-label="Select Location" id="location" name="location" data-control="select2" data-placeholder="Select Location" class="form-select form-select-lg "></select>
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                            </div>

                            <div class="col-md-4 col-sm-4 col-lg-4 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Process</label>
                                <select  aria-label="Select Process" id="process" name="process" data-control="select2" data-placeholder="Select Process" class="form-select  form-select-lg ">
                                    @php $processList = getprocess();  @endphp
                                    @foreach ($processList as $list)
                                     <option value="{{ $list->cm_id }}">{{ $list->client_name }} || {{ $list->process }} || {{ $list->sub_process }}</option>
                                    @endforeach
                                </select>
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-lg-4 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Minimum Salary</label>
                                <input type="number" id="minimum_salary" name="minimum_salary" placeholder="Minimum Salary !" class="form-control">
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="row fv-plugins-icon-container">
                            <div class="col-md-4 col-sm-4 col-lg-4 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Average Salary</label>
                                <input type="number" id="average_salary" name="average_salary" placeholder="Average Salary !" class="form-control">
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                            </div>

                            <div class="col-md-4 col-sm-4 col-lg-4 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Maximum Salary</label>
                                <input type="number" id="maximum_salary" name="maximum_salary" placeholder="Maximum Salary !" class="form-control">
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
        $('#edit-salary-slab_form').on('submit',function(event){
            event.preventDefault();
            $('.error-message').remove();
            let isValid = true;
            $(this).find('.required').each(function() {
                 const input = $(this).closest('.fv-row').find('.form-control, .form-select');
                 if (!input.val()) {
                     isValid = false;
                     const fieldName = $(this).text();
                     input.addClass('is-invalid');
                     const errorMessage = fieldName + ' is required.';
                }
                else{
                    input.removeClass('is-invalid');
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




           $('.add-salary-slab').on('click',function(){
            $('#kt_modal_edit_downtime_submit').show();
            $('#kt_modal_edit_downtime_update').hide();
              $('#edit_slab_id').val('');
               $.get("{{ url('get-location') }}",function(response){
                    $.each(response.lists, function(val, text){
                          $('#location').append(
                            $("<option></option>").val(text.id).html(text.location)
                          );
                    });
                 });
             });



       $('.edit-salary-slab').on('click',function(){

            $('#kt_modal_edit_downtime_submit').hide();
            $('#kt_modal_edit_downtime_update').show();
            var slabid = $(this).attr('id');
            var url = "{{ url('edit-salary-slab') }}"+'/'+slabid;
            $.get("{{ url('get-location') }}",function(response){
                $.each(response.lists, function(val, text){
                      $('#location').append(
                        $("<option></option>").val(text.id).html(text.location)
                      );
                });
            });

            $.get(url,function(response){
                    $('#location').val(response.salaryrow[0].locationid).select2();
                    $('#process').val(response.salaryrow[0].cm_id).select2();
                    $('#average_salary').val(response.salaryrow[0].avg_sal);
                    $('#minimum_salary').val(response.salaryrow[0].max_lim);
                    $('#maximum_salary').val(response.salaryrow[0].max_lim);
                    $('#edit_slab_id').val(response.salaryrow[0].id);
                });
             });

});
</script>

