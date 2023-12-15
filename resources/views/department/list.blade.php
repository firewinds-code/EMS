@extends('includes.master')
@section('content')
@section('page-title', 'Department')
@section('page-heading', 'Department List')
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
                        <input type="text" data-kt-customer-table-filter="search"
                            class="form-control form-control-solid w-250px ps-13" placeholder="Search Department">
                    </div>
                    <!--end::Search-->
                </div>
                <!--begin::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">

                        <!--begin::Add customer-->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#kt_modal_add_customer">Add Department</button>
                        <!--end::Add customer-->
                    </div>

                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Table-->
                <div id="kt_customers_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer"
                            id="kt_customers_table">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-125px sorting">Department ID</th>
                                    <th class="min-w-125px sorting">Department Name</th>
                                    <th class="text-end min-w-70px sorting_disabled" >Actions</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                @if (!@empty($departments))
                                    @foreach ($departments as $department)
                                        <tr class="even">


                                            <td>{{ $department->dept_id }}</td>
                                            <td>{{ $department->dept_name }}</td>
                                            <td class="text-end">
                                                <a href="#"
                                                    class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                    data-kt-menu-trigger="click"
                                                    data-kt-menu-placement="bottom-end">Actions
                                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                                <!--begin::Menu-->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                    data-kt-menu="true">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="{{ __('javaScript::void(0)') }}"
                                                            id="{{ $department->dept_id }}" data-bs-toggle="modal"
                                                            data-bs-target="#kt_modal_edit_customer"
                                                            class="menu-link px-3 edit-department">Edit</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="{{ __('javaScript::void(0)') }}"
                                                            onclick="deleteDepartment({{ $department->dept_id }})"
                                                            class="menu-link px-3"
                                                            data-kt-customer-table-filter="delete_row">Delete</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu-->
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                            <!--end::Table body-->
                        </table>

                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>

                <div class="modal fade" id="kt_modal_add_customer" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">

                            <form class="form fv-plugins-bootstrap5 fv-plugins-framework"
                                action="{{ url('save-department') }}" method="post" id="kt_modal_add_customer_form"
                                data-kt-redirect="">
                                @csrf
                                <div class="modal-header" id="kt_modal_add_customer_header">
                                    <h2 class="fw-bold">Add a Department</h2>
                                    <div id="kt_modal_add_customer_close"
                                        class="btn btn-icon btn-sm btn-active-icon-primary">
                                        <i class="ki-duotone ki-cross fs-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </div>

                                </div>
                                <div class="modal-body py-10 px-lg-17">

                                    <div class="scroll-y me-n7 pe-7" id="kt_modal_add_customer_scroll"
                                        data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                                        data-kt-scroll-max-height="auto"
                                        data-kt-scroll-dependencies="#kt_modal_add_customer_header"
                                        data-kt-scroll-wrappers="#kt_modal_add_customer_scroll"
                                        data-kt-scroll-offset="300px" style="">

                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-semibold mb-2">Name</label>
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                name="name" value="">
                                            <div
                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                            </div>
                                        </div>



                                    </div>

                                </div>

                                <div class="modal-footer flex-center">

                                    <button type="reset" id="kt_modal_add_customer_cancel"
                                        class="btn btn-light me-3">Cancel</button>

                                    <button type="submit" id="kt_modal_add_customer_submit" class="btn btn-primary">
                                        <span class="indicator-label">Submit</span>
                                        <span class="indicator-progress">Please wait...
                                            <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>

                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!--end::Content container-->
        </div>





        <div class="modal fade" id="kt_modal_edit_customer" tabindex="-1" aria-hidden="true">
            <!--begin::Modal dialog-->
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <!--begin::Modal content-->
                <div class="modal-content">

                    <form class="form fv-plugins-bootstrap5 fv-plugins-framework"
                        action="{{ url('update-department') }}" method="post" id="kt_modal_edit_customer_form"
                        data-kt-redirect="">
                        @csrf
                        <div class="modal-header" id="kt_modal_edit_customer_header">
                            <h2 class="fw-bold">Edit a Department</h2>
                            <div id="kt_modal_edit_customer_close"
                                class="btn btn-icon btn-sm btn-active-icon-primary">
                                <i class="ki-duotone ki-cross fs-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </div>

                        </div>
                        <div class="modal-body py-10 px-lg-17">

                            <div class="scroll-y me-n7 pe-7" id="kt_modal_edit_customer_scroll" data-kt-scroll="true"
                                data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                                data-kt-scroll-dependencies="#kt_modal_edit_customer_header"
                                data-kt-scroll-wrappers="#kt_modal_edit_customer_scroll" data-kt-scroll-offset="300px"
                                style="">

                                <div class="fv-row mb-7 fv-plugins-icon-container" id="edit_department">
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>



                                </div>



                            </div>

                        </div>

                        <div class="modal-footer flex-center">

                            <button type="reset" id="kt_modal_edit_customer_cancel"
                                class="btn btn-light me-3">Cancel</button>

                            <button type="submit" id="kt_modal_edit_customer_submit" class="btn btn-primary">
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

    <script>
        function deleteDepartment(department_id) {
            if (confirm("Are You Sure Want To Delete Department")) {
                $.get('delete-department/' + department_id, function(response) {
                    if (response.success) {
                        Swal.fire({
                            text: response.message,
                            icon: "success",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then((function() {
                            location.reload();
                        }));
                    }

                });
            }
        }
    </script>
