@extends('includes.master')
@section('content')
@section('page-title', 'Birthday')
@section('page-heading', 'Birthday List')
<div id="kt_app_content_container" class="app-container container-xxl">
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-body">
               <div class="row g-5 g-xl-10 mb-xl-10">

                  @foreach ($getBdayData as $b_list)
                  <!--begin::Col-->
                  <div class="col-md-6">
                     <div class="card cardOutline">
                        <div class="card">
                           <!--begin::Card body-->
                           <div class="card-body pb-0 pt-1">
                              <div class="d-flex align-items-center">
                                 <!-- Employee Image -->
                                 <div class="symbol symbol-100px symbol-lg-120px symbol-fixed position-relative mb-4">
                                    <img src="{{ asset('utills/dist/assets/media/avatars/CE10091236.jpg') }}" alt="image" class="Profile Image" style="margin-right: 2rem;height: 9.5rem;">
                                 </div>
                                 <!-- Employee Information Table -->
                                 <table class="table table-row-bordered table-hover gy-2">
                                    <tr>
                                       <td class="fs-7 fw-bold">Name</td>
                                       <td class="fw-semibold fs-7 text-gray-600 text-dark">{{ $b_list->EmployeeName }}</td>
                                    </tr>
                                    <tr>
                                       <td class="fs-7 fw-bold">Client Name</td>
                                       <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{ $b_list->client_name }}</td>
                                    </tr>
                                    <tr>
                                       <td class="fs-7 fw-bold">Process</td>
                                       <td class="fw-semibold fs-7 text-gray-600 text-dark">{{ $b_list->process }}</td>
                                    </tr>
                                    <tr>
                                       <td class="fs-7 fw-bold">Sub Process</td>
                                       <td class="fw-semibold fs-7 text-gray-600 text-dark">{{ $b_list->sub_process }}</td>
                                    </tr>
                                    <tr>
                                       <td class="fs-7 fw-bold">Designation</td>
                                       <td class="fw-semibold fs-7 text-gray-600 text-dark">{{ $b_list->Designation }}</td>
                                    </tr>
                                    <tr>
                                       <td class="fs-7 fw-bold">Location</td>
                                       <td class="fw-semibold fs-7 text-gray-600 text-dark">{{ $b_list->locname }}</td>
                                    </tr>
                                    <!-- Add more information here -->
                                 </table>
                              </div>
                           </div>
                           <!--end::Card body-->
                        </div>
                     </div>
                  </div>
                  <!--end::Col-->
                  @endforeach



               </div>
            </div>
         </div>
      </div>
      @endsection