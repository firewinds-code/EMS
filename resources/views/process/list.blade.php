@extends('includes.master')
@section('content')
@section('page-title', 'Process')
@section('page-heading', 'Process List')
<div id="kt_app_content" class="app-content flex-column-fluid">
   <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <input type="text" data-kt-customer-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search Client">
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">

                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <div id="kt_customers_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer"><div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer" id="kt_customers_table">
                    <thead>
                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                            <th class="min-w-125px sorting">Client ID</th>
                            <th class="min-w-125px sorting">Client Name</th>
                            <th class="min-w-125px sorting">Process</th>
                            <th class="min-w-125px sorting">Sub Process</th>
                            <th class="min-w-125px sorting">Locations</th>
                            <th class="min-w-125px sorting">Status</th>
                            <th class="text-end min-w-70px sorting_disabled">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                     @if(!@empty($process))
                     @foreach($process as $list)
                    <tr class="even">
                        <td>{{ $list->client_id }}</td>
						<td>{{ $list->client_name }}</td>
                        <td class="location">{{ $list->location }}</td>
                        <td class="process">{{ $list->process }}</td>
						<td class="sub_process">{{ $list->sub_process }}</td>
                        <td>
                            @if(empty($list->id))
                            <div class="badge badge-light-success">Active</div>
                            @else
                            <div class="badge badge-light-danger">In-Active</div>
                            @endif
                        </td>

                        <td class="text-end">
                            <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                            <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                <div class="menu-item px-3">
                                    <a href="{{ __('javaScript::void(0)') }}" id="{{ $list->cm_id }}"  data-bs-toggle="modal" data-bs-target="#kt_modal_edit_process" class="menu-link px-3 edit-process">Edit</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--end::Content container-->
</div>

<div class="modal fade" id="kt_modal_edit_process"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">


            <form class="form fv-plugins-bootstrap5 fv-plugins-framework" action="{{ url('update-client-process') }}"  method="post" id="kt_modal_edit_process_form" data-kt-redirect="">
                @csrf
                   <div class="modal-header" id="kt_modal_edit_process_header">
                          <h2 class="fw-bold">Edit a Client Process</h2>
                   <div id="kt_modal_edit_process_close" class="btn btn-icon btn-sm btn-active-icon-primary">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                </div>
                <div id="edit_process"></div>

                <!--end::Col-->

                <div class="modal-footer flex-center">
                    <button type="reset" id="kt_modal_edit_process_cancel" class="btn btn-light me-3">Cancel</button>
                    <button type="submit" id="kt_modal_edit_process_submit" class="btn btn-primary">
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

