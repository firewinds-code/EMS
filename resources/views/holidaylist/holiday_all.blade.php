@extends('includes.master')
@section('content')
@section('page-title', 'Holiday')
@section('page-heading', 'Holiday List')
<div id="kt_app_content_container" class="app-container container-xxl">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row g-5 g-xl-10 mb-xl-10">

                        @foreach ($holidaydetails as $ho_list)
                            <!--begin::Col-->
                            <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-3 mb-md-5 mb-xl-10 ">
                                {{-- <div class="card cardheight "> --}}
                                <div class="card cardOutline ">
                                    <div class="card h-md-20">
                                        <!--begin::Card header-->
                                        <div class="card-header position-relative py-7 border-bottom-1">
                                            <!--begin::Card title-->
                                            <h3 class="fw-semibold text-gray-800 text-center "style="margin: auto;">
                                                {{ date('d', strtotime($ho_list->DateOn)), date('F,Y', strtotime($ho_list->DateOn)) }}
                                                {{ date('F,Y', strtotime($ho_list->DateOn)) }}</h3>
                                            <!--end::Card title-->
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pb-0">
                                            <p class="text-center">
                                                {{ date('F,Y', strtotime($ho_list->DateOn)) }}</p>
                                            <p class="text-center">{{ $ho_list->Reason }}</p>
                                            <b>
                                                <p class="text-center fs-md-9">
                                                    <span>Associates :</span>
                                                    {{ $ho_list->Associates }} | <span>Support :</span>
                                                    {{ $ho_list->Support }}
                                                </p>
                                            </b>
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                </div>
                                {{-- </div> --}}
                            </div>
                        @endforeach

                    </div>
                    <b>
                        <p class="text-danger">Note:</p>
                    </b>
                    <p class="text-danger"><i class="fa fa-circle"></i> Employees
                        who works on above mention days will get mentioned benefits</p>
                    <p class="text-danger"><i class="fa fa-circle"></i> **
                        &ldquo;HO&rdquo; needs to be uploaded in roster if process is non-operational or
                        employee is on provided holiday</p>
                </div>
            </div>
        </div>
    @endsection
