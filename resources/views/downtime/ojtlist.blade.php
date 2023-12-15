@extends('includes.master')
@section('content')
@section('page-title', 'OJT Downtime')
@section('page-heading', 'OJT Downtime List')
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
                        <button type="button" class="btn btn-primary add-buddy-downtime" data-bs-toggle="modal" data-bs-target="#kt_buddy_edit_downtime">Add</button>
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
                           <th class="min-w-15px sorting">Client Training</th>
						   <th class="min-w-15px sorting">Location</th>
						   <th class="min-w-15px sorting">Total Time</th>
						   <th  class="min-w-15px sorting">Min Time</th>
						    <th  class="min-w-15px sorting">Max Time</th>
						    <th class="min-w-15px sorting">OJT Days</th>
						    <th  class="min-w-15px sorting">Training Days</th>
						    <th  class="min-w-15px sorting">OJT Day 1st</th>
						    <th  class="min-w-15px sorting">OJT Day 2nd</th>
						    <th  class="min-w-15px sorting">OJT Day 3rd</th>
						    <th  class="min-w-15px sorting">OJT Day 4th</th>
						    <th  class="min-w-15px sorting">OJT Day 5th</th>
						    <th  class="min-w-15px sorting">OJT Day 6th</th>
						    <th  class="min-w-15px sorting">OJT Day 7th</th>
						    <th  class="min-w-15px sorting">OJT Day 8th</th>
						    <th  class="min-w-15px sorting">OJT Day 9th</th>
						    <th  class="min-w-15px sorting">OJT Day 10th</th>
						    <th  class="min-w-15px sorting">OJT Day 11th</th>
						    <th  class="min-w-15px sorting">OJT Day 12th</th>
						    <th  class="min-w-15px sorting">OJT Day 13th</th>
						    <th  class="min-w-15px sorting">OJT Day 14th</th>
						    <th  class="min-w-15px sorting">OJT Day 15th</th>
						    <th  class="min-w-15px sorting">OJT Day 16th</th>
						    <th  class="min-w-15px sorting">OJT Day 17th</th>
						    <th  class="min-w-15px sorting">OJT Day 18th</th>
						    <th  class="min-w-15px sorting">OJT Day 19th</th>
						    <th  class="min-w-15px sorting">OJT Day 20th</th>
                            <th class="text-end min-w-10px sorting_disabled">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                     @if(!@empty($lists))
                     @php $i = 1; @endphp
                     @foreach($lists as $list)
                    <tr class="even">
                            <td>{{ $i }}</td>
                            <td class="cm_id" data="{{ $list->cm_id }}">{{ $list->client_name }}  || {{ $list->process }} || {{ $list->sub_process }}</td>
							<td class="client_training">{{ $list->client_training }}</td>
							<td class="location">{{ $list->location }}</td>
							<td class="client_time_ttl">{{ $list->client_time_ttl }}</td>
							<td class="client_time_min">{{ $list->client_time_min }}</td>
							<td class="client_time_max">{{ $list->client_time_max }}</td>
							<td class="ojt_days">{{ $list->ojt_days }}</td>
							<td class="training_days">{{ $list->training_days }}</td>
							<td class="ojt_day_1">{{ $list->ojt_day_1 }}</td>
							<td class="ojt_day_2">{{ $list->ojt_day_2 }}</td>
							<td class="ojt_day_3">{{ $list->ojt_day_3 }}</td>
							<td class="ojt_day_4">{{ $list->ojt_day_4 }}</td>
							<td class="ojt_day_5">{{ $list->ojt_day_5 }}</td>
							<td class="ojt_day_6">{{ $list->ojt_day_6 }}</td>
							<td class="ojt_day_7">{{ $list->ojt_day_7 }}</td>
							<td class="ojt_day_8">{{ $list->ojt_day_8 }}</td>
							<td class="ojt_day_9">{{ $list->ojt_day_9 }}</td>
							<td class="ojt_day_10">{{ $list->ojt_day_10 }}</td>
							<td class="ojt_day_11">{{ $list->ojt_day_11 }}</td>
							<td class="ojt_day_12">{{ $list->ojt_day_12 }}</td>
							<td class="ojt_day_13">{{ $list->ojt_day_13 }}</td>
							<td class="ojt_day_14">{{ $list->ojt_day_14 }}</td>
							<td class="ojt_day_15">{{ $list->ojt_day_15 }}</td>
							<td class="ojt_day_16">{{ $list->ojt_day_16 }}</td>
							<td class="ojt_day_17">{{ $list->ojt_day_17 }}</td>
							<td class="ojt_day_18">{{ $list->ojt_day_18 }}</td>
							<td class="ojt_day_19">{{ $list->ojt_day_19 }}</td>
							<td class="ojt_day_20">{{ $list->ojt_day_20 }}</td>
                            <td class="text-end">
                            <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                            <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                <div class="menu-item px-3">
                                    <a href="{{ __('javaScript::void(0)') }}" id="{{ $list->cm_id }}"  data-bs-toggle="modal" data-bs-target="#kt_buddy_edit_downtime" class="menu-link px-3 edit-buddy-downtime">Edit</a>
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



<div class="modal fade" id="kt_buddy_edit_downtime" tabindex="-1" aria-hidden="true" role="dialog">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <!--begin::Modal content-->
        <div class="modal-content">
            <form class="form fv-plugins-bootstrap5 fv-plugins-framework" action="{{ url('save-downtime-ojt') }}"  method="post" id="kt_modal_downtime_form" data-kt-redirect="">
                @csrf
                   <div class="modal-header" id="kt_modal_edit_downtime_header">
                          <h2 class="fw-bold">OJT Downtime Details</h2>
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
                                <input name="edit_cm_id" id="edit_cm_id" type="hidden">
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
                                <label class="required fs-6 fw-semibold mb-2">Training Days</label>
                                <input type="text" id="training_days" name="training_days" placeholder="Enter training Days" class="form-control">
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="row fv-plugins-icon-container">
                            <div class="col-md-4 col-sm-4 col-lg-4 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">OJT Days</label>
                                <input type="text" id="ojt_time" name="ojt_time" placeholder="Enter OJT Days" class="form-control">
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                            </div>

                            <div class="col-md-4 col-sm-4 col-lg-4 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Total Time</label>
                                <input type="text" id="total_time" name="total_time" placeholder="total time Days" class="form-control">
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                            </div>

                            <div class="col-md-4 col-sm-4 col-lg-4 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Client Training</label>
                                <select  aria-label="Select Client Training" id="client_training" name="client_training" data-control="select2" data-placeholder="Select Client Training" class="form-select  form-select-lg ">
                                <option value="YES">YES</option>
                                <option value="NO">NO</option>
                                </select>
                               <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="row fv-plugins-icon-container">
                            <div class="col-md-4 col-sm-4 col-lg-4 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Min Time</label>
                                <select  aria-label="Select DownTime Time" id="min_time" name="min_time" data-control="select2" data-placeholder="Select DownTime Min Time" class="form-select form-select-lg ">
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
                            <div class="col-md-4 col-sm-4 col-lg-4 fv-row">
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
                            <div class="col-md-4 col-sm-4 col-lg-4 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Day 1</label>
                                <select  aria-label="Select Day 1 Time" id="day_1" name="day_1" data-control="select2" data-placeholder="Select Day 1 Time" class="form-select  form-select-lg ">
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

                        <div class="row fv-plugins-icon-container">
                            <div class="col-md-4 col-sm-4 col-lg-4 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Day 2</label>
                                <select  aria-label="Select Day 2 Time" id="day_2" name="day_2" data-control="select2" data-placeholder="Select Day 2 Time" class="form-select form-select-lg ">

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
                            <div class="col-md-4 col-sm-4 col-lg-4 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Day 3</label>
                                <select  aria-label="Select Day 3" id="day_3" name="day_3" data-control="select2" data-placeholder="Select Day 3" class="form-select  form-select-lg ">

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
                            <div class="col-md-4 col-sm-4 col-lg-4 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Day 4</label>
                                <select  aria-label="Select Day 4 Time" id="day_4" name="day_4" data-control="select2" data-placeholder="Select Day 4 Time" class="form-select  form-select-lg ">

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

                        <div class="row fv-plugins-icon-container">
                            <div class="col-md-4 col-sm-4 col-lg-4 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Day 5</label>
                                <select  aria-label="Select Day 5 Time" id="day_5" name="day_5" data-control="select2" data-placeholder="Select Day 5 Time" class="form-select form-select-lg ">

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
                            <div class="col-md-4 col-sm-4 col-lg-4 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Day 6</label>
                                <select  aria-label="Select Day 6 Time" id="day_6" name="day_6" data-control="select2" data-placeholder="Select Day 6 Tim" class="form-select form-select-lg ">
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
                            <div class="col-md-4 col-sm-4 col-lg-4 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Day 7</label>
                                <select  aria-label="Select Day 7 Time" id="day_7" name="day_7" data-control="select2" data-placeholder="Select Day 7 Tim" class="form-select form-select-lg ">
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


                        <div class="row fv-plugins-icon-container">
                            <div class="col-md-4 col-sm-4 col-lg-4 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Day 8</label>
                                <select  aria-label="Select Day 8 Time" id="day_8" name="day_8" data-control="select2" data-placeholder="Select Day 8 Tim" class="form-select form-select-lg">

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
                            <div class="col-md-4 col-sm-4 col-lg-4 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Day 9</label>
                                <select  aria-label="Select Day 9 Time" id="day_9" name="day_9" data-control="select2" data-placeholder="Select Day 9 Tim" class="form-select form-select-lg">
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
                            <div class="col-md-4 col-sm-4 col-lg-4 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Day 10</label>
                                <select  aria-label="Select Day 10 Time" id="day_10" name="day_10" data-control="select2" data-placeholder="Select Day 10 Tim" class="form-select form-select-lg">
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

                        <div class="row fv-plugins-icon-container">
                            <div class="col-md-4 col-sm-4 col-lg-4 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Day 11</label>
                                <select  aria-label="Select Day 11 Time" id="day_11" name="day_11" data-control="select2" data-placeholder="Select Day 11 Tim" class="form-select form-select-lg">

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
                            <div class="col-md-4 col-sm-4 col-lg-4 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Day 12</label>
                                <select  aria-label="Select Day 12 Time" id="day_12" name="day_12" data-control="select2" data-placeholder="Select Day 12 Tim" class="form-select form-select-lg">
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
                            <div class="col-md-4 col-sm-4 col-lg-4 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Day 13</label>
                                <select  aria-label="Select Day 13 Time" id="day_13" name="day_13" data-control="select2" data-placeholder="Select Day 13 Tim" class="form-select form-select-lg">
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

                        <div class="row fv-plugins-icon-container">
                            <div class="col-md-4 col-sm-4 col-lg-4 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Day 14</label>
                                <select  aria-label="Select Day 14 Time" id="day_14" name="day_14" data-control="select2" data-placeholder="Select Day 14 Tim" class="form-select form-select-lg">

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
                            <div class="col-md-4 col-sm-4 col-lg-4 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Day 15</label>
                                <select  aria-label="Select Day 15 Time" id="day_15" name="day_15" data-control="select2" data-placeholder="Select Day 15 Tim" class="form-select form-select-lg">
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
                            <div class="col-md-4 col-sm-4 col-lg-4 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Day 16</label>
                                <select  aria-label="Select Day 16 Time" id="day_16" name="day_16" data-control="select2" data-placeholder="Select Day 16 Tim" class="form-select form-select-lg">
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

                        <div class="row fv-plugins-icon-container">
                            <div class="col-md-4 col-sm-4 col-lg-4 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Day 17</label>
                                <select  aria-label="Select Day 17 Time" id="day_17" name="day_17" data-control="select2" data-placeholder="Select Day 17 Tim" class="form-select form-select-lg">

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
                            <div class="col-md-4 col-sm-4 col-lg-4 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Day 18</label>
                                <select  aria-label="Select Day 18 Time" id="day_18" name="day_18" data-control="select2" data-placeholder="Select Day 18 Tim" class="form-select form-select-lg">
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
                            <div class="col-md-4 col-sm-4 col-lg-4 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Day 19</label>
                                <select  aria-label="Select Day 19 Time" id="day_19" name="day_19" data-control="select2" data-placeholder="Select Day 19 Tim" class="form-select form-select-lg">
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

                        <div class="row fv-plugins-icon-container">
                            <div class="col-md-4 col-sm-4 col-lg-4 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Day 20</label>
                            <select  aria-label="Select Day 20 Time" id="day_20" name="day_20" data-control="select2" data-placeholder="Select Day 20 Time" class="form-select form-select-lg">
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




           $('.add-buddy-downtime').on('click',function(){
            $('#kt_modal_edit_downtime_submit').show();
            $('#kt_modal_edit_downtime_update').hide();
              var buddyId = $('#buddy_id').val('');
              var url = "{{ url('buddy-downtime-process') }}"+'/'+buddyId;
               $.get("{{ url('get-location') }}",function(response){
                    $.each(response.lists, function(val, text){
                          $('#location').append(
                            $("<option></option>").val(text.id).html(text.location)
                          );
                    });
                 });
             });



        $('.edit-buddy-downtime').on('click',function(){
            $('#kt_modal_edit_downtime_submit').hide();
            $('#kt_modal_edit_downtime_update').show();
            var buddyId = $(this).attr('id');
            var url = "{{ url('ojt-downtime-process') }}"+'/'+buddyId;
            $.get("{{ url('get-location') }}",function(response){
                $.each(response.lists, function(val, text){
                      $('#location').append(
                        $("<option></option>").val(text.id).html(text.location)
                      );
                });
            });
            $.get(url,function(response){

                    $('#location').val(response.editrow.locationid).select2();
                    $('#process').val(response.editrow.processid).select2();
                    $('#training_days').val(response.editrow.training_days);
                    $('#ojt_time').val(response.editrow.ojt_days);
                    $('#total_time').val(response.editrow.client_time_ttl);
                    $('#client_training').val(response.editrow.client_training).select2();
                    $('#buddyprocess').val(response.editrow.cm_id).select2();
                    $('#min_time').val(response.editrow.client_time_min).select2();
                    $('#max_time').val(response.editrow.client_time_max).select2();
                    $('#day_1').val(response.editrow.ojt_day_1).select2();
                    $('#day_2').val(response.editrow.ojt_day_2).select2();
                    $('#day_3').val(response.editrow.ojt_day_3).select2();
                    $('#day_4').val(response.editrow.ojt_day_4).select2();
                    $('#day_5').val(response.editrow.ojt_day_5).select2();
                    $('#day_6').val(response.editrow.ojt_day_6).select2();
                    $('#day_7').val(response.editrow.ojt_day_7).select2();
                    $('#day_8').val(response.editrow.ojt_day_8).select2();
                    $('#day_9').val(response.editrow.ojt_day_9).select2();
                    $('#day_10').val(response.editrow.ojt_day_10).select2();
                    $('#day_11').val(response.editrow.ojt_day_11).select2();
                    $('#day_12').val(response.editrow.ojt_day_12).select2();
                    $('#day_13').val(response.editrow.ojt_day_13).select2();
                    $('#day_14').val(response.editrow.ojt_day_14).select2();
                    $('#day_15').val(response.editrow.ojt_day_15).select2();
                    $('#day_16').val(response.editrow.ojt_day_16).select2();
                    $('#day_17').val(response.editrow.ojt_day_17).select2();
                    $('#day_18').val(response.editrow.ojt_day_18).select2();
                    $('#day_19').val(response.editrow.ojt_day_19).select2();
                    $('#day_20').val(response.editrow.ojt_day_20).select2();

                });
         });

});
</script>

