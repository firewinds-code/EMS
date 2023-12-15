@extends('includes.master')
@section('content')
@section('page-title', 'Education Board')
@section('page-heading', 'Education Board List')
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
                        <input type="text" data-kt-customer-table-filter="search" class="form-control  w-250px ps-13" placeholder="Search board">
                    </div>
                    <!--end::Search-->
                </div>
                <!--begin::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">

                        <!--begin::Add customer-->
                        <button type="button" class="btn btn-primary add-board" data-bs-toggle="modal" data-bs-target="#kt_modal_add_board">Add Board</button>
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
                            <th class="min-w-12px sorting">Sr. No.</th>
                            <th class="min-w-125px sorting">Board</th>
                            <th class="text-end min-w-70px sorting_disabled">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                     @if(!@empty($lists))
                     @php $i = 1; @endphp
                     @foreach($lists as $list)
                    <tr class="even">
                        <td>{{ $i }}</td>
                        <td>{{ $list->board }}</td>
                        <td class="text-end">
                            <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                            <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                <div class="menu-item px-3">
                                    <a href="{{ __('javaScript::void(0)') }}" id="{{ $list->id }}"  data-bs-toggle="modal" data-bs-target="#kt_modal_add_board" class="menu-link px-3 edit-board">Edit</a>
                                </div>
                             </div>

                        </td>
                    </tr>
                     @php $i++; @endphp
                    @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="kt_modal_add_board" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <form class="form fv-plugins-bootstrap5 fv-plugins-framework" action="{{ url('save-board') }}"  method="post" id="kt_modal_board_form">
                @csrf
                   <div class="modal-header" id="kt_modal_add_board_header">
                          <h2 class="fw-bold">Education Board Details</h2>
                   <div  data-bs-dismiss="modal"class="btn btn-icon btn-sm btn-active-icon-primary">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                 </div>
                <div class="modal-body">
                        <div class="row fv-plugins-icon-container">
                            <div class="col-md-12 col-sm-12 col-lg-12 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Education Board</label>
                                <input type="hidden" class="" id="board_id" name="board_id" value="" >
                                <input type="text" class="form-control" placeholder="enter education board"  id="education_board" name="education_board" value="" >
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer flex-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" id="kt_modal_add_board_submit" class="btn btn-primary">
                        <span class="indicator-label">Save</span>
                    </button>
                    <button type="submit" id="kt_modal_add_board_update" class="btn btn-primary">
                        <span class="indicator-label">Update</span>
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

        $('#kt_modal_add_board_update').hide();


        $('#kt_modal_board_form').on('submit',function(event){
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

      $('.edit-board').on('click',function(){
        $('#kt_modal_add_board_submit').hide();
        $('#kt_modal_add_board_update').show();
        var boardId =  $(this).attr('id');
        $('#board_id').val(boardId);
        var url = "{{ url('edit-board') }}"+'/'+boardId;
        $.get(url,function(response){
                $('#education_board').val(response.row.board);
             });
        });

      $('.add-board').on('click',function(){
        $('#board_id').val('');
      });




});
</script>
