@extends('includes.master')
@section('content')
@section('page-title', 'Client')
@section('page-heading', 'Client List')
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
                            class="form-control form-control-solid w-250px ps-13" placeholder="Search Client">
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
                            data-bs-target="#kt_modal_2">Add Client</button>
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
                                    <th class="text-start min-w-70px sorting_disabled">Actions</th>
                                    <th class="min-w-125px sorting">Client ID</th>
                                    <th class="min-w-125px sorting">Client Name</th>
                                    <th class="min-w-125px sorting">A/C Head</th>
                                    <th class="min-w-125px sorting">Department Name</th>
                                    <th class="min-w-125px sorting">Process</th>
                                    <th class="min-w-125px sorting">OH Name</th>
                                    <th class="min-w-125px sorting">QH Name</th>
                                    <th class="min-w-125px sorting">TH Name</th>
                                    <th class="min-w-125px sorting">Sub Process</th>
                                    <th class="min-w-125px sorting">Locations</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                @if (!@empty($clients))
                                    @foreach ($clients as $client)
                                        <tr class="even">
                                            <td class="text-end">
                                                <a href="#"
                                                    class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                    data-kt-menu-trigger="click"
                                                    data-kt-menu-placement="bottom-end">Actions
                                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                                <!--begin::Menu-->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                    data-kt-menu="true">
                                                    <div class="menu-item px-3">
                                                        <a href="{{ __('javaScript::void(0)') }}"
                                                            id="Manage{{ $client->cm_id }}" data-bs-toggle="modal"
                                                            data-bs-target="#kt_modal_edit"
                                                            class="menu-link px-3 manage-client"><i
                                                                class="bi bi-pencil"></i>Manage Clients</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="cm_id">{{ $client->cm_id }}</td>
                                            <td class="$client_name">{{ $client->cli }}</td>
                                            <td class="EmployeeName">{{ $client->ach }}</td>
                                            <td class="dept_name">{{ $client->dept_name }}</td>
                                            <td class="process">{{ $client->process }}</td>
                                            <td class="ohn">{{ $client->ohn }}</td>
                                            <td class="qhn">{{ $client->qhn }}</td>
                                            <td class="thn">{{ $client->thn }}</td>
                                            <td class="sub_process">{{ $client->sub_process }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="kt_modal_2">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content shadow-none">
            <div class="modal-header">
                <h5 class="modal-title">Manage Client Master Details</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>
            <div class="modal-body">
                <div class="row g-5 g-xl-10 mb-xl-10">
                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-6 mb-md-5 mb-xl-10">
                        <div class="card card-flush cardOutline">
                            <div class="card-body">
                                <form action="{{ url('saveNewClient') }}" class="form mb-15" method="post"
                                    id="kt_contact_form">
                                    @csrf
                                    <div class="row mb-5">
                                        <div class="col-md-4 fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-semibold mb-2">Location</label>
                                            <select aria-label="Select a Location" id="location" name="location"
                                                data-control="select2" data-placeholder="Select a Location..."
                                                class="form-select form-select-solid form-select-lg fw-semibold">
                                                @php  $location = getlocation(); @endphp
                                                <option value="">Please Select Location</option>
                                                @foreach ($location as $list)
                                                    <option value="{{ $list->id }}">{{ $list->location }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 fv-row">
                                            <label class="fs-5 fw-semibold mb-2">Client Name</label>
                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="Enter Client Name" name="clients" />
                                        </div>
                                        <div class="col-md-4 fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-semibold mb-2">Account Head</label>
                                            <select aria-label="Select Account Head" id="account_head"
                                                name="account_head" data-control="select2"
                                                data-placeholder="Select Account Head"
                                                class="form-select form-select-solid form-select-lg fw-semibold">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-md-4 fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-semibold mb-2">Vertical Head</label>
                                            <select aria-label="Select a Vertical Head" id="vertical_head"
                                                name="vertical_head" data-control="select2"
                                                data-placeholder="Select a Vertical Head..."
                                                class="form-select form-select-solid form-select-lg fw-semibold">
                                            </select>
                                        </div>
                                        <div class="col-md-4 fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-semibold mb-2">Department</label>
                                            <select aria-label="Select Department" id="department" name="department"
                                                data-control="select2" data-placeholder="Select Department"
                                                class="form-select form-select-solid form-select-lg fw-semibold">
                                            </select>
                                        </div>
                                        <div class="col-md-4 fv-row">
                                            <label class="required fs-5 fw-semibold mb-2">Process Name</label>
                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="Enter Process Name" name="process_name" />
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-4 fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-semibold mb-2">Operation Head</label>
                                            <select aria-label="Select a Operation Head" id="operation_head"
                                                name="operation_head" data-control="select2"
                                                data-placeholder="Select a Operation Head..."
                                                class="form-select form-select-solid form-select-lg fw-semibold">
                                            </select>
                                        </div>
                                        <div class="col-md-4 fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-semibold mb-2">Quality Head</label>
                                            <select aria-label="Select Quality Head" id="quality_head"
                                                name="quality_head" data-control="select2"
                                                data-placeholder="Select Quality Head"
                                                class="form-select form-select-solid form-select-lg fw-semibold">
                                            </select>
                                        </div>
                                        <div class="col-md-4 fv-row">
                                            <label class="required fs-5 fw-semibold mb-2">Training Head</label>
                                            <select aria-label="Select Training Head" id="training_head"
                                                name="training_head" data-control="select2"
                                                data-placeholder="Select Training Head"
                                                class="form-select form-select-solid form-select-lg fw-semibold">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-md-4 fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-semibold mb-2">ER SPOC</label>
                                            <select aria-label="Select a ER SPOC" id="er_spoc" name="er_spoc"
                                                data-control="select2" data-placeholder="Select a ER SPOC..."
                                                class="form-select form-select-solid form-select-lg fw-semibold">
                                            </select>
                                        </div>
                                        <div class="col-md-4 fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-semibold mb-2">ER SPOC 2</label>
                                            <select aria-label="Select ER SPOC 2" id="er_spoc2" name="er_spoc2"
                                                data-control="select2" data-placeholder="Select ER SPOC 2"
                                                class="form-select form-select-solid form-select-lg fw-semibold">
                                            </select>
                                        </div>
                                        <div class="col-md-4 fv-row">
                                            <label class="required fs-5 fw-semibold mb-2">ER SPOC 3</label>
                                            <select aria-label="Select ER SPOC 3" id="er_spoc3" name="er_spoc3"
                                                data-control="select2" data-placeholder="Select ER SPOC 3"
                                                class="form-select form-select-solid form-select-lg fw-semibold">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-md-4 fv-row">
                                            <label class="required fs-5 fw-semibold mb-2">Sub Process Name</label>
                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="Enter Sub Process Name" name="sub_process_name" />
                                        </div>
                                        <div class="col-md-4 fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-semibold mb-2">DownTime Quality</label>
                                            <select aria-label="Select a DownTime Quality" id="downtime_quality"
                                                name="downtime_quality" data-control="select2"
                                                data-placeholder="Select a DownTime Quality..."
                                                class="form-select form-select-solid form-select-lg fw-semibold">
                                            </select>
                                        </div>
                                        <div class="col-md-4 fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-semibold mb-2">DownTime Training</label>
                                            <select aria-label="Select DownTime Training" id="downtime_training"
                                                name="downtime_training" data-control="select2"
                                                data-placeholder="Select DownTime Training"
                                                class="form-select form-select-solid form-select-lg fw-semibold">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-md-4 fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-semibold mb-2">DownTime OPS</label>
                                            <select aria-label="Select DownTime OPS" id="downtime_ops"
                                                name="downtime_ops" data-control="select2"
                                                data-placeholder="Select DownTime OPS"
                                                class="form-select form-select-solid form-select-lg fw-semibold">
                                            </select>
                                        </div>
                                        <div class="col-md-4 fv-row">
                                            <label class="required fs-5 fw-semibold mb-2">IT</label>
                                            <input type="text" class="form-control form-control-solid"
                                                maxlength="12" placeholder="IT" name="it" />
                                        </div>
                                        <div class="col-md-4 fv-row">
                                            <label class="required fs-5 fw-semibold mb-2">HR</label>
                                            <input type="text" class="form-control form-control-solid"
                                                maxlength="12" placeholder="HR" name="hr" />
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-md-4 fv-row">
                                            <label class="required fs-5 fw-semibold mb-2">Reports To</label>
                                            <input type="text" class="form-control form-control-solid"
                                                maxlength="12" placeholder="Reports To" name="reports_to" />
                                        </div>
                                        <div class="col-md-4 fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-semibold mb-2">Exception Approver</label>
                                            <select aria-label="Select Exception Approver" id="exception_approver"
                                                name="exception_approver" data-control="select2"
                                                data-placeholder="Select Exception Approver"
                                                class="form-select form-select-solid form-select-lg fw-semibold">
                                            </select>
                                        </div>
                                        <div class="col-md-4 fv-row">
                                            <label class="required fs-5 fw-semibold mb-2">Site Spoc</label>
                                            <select aria-label="Select Site Spoc" id="site_spoc" name="site_spoc"
                                                data-control="select2" data-placeholder="Select Site Spoc"
                                                class="form-select form-select-solid form-select-lg fw-semibold">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-md-4 fv-row">
                                            <label class="required fs-5 fw-semibold mb-2">Stipends</label>
                                            <input type="text" class="form-control form-control-solid"
                                                maxlength="10" name="Stipen2"
                                                onkeypress="javascript:return isNumber(event)" placeholder="Stipends"
                                                name="stipends" />
                                        </div>
                                        <div class="col-md-4 fv-row">
                                            <label class="required fs-5 fw-semibold mb-2">Stipends Days</label>
                                            <input type="text" maxlength="2" name="StipendDays"
                                                onkeypress="javascript:return isNumber(event)"
                                                class="form-control form-control-solid" placeholder="Stipends Days"
                                                name="stipends_days" />
                                        </div>
                                        <div class="col-md-4 fv-row">
                                            <label class="required fs-5 fw-semibold mb-2">Induction</label>
                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="Induction" name="induction" />
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-md-4 fv-row">
                                            <label class="required fs-5 fw-semibold mb-2">ER Induction</label>
                                            <input type="text" maxlength="3"
                                                onkeypress="javascript:return isNumber(event)"
                                                class="form-control form-control-solid" placeholder="ER Induction"
                                                name="er_induction" />
                                        </div>
                                        <div class="col-md-4 fv-row">
                                            <label class="required fs-5 fw-semibold mb-2">ER Induction Period</label>
                                            <input type="text" maxlength="3"
                                                onkeypress="javascript:return isNumber(event)"
                                                class="form-control form-control-solid"
                                                placeholder="ER Induction Period" name="er_induction_period" />
                                        </div>
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
                                        <div
                                            class="col-lg-8 fv-row fv-plugins-icon-container fv-plugins-bootstrap5-row-invalid">
                                            <div class="d-flex align-items-center mt-3">
                                                <label
                                                    class="form-check form-check-custom form-check-inline form-check-solid me-5 is-valid">
                                                    <input class="form-check-input" id="address_for_support"
                                                        name="address_for_support" type="checkbox" value="Yes">
                                                    <span class="fw-semibold ps-2 fs-6">Address</span>
                                                </label>

                                                <label
                                                    class="form-check form-check-custom form-check-inline form-check-solid is-invalid">
                                                    <input class="form-check-input" id="education_for_support"
                                                        name="education_for_support" type="checkbox" value="Yes">
                                                    <span class="fw-semibold ps-2 fs-6">Education</span>
                                                </label>

                                                <label
                                                    class="form-check form-check-custom form-check-inline form-check-solid me-5 is-valid">
                                                    <input class="form-check-input" id="employment_for_support"
                                                        name="employment_for_support" type="checkbox" value="Yes">
                                                    <span class="fw-semibold ps-2 fs-6">Employment</span>
                                                </label>


                                                <label
                                                    class="form-check form-check-custom form-check-inline form-check-solid is-invalid">
                                                    <input class="form-check-input" id="criminal_for_support"
                                                        name="criminal_for_support" type="checkbox" value="Yes">
                                                    <span class="fw-semibold ps-2 fs-6">Criminal</span>
                                                </label>

                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group row">

                                        <label class="col-lg-4 col-form-label  fw-semibold fs-6">For CSA</label>
                                        <div
                                            class="col-lg-8 fv-row fv-plugins-icon-container fv-plugins-bootstrap5-row-invalid">

                                            <div class="d-flex align-items-center mt-3">
                                                <label
                                                    class="form-check form-check-custom form-check-inline form-check-solid me-5 is-valid">
                                                    <input class="form-check-input" name="address_for_csa"
                                                        type="checkbox" value="Yes">
                                                    <span class="fw-semibold ps-2 fs-6">Address</span>
                                                </label>

                                                <label
                                                    class="form-check form-check-custom form-check-inline form-check-solid is-invalid">
                                                    <input class="form-check-input" name="education_for_csa"
                                                        type="checkbox" value="Yes">
                                                    <span class="fw-semibold ps-2 fs-6">Education</span>
                                                </label>

                                                <label
                                                    class="form-check form-check-custom form-check-inline form-check-solid me-5 is-valid">
                                                    <input class="form-check-input" name="employment_for_csa"
                                                        type="checkbox" value="Yes">
                                                    <span class="fw-semibold ps-2 fs-6">Employment</span>
                                                </label>

                                                <label
                                                    class="form-check form-check-custom form-check-inline form-check-solid is-invalid">
                                                    <input class="form-check-input" name="criminal_for_csa"
                                                        type="checkbox" value="Yes">
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
                                    <span class="indicator-label">Save</span>
                                    <!--end::Indicator label-->
                                    <!--begin::Indicator progress-->
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    <!--end::Indicator progress-->
                                </button>
                                <div>
                                    <!--end::Submit-->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        {{--  <button type="button" class="btn btn-primary">Save changes</button>  --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






<div class="modal fade" id="kt_modal_edit">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content shadow-none">
            <div class="modal-header">
                <h5 class="modal-title">Edit Client Master Details</h5>
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>
            <div class="modal-body">
                <div class="row g-5 g-xl-10 mb-xl-10">
                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-6 mb-md-5 mb-xl-10">
                        <div class="card card-flush cardOutline">
                            <div class="card-body" id="edit_client_detailssss">

                                <form action="{{ url('updateClient') }}" class="form mb-15" method="post"
                                    id="update_clients_form">
                                    <!--begin::Input group-->
                                    @csrf
                                    <div class="row mb-5">
                                        <input type="hidden" name="cm_id" id="cm_id">
                                        <!--begin::Col-->
                                        <div class="col-md-4 fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-semibold mb-2">Location</label>
                                            <select aria-label="Select a Location" id="editlocation" name="location"
                                                data-control="select2" data-placeholder="Select a Location..."
                                                class="form-select form-select-solid form-select-lg fw-semibold">
                                                @php  $location = getlocation(); @endphp
                                                <option value="">Please Select Location</option>
                                                @foreach ($location as $list)
                                                    <option value="{{ $list->id }}">{{ $list->location }}
                                                    </option>
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
                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="Enter Client Name" name="editclientname"
                                                id="editclientname" />
                                            <!--end::Input-->
                                        </div>

                                        <div class="col-md-4 fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-semibold mb-2">Account Head</label>
                                            <select aria-label="Select Account Head" id="edit_account_head"
                                                name="edit_account_head" data-control="select2"
                                                data-placeholder="Select Account Head"
                                                class="form-select form-select-solid form-select-lg fw-semibold">
                                            </select>
                                        </div>
                                        <!--end::Col-->
                                    </div>

                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-4 fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-semibold mb-2">Vertical Head</label>
                                            <select aria-label="Select a Vertical Head" id="edit_vertical_head"
                                                name="edit_vertical_head" data-control="select2"
                                                data-placeholder="Select a Vertical Head..."
                                                class="form-select form-select-solid ">

                                            </select>

                                        </div>


                                        <div class="col-md-4 fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-semibold mb-2">Department</label>
                                            <select aria-label="Select Department" id="edit_department"
                                                name="edit_department" data-control="select2"
                                                data-placeholder="Select Department"
                                                class="form-select form-select-solid form-select-lg fw-semibold">

                                            </select>
                                        </div>

                                        <!--end::Col-->


                                        <div class="col-md-4 fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Process Name</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="Enter Process Name" id="edit_process_name"
                                                name="edit_process_name" />
                                            <!--end::Input-->
                                        </div>
                                    </div>


                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-4 fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-semibold mb-2">Operation Head</label>
                                            <select aria-label="Select a Operation Head" id="edit_operation_head"
                                                name="edit_operation_head" data-control="select2"
                                                data-placeholder="Select a Operation Head..."
                                                class="form-select form-select-solid form-select-lg fw-semibold">

                                            </select>

                                        </div>

                                        <!--end::Col-->
                                        <!--begin::Col-->

                                        <div class="col-md-4 fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-semibold mb-2">Quality Head</label>
                                            <select aria-label="Select Quality Head" id="edit_quality_head"
                                                name="edit_quality_head" data-control="select2"
                                                data-placeholder="Select Quality Head"
                                                class="form-select form-select-solid form-select-lg fw-semibold">

                                            </select>

                                        </div>
                                        <!--end::Col-->
                                        <div class="col-md-4 fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Training Head</label>
                                            <select aria-label="Select Training Head" id="edit_training_head"
                                                name="edit_training_head" data-control="select2"
                                                data-placeholder="Select Training Head"
                                                class="form-select form-select-solid form-select-lg fw-semibold">

                                            </select>

                                            <!--end::Input-->
                                        </div>
                                    </div>

                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-4 fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-semibold mb-2">ER SPOC</label>
                                            <select aria-label="Select a ER SPOC" id="edit_er_spoc"
                                                name="edit_er_spoc" data-control="select2"
                                                data-placeholder="Select a ER SPOC..."
                                                class="form-select form-select-solid form-select-lg fw-semibold">

                                            </select>

                                        </div>

                                        <!--end::Col-->
                                        <!--begin::Col-->

                                        <div class="col-md-4 fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-semibold mb-2">ER SPOC 2</label>
                                            <select aria-label="Select ER SPOC 2" id="edit_er_spoc2"
                                                name="edit_er_spoc2" data-control="select2"
                                                data-placeholder="Select ER SPOC 2"
                                                class="form-select form-select-solid form-select-lg fw-semibold">

                                            </select>

                                        </div>
                                        <!--end::Col-->
                                        <div class="col-md-4 fv-row">
                                            <!--end::Label-->

                                            <label class="required fs-5 fw-semibold mb-2">ER SPOC 3</label>
                                            <select aria-label="Select ER SPOC 3" id="edit_er_spoc3"
                                                name="edit_er_spoc3" data-control="select2"
                                                data-placeholder="Select ER SPOC 3"
                                                class="form-select form-select-solid form-select-lg fw-semibold">

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
                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="Enter Sub Process Name" id="edit_sub_process_name"
                                                name="edit_sub_process_name" />
                                            <!--end::Input-->
                                        </div>
                                        <!--begin::Col-->
                                        <div class="col-md-4 fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-semibold mb-2">DownTime Quality</label>
                                            <select aria-label="Select a DownTime Quality" id="edit_downtime_quality"
                                                name="edit_downtime_quality" data-control="select2"
                                                data-placeholder="Select a DownTime Quality..."
                                                class="form-select form-select-solid form-select-lg fw-semibold">

                                            </select>

                                        </div>


                                        <div class="col-md-4 fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-semibold mb-2">DownTime Training</label>
                                            <select aria-label="Select DownTime Training" id="edit_downtime_training"
                                                name="edit_downtime_training" data-control="select2"
                                                data-placeholder="Select DownTime Training"
                                                class="form-select form-select-solid form-select-lg fw-semibold">

                                            </select>

                                        </div>
                                        <!--end::Col-->
                                    </div>


                                    <div class="row mb-5">

                                        <div class="col-md-4 fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-semibold mb-2">DownTime OPS</label>
                                            <select aria-label="Select DownTime OPS" id="edit_downtime_ops"
                                                name="edit_downtime_ops" data-control="select2"
                                                data-placeholder="Select DownTime OPS"
                                                class="form-select form-select-solid form-select-lg fw-semibold">

                                            </select>

                                        </div>

                                        <div class="col-md-4 fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">IT</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid"
                                                maxlength="12" placeholder="IT" name="edit_it" id="edit_it" />
                                            <!--end::Input-->
                                        </div>
                                        <!--begin::Col-->

                                        <div class="col-md-4 fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">HR</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid"
                                                maxlength="12" placeholder="HR" name="edit_hr" id="edit_hr" />
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
                                            <input type="text" class="form-control form-control-solid"
                                                maxlength="12" placeholder="Reports To" id="edit_reports_to"
                                                name="edit_reports_to" />
                                            <!--end::Input-->
                                        </div>

                                        <div class="col-md-4 fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-semibold mb-2">Exception Approver</label>
                                            <select aria-label="Select Exception Approver"
                                                id="edit_exception_approver" name="edit_exception_approver"
                                                data-control="select2" data-placeholder="Select Exception Approver"
                                                class="form-select form-select-solid form-select-lg fw-semibold">

                                            </select>

                                        </div>

                                        <div class="col-md-4 fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Site Spoc</label>
                                            <select aria-label="Select Site Spoc" id="edit_site_spoc"
                                                name="edit_site_spoc" data-control="select2"
                                                data-placeholder="Select Site Spoc"
                                                class="form-select form-select-solid form-select-lg fw-semibold">

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
                                            <input type="text" class="form-control form-control-solid"
                                                maxlength="10" id="edit_Stipen2" name="edit_Stipen2"
                                                onkeypress="javascript:return isNumber(event)"
                                                placeholder="Stipends" />
                                            <!--end::Input-->
                                        </div>



                                        <div class="col-md-4 fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Stipends Days</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" maxlength="2" name="edit_StipendDays"
                                                id="edit_StipendDays" onkeypress="javascript:return isNumber(event)"
                                                class="form-control form-control-solid" placeholder="Stipends Days" />
                                            <!--end::Input-->
                                        </div>

                                        <!--end::Col-->


                                        <div class="col-md-4 fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Induction</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="Induction" id="edit_induction" name="edit_induction" />
                                            <!--end::Input-->
                                        </div>
                                    </div>


                                    <div class="row mb-5">

                                        <div class="col-md-4 fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">ER Induction</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" maxlength="3"
                                                onkeypress="javascript:return isNumber(event)"
                                                class="form-control form-control-solid" placeholder="ER Induction"
                                                name="edit_er_induction" id="edit_er_induction" />
                                            <!--end::Input-->
                                        </div>


                                        <div class="col-md-4 fv-row">
                                            <!--end::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">ER Induction Period</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <input type="text" id="edit_er_induction_period" maxlength="3"
                                                onkeypress="javascript:return isNumber(event)"
                                                class="form-control form-control-solid"
                                                placeholder="ER Induction Period" name="edit_er_induction_period" />
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
                                        <div
                                            class="col-lg-8 fv-row fv-plugins-icon-container fv-plugins-bootstrap5-row-invalid">
                                            <div class="d-flex align-items-center mt-3">
                                                <label
                                                    class="form-check form-check-custom form-check-inline form-check-solid me-5 is-valid">
                                                    <input class="form-check-input" name="edit_address_for_support"
                                                        id="edit_address_for_support" type="checkbox" value="Yes">
                                                    <span class="fw-semibold ps-2 fs-6">Address</span>
                                                </label>

                                                <label
                                                    class="form-check form-check-custom form-check-inline form-check-solid is-invalid">
                                                    <input class="form-check-input" name="edit_education_for_support"
                                                        id="edit_education_for_support" type="checkbox"
                                                        value="Yes">
                                                    <span class="fw-semibold ps-2 fs-6">Education</span>
                                                </label>

                                                <label
                                                    class="form-check form-check-custom form-check-inline form-check-solid me-5 is-valid">
                                                    <input class="form-check-input" name="edit_employment_for_support"
                                                        id="edit_employment_for_support" type="checkbox"
                                                        value="Yes">
                                                    <span class="fw-semibold ps-2 fs-6">Employment</span>
                                                </label>

                                                <label
                                                    class="form-check form-check-custom form-check-inline form-check-solid is-invalid">
                                                    <input class="form-check-input" name="edit_criminal_for_support"
                                                        id="edit_criminal_for_support" type="checkbox"
                                                        value="Yes">
                                                    <span class="fw-semibold ps-2 fs-6">Criminal</span>
                                                </label>

                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group row">

                                        <label class="col-lg-4 col-form-label  fw-semibold fs-6">For CSA</label>
                                        <div
                                            class="col-lg-8 fv-row fv-plugins-icon-container fv-plugins-bootstrap5-row-invalid">

                                            <div class="d-flex align-items-center mt-3">
                                                <label
                                                    class="form-check form-check-custom form-check-inline form-check-solid me-5 is-valid">
                                                    <input class="form-check-input" name="edit_address_for_csa"
                                                        id="edit_address_for_csa" type="checkbox" value="Yes">
                                                    <span class="fw-semibold ps-2 fs-6">Address</span>
                                                </label>

                                                <label
                                                    class="form-check form-check-custom form-check-inline form-check-solid is-invalid">
                                                    <input class="form-check-input" name="edit_education_for_csa"
                                                        id="edit_education_for_csa" type="checkbox" value="Yes">
                                                    <span class="fw-semibold ps-2 fs-6">Education</span>
                                                </label>

                                                <label
                                                    class="form-check form-check-custom form-check-inline form-check-solid me-5 is-valid">
                                                    <input class="form-check-input" name="edit_employment_for_csa"
                                                        id="edit_employment_for_csa" type="checkbox" value="Yes">
                                                    <span class="fw-semibold ps-2 fs-6">Employment</span>
                                                </label>

                                                <label
                                                    class="form-check form-check-custom form-check-inline form-check-solid is-invalid">
                                                    <input class="form-check-input" name="edit_criminal_for_csa"
                                                        id="edit_criminal_for_csa" type="checkbox" value="Yes">
                                                    <span class="fw-semibold ps-2 fs-6">Criminal</span>
                                                </label>

                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4 mt-5 float-right">
                                <button type="submit" class="btn btn-primary" id="kt_update_submit_button">
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('includes.commonjs')
<script>
    $(function() {


        function deleteClient(department_id) {
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

                var url = $('#update_clients_form').attr('action');
                var form = $('#update_clients_form').serialize();
                $.post(url, form, function(response) {
                    response.success == true ?
                        Swal.fire({
                            text: response.message,
                            icon: "success",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }) :
                        Swal.fire({
                            text: response.message,
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        })
                });
            } else {



                return false;
            }
        });



        $('.manage-client').on('click', function() {
            var editId = $(this).attr('id');
            var cm_id = editId.slice(6);
            $.ajax({
                url: "{{ url('edit-client-details') }}/" + cm_id,
                success: function(result) {
                    const location = result.row.location;
                    $("#editlocation").val(result.row.location).select2();

                    $.ajax({
                        url: "{{ url('get-dropdown') }}/" + location + '/excep',
                        success: function(response) {
                            $.each(response.statement, function(val, text) {

                                $('#edit_exception_approver').append(
                                    new Option(text.EmployeeName +
                                        '(' + text.EmployeeID + ')',
                                        text.EmployeeID));
                            });
                        }

                    });

                    $.ajax({
                        url: "{{ url('get-department') }}/",
                        success: function(response) {
                            $.each(response.department, function(val, text) {
                                $('#edit_department').append(new Option(
                                    text.dept_name, text.dept_id
                                ));
                                $('#edit_department').val(result.row
                                    .dept_id).select2();
                            });
                        }
                    });

                    $.ajax({
                        url: "{{ url('get-dropdown') }}/" + location + '/excep',
                        success: function(response) {
                            $.each(response.statement, function(val, text) {
                                $('#edit_downtime_quality').append(
                                    new Option(text.EmployeeName +
                                        '(' + text.EmployeeID + ')',
                                        text.EmployeeID));
                            });
                        }
                    });

                    $.ajax({
                        url: "{{ url('get-dropdown') }}/" + location + '/excep',
                        success: function(response) {
                            $.each(response.statement, function(val, text) {
                                $('#edit_downtime_training').append(
                                    new Option(text.EmployeeName +
                                        '(' + text.EmployeeID + ')',
                                        text.EmployeeID));
                            });
                        }
                    });

                    $.ajax({
                        url: "{{ url('get-dropdown') }}/" + location + '/excep',
                        success: function(response) {
                            $.each(response.statement, function(val, text) {
                                $('#edit_downtime_ops').append(
                                    new Option(text.EmployeeName +
                                        '(' + text.EmployeeID + ')',
                                        text.EmployeeID));
                            });
                        }
                    });

                    $.ajax({
                        url: "{{ url('get-dropdown') }}/" + location + '/vh',
                        success: function(response) {
                            $.each(response.statement, function(val, text) {
                                $('#edit_vertical_head').append(
                                    new Option(text.EmployeeName +
                                        '(' + text.EmployeeID + ')',
                                        text.EmployeeID));
                                $("#edit_vertical_head").val(result.row
                                    .vh).select2();
                            });
                        }
                    });

                    $.ajax({
                        url: "{{ url('get-dropdown') }}/" + location + '/ah',
                        success: function(response) {
                            $.each(response.statement, function(val, text) {
                                $('#edit_account_head').append(
                                    new Option(text.EmployeeName +
                                        '(' + text.EmployeeID + ')',
                                        text.EmployeeID));
                                $('#edit_operation_head').append(
                                    new Option(text.EmployeeName +
                                        '(' + text.EmployeeID + ')',
                                        text.EmployeeID));
                                $('#edit_operation_head').val(result.row
                                    .oh).select2();
                                $('#edit_account_head').val(result.row
                                    .account_head).select2();
                            });
                        }
                    });

                    $.ajax({
                        url: "{{ url('get-dropdown') }}/" + location + '/ah',
                        success: function(response) {
                            $.each(response.statement, function(val, text) {
                                $('#edit_quality_head').append(
                                    new Option(text.EmployeeName +
                                        '(' + text.EmployeeID + ')',
                                        text.EmployeeID));
                                $('#edit_quality_head').val(result.row
                                    .qh).select2();
                            });

                        }
                    });

                    $.ajax({
                        url: "{{ url('get-dropdown') }}/" + location + '/ah',
                        success: function(response) {
                            $.each(response.statement, function(val, text) {
                                $('#edit_training_head').append(
                                    new Option(text.EmployeeName +
                                        '(' + text.EmployeeID + ')',
                                        text.EmployeeID));
                                $("#edit_training_head").val(result.row
                                    .th).select2();
                            });
                        }
                    });

                    $.ajax({
                        url: "{{ url('get-dropdown') }}/" + location + '/site',
                        success: function(response) {
                            $.each(response.statement, function(val, text) {
                                $('#edit_site_spoc').append(new Option(
                                    text.EmployeeName + '(' +
                                    text.EmployeeID + ')', text
                                    .EmployeeID));
                            });
                        }
                    });

                    $.ajax({
                        url: "{{ url('get-dropdown') }}/" + location + '/hr',
                        success: function(response) {
                            $.each(response.statement, function(val, text) {
                                $('#edit_er_spoc').append(new Option(
                                    text.EmployeeName + '(' +
                                    text.EmployeeID + ')', text
                                    .EmployeeID));
                                $('#edit_er_spoc').val(result.row
                                    .er_scop).select2();
                            });
                        }
                    });

                    $.ajax({
                        url: "{{ url('get-dropdown') }}/" + location + '/hr',
                        success: function(response) {
                            $.each(response.statement, function(val, text) {
                                $('#edit_er_spoc2').append(new Option(
                                    text.EmployeeName + '(' +
                                    text.EmployeeID + ')', text
                                    .EmployeeID));
                                $('#edit_er_spoc2').val(result.row
                                    .er_spoc2).select2();
                            });
                        }
                    });


                    $.ajax({
                        url: "{{ url('get-dropdown') }}/" + location + '/hr',
                        success: function(response) {
                            $.each(response.statement, function(val, text) {
                                $('#edit_er_spoc3').append(new Option(
                                    text.EmployeeName + '(' +
                                    text.EmployeeID + ')', text
                                    .EmployeeID));
                                $('#edit_er_spoc3').val(result.row
                                    .er_spoc3).select2();
                            });
                        }
                    });






                    $('#editclientname').val(result.row.client_name);
                    $('#edit_er_induction_period').val(result.row.days_of_rotation);
                    $('#edit_er_induction').val(result.row.days_from_floor);
                    $('#edit_induction').val(result.row.days_from_joining);
                    $('#edit_StipendDays').val(result.row.StipendDays);
                    $('#edit_Stipen2').val(result.row.Stipend);
                    $('#edit_it').val(result.row.ITID);
                    $('#edit_hr').val(result.row.HRID);
                    $('#edit_reports_to').val(result.row.ReportsTo);
                    $('#edit_sub_process_name').val(result.row.sub_process);
                    $('#edit_downtime_quality').val(result.row.QualityID);
                    $('#edit_downtime_training').val(result.row.TrainingID);
                    $('#edit_downtime_ops').val(result.row.OpsID);
                    $('#edit_process_name').val(result.row.Process);

                    if (result.background_support.Addr == 'Yes') {
                        $('#edit_address_for_support').attr('checked', true);
                    }
                    if (result.background_support.Crim == 'Yes') {
                        $('#edit_criminal_for_support').attr('checked', true);
                    }
                    if (result.background_support.Edu == 'Yes') {
                        $('#edit_education_for_support').attr('checked', true);
                    }
                    if (result.background_support.Emp == 'Yes') {
                        $('#edit_employment_for_support').attr('checked', true);
                    }

                    if (result.background_csa.Addr == 'Yes') {
                        $('#edit_address_for_csa').attr('checked', true);
                    }
                    if (result.background_csa.Crim == 'Yes') {
                        $('#edit_criminal_for_csa').attr('checked', true);
                    }
                    if (result.background_csa.Edu == 'Yes') {
                        $('#edit_education_for_csa').attr('checked', true);
                    }
                    if (result.background_csa.Emp == 'Yes') {
                        $('#edit_employment_for_csa').attr('checked', true);
                    }


                    $('#cm_id').val(result.row.cm_id);



                }
            });
        });



        $('#kt_contact_form').submit(function(event) {
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
                var url = $('#kt_contact_form').attr('action');
                var form = $('#kt_contact_form').serialize();
                $.post(url, form, function(response) {
                    response.success == true ?
                        Swal.fire({
                            text: response.message,
                            icon: "success",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }) :
                        Swal.fire({
                            text: response.message,
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        })
                });
            } else {
                return false;
            }
        });

        $('#location').on('change', function(e) {
            var location = $(this).val();
            $.ajax({
                url: "{{ url('get-dropdown') }}/" + location + '/excep',
                success: function(result) {
                    $("#exception_approver").html(result.html);
                }
            });

            $.ajax({
                url: "{{ url('get-dropdown') }}/" + location + '/excep',
                success: function(result) {
                    $("#downtime_quality").html(result.html);
                }
            });

            $.ajax({
                url: "{{ url('get-dropdown') }}/" + location + '/excep',
                success: function(result) {
                    $("#downtime_training").html(result.html);
                }
            });

            $.ajax({
                url: "{{ url('get-dropdown') }}/" + location + '/excep',
                success: function(result) {
                    $("#downtime_ops").html(result.html);
                }
            });

            $.ajax({
                url: "{{ url('get-dropdown') }}/" + location + '/vh',
                success: function(result) {
                    $("#vertical_head").html(result.html);
                }
            });

            $.ajax({
                url: "{{ url('get-dropdown') }}/" + location + '/ah',
                success: function(result) {
                    $("#operation_head").html(result.html);
                    $("#account_head").html(result.html);
                }
            });

            $.ajax({
                url: "{{ url('get-dropdown') }}/" + location + '/ah',
                success: function(result) {
                    $("#quality_head").html(result.html);
                }
            });

            $.ajax({
                url: "{{ url('get-dropdown') }}/" + location + '/ah',
                success: function(result) {
                    $("#training_head").html(result.html);
                }
            });

            $.ajax({
                url: "{{ url('get-dropdown') }}/" + location + '/site',
                success: function(result) {
                    $("#site_spoc").html(result.html);
                }
            });

            $.ajax({
                url: "{{ url('get-dropdown') }}/" + location + '/hr',
                success: function(result) {
                    $("#er_spoc").html(result.html);
                }
            });

            $.ajax({
                url: "{{ url('get-dropdown') }}/" + location + '/hr',
                success: function(result) {
                    $("#er_spoc2").html(result.html);
                }
            });


            $.ajax({
                url: "{{ url('get-dropdown') }}/" + location + '/hr',
                success: function(result) {
                    $("#er_spoc3").html(result.html);
                }
            });
        });
        $.ajax({
            url: "{{ url('get-department') }}/",
            success: function(result) {
                $("#department").html(result.html);
            }
        });
    });
</script>
