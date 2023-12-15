@if($type ==='profileDetails')
<table class="table table-row-bordered table-hover gy-2">
   <tbody>
      <tr>
         <td class="fs-7 fw-bold">Name</td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$getData->EmployeeName}}</td>
      </tr>
      <tr>
         <td class="fs-7 fw-bold">Date Of Birth</td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$getData->DOB}}</td>
      </tr>
      <tr>
         <td class="fs-7 fw-bold">Father`s Name</td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$getData->FatherName}}</td>
      </tr>
      <tr>
         <td class="fs-7 fw-bold">Mother`s Name</td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$getData->MotherName}}</td>
      </tr>
      <tr>
         <td class="fs-7 fw-bold">Gender</td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$getData->Gender}}</td>
      </tr>
      <tr>
         <td class="fs-7 fw-bold">Blood Group</td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$getData->BloodGroup}}</td>
      </tr>
      <tr>
         <td class="fs-7 fw-bold">ESIS No</td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$getData->esi_no}}</td>
      </tr>
      <tr>
         <td class="fs-7 fw-bold">Marital Status</td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$getData->MarriageStatus}}</td>
      </tr>
      <tr>
         <td class="fs-7 fw-bold">Spouse</td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$getData->Spouse}}</td>
      </tr>
      <tr>
         <td class="fs-7 fw-bold">Marriage Date</td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$getData->MarriageDate}}</td>
      </tr>
      <tr>
         <td class="fs-7 fw-bold">Child Status</td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$getData->ChildStatus}}</td>
      </tr>
   </tbody>
</table>
@endif


@if ($type === 'contectDetails')
<div>
   <table class="table table-row-bordered table-hover gy-2">
      <tbody>
         <tr>
            <td class="fs-7 fw-bold">Mobile No</td>
            <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$getData->mobile}}</td>
         </tr>
         <tr>
            <td class="fs-7 fw-bold">Alternate No</td>
            <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$getData->altmobile}}</td>
         </tr>
         <tr>
            <td class="fs-7 fw-bold">Email ID</td>
            <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$getData->emailid}}</td>
         </tr>
      </tbody>
   </table>
</div>
@endif


@if($type ==='documents')

<table class="table table-row-bordered table-hover gy-2">
   <thead>
      <tr class="fw-semibold fs-7 text-gray-800 border-bottom-2 border-gray-200">
         <th>Document Type</th>
         <th>Document List</th>
         <th>Document ID</th>
      </tr>
   </thead>
   <tbody>
      @if ($DocsData->isNotEmpty())
      @foreach ($DocsData as $empDocs)
      <tr>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$empDocs->doc_type}}</td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$empDocs->doc_stype}}</td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$empDocs->dov_value}}</td>
      </tr>
      @endforeach
      @endif
   </tbody>
</table>
@endif



@if ($type ==='addressDetails')
<table class="table table-row-bordered table-hover gy-2">
   <tbody>
      <tr>
         <h3 class="text-dark">Current Address</h3>
      </tr>
      <tr>
         <td class="fs-7 fw-bold">Address</td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$getData->address}}</td>
      </tr>
      <tr>
         <td class="fs-7 fw-bold">Country</td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$getData->country}}</td>
      </tr>
      <tr>
         <td class="fs-7 fw-bold">State</td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$getData->state}}</td>
      </tr>
      <tr>
         <td class="fs-7 fw-bold">District</td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$getData->district}}</td>
      </tr>
      <tr>
         <td class="fs-7 fw-bold">City</td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$getData->city}}</td>
      </tr>
      <tr>
         <td class="fs-7 fw-bold">Tehsil</td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$getData->tehsil}}</td>
      </tr>
      <tr>
         <td class="fs-7 fw-bold">Landmark</td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$getData->other}}</td>
      </tr>
      <tr>
         <td class="fs-7 fw-bold">Pin Code</td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$getData->zip}}</td>
      </tr>
   </tbody>
</table>
<table class="table table-row-bordered table-hover gy-2">
   <tbody>
      <tr>
         <h3 class="text-dark">Permanent Address</h3>
      </tr>
      <tr>
         <td class="fs-7 fw-bold">Address</td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$getData->address_p}}</td>
      </tr>
      <tr>
         <td class="fs-7 fw-bold">Country</td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$getData->country_p}}</td>
      </tr>
      <tr>
         <td class="fs-7 fw-bold">State</td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$getData->state_p}}</td>
      </tr>
      <tr>
         <td class="fs-7 fw-bold">District</td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$getData->district_p}}</td>
      </tr>
      <tr>
         <td class="fs-7 fw-bold">City</td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$getData->city_p}}</td>
      </tr>
      <tr>
         <td class="fs-7 fw-bold">Tehsil</td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$getData->tehsil_p}}</td>
      </tr>
      <tr>
         <td class="fs-7 fw-bold">Landmark</td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$getData->other_p}}</td>
      </tr>
      <tr>
         <td class="fs-7 fw-bold">Pin Code</td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$getData->zip_p}}</td>
      </tr>
   </tbody>
</table>
@endif




@if ($type ==='EducationDetails')
<div class="table-responsive">
   <table class="table table-row-bordered table-hover gy-2">
      <thead>
         <tr class="fw-semibold fs-7 border-bottom-2 border-gray-200">
            <th>Education Level</th>
            <th>Education Name</th>
            <th>Specialization</th>
            <th>Board/Univercity</th>
            <th>College</th>
            <th>Type</th>
            <th>PassingYear</th>
            <th hidden>Division</th>
            <th hidden>Percentage</th>
            <th hidden>EduFile</th>
         </tr>
      <tbody>
         </thead>
      <tbody>
         @if ($EduData->isNotEmpty())
         @foreach ($EduData as $EduData)
         <tr>
            <td class="fw-semibold fs-8 mt-4 text-gray-600 text-dark">{{$EduData->edu_level}}</td>
            <td class="fw-semibold fs-8 mt-4 text-gray-600 text-dark">{{$EduData->edu_name}}</td>
            <td class="fw-semibold fs-8 mt-4 text-gray-600 text-dark">{{$EduData->specialization}}</td>
            <td class="fw-semibold fs-8 mt-4 text-gray-600 text-dark">{{$EduData->board}}</td>
            <td class="fw-semibold fs-8 mt-4 text-gray-600 text-dark">{{$EduData->college}}</td>
            <td class="fw-semibold fs-8 mt-4 text-gray-600 text-dark">{{$EduData->edu_type}}</td>
            <td class="fw-semibold fs-8 mt-4 text-gray-600 text-dark">{{$EduData->passing_year}}</td>
            <td class="fw-semibold fs-8 mt-4 text-gray-600 text-dark" hidden>{{$EduData->division}}</td>
            <td class="fw-semibold fs-8 mt-4 text-gray-600 text-dark" hidden>{{$EduData->percentage}}</td>
            <td class="fw-semibold fs-8 mt-4 text-gray-600 text-dark" hidden>{{$EduData->edu_file}}</td>
         </tr>
         @endforeach
         @endif
      </tbody>
   </table>
</div>
@endif


@if ($type ==='ExperinceDetails')
<div class="table-responsive">
   <table class="table table-row-bordered table-hover gy-2">
      <thead>
         <tr class="fw-semibold fs-7 border-bottom-2 border-gray-200">
            <th>Exp Type</th>
            <th>Organization</th>
            <th>Location</th>
            <th>From</th>
            <th>To</th>
            <th>Designation</th>
            <th>Last Drawn CTC(Monthly)</th>
         </tr>
      <tbody>
         </thead>
      <tbody>
         @if ($expData->isNotEmpty())
         @foreach ($expData as $expData)
         <tr>
            @if($expData->exp_type ==='Fresher')
            <td class="fw-semibold fs-8 mt-4 text-gray-600 text-dark">{{$expData->exp_type}}</td>
            @else
            <td class="fw-semibold fs-8 mt-4 text-gray-600 text-dark">{{$expData->exp_type}}</td>
            <td class="fw-semibold fs-8 mt-4 text-gray-600 text-dark">{{$expData->employer}}</td>
            <td class="fw-semibold fs-8 mt-4 text-gray-600 text-dark">{{$expData->location}}</td>
            <td class="fw-semibold fs-8 mt-4 text-gray-600 text-dark">{{$expData->from}}</td>
            <td class="fw-semibold fs-8 mt-4 text-gray-600 text-dark">{{$expData->to}}</td>
            <td class="fw-semibold fs-8 mt-4 text-gray-600 text-dark">{{$expData->designation}}</td>
            <td class="fw-semibold fs-8 mt-4 text-gray-600 text-dark">{{$expData->discription}}</td>
            @endif
         </tr>
         @endforeach
         @endif
      </tbody>
   </table>
</div>
@endif

@if($type ==='employeeMap')
<table class="table table-row-bordered table-hover gy-2">
   <tbody>
      <tr>
         <td class="fs-7 fw-bold">Department</td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$getData->dept}}</td>
      </tr>
      <tr>
         <td class="fs-7 fw-bold">Client</td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$getData->client_name}}</td>
      </tr>
      <tr>
         <td class="fs-7 fw-bold">Process</td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$getData->process}}</td>
      </tr>
      <tr>
         <td class="fs-7 fw-bold">SubProcess</td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$getData->sub_process}}</td>
      </tr>
      <tr>
         <td class="fs-7 fw-bold">Designation</td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$getData->Designation}}</td>
      </tr>
      <tr>
         <td class="fs-7 fw-bold">Date Of Joining</td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$getData->dateofjoin}}</td>
      </tr>
      <tr>
         <td class="fs-7 fw-bold">Function</td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$getData->function}}</td>
      </tr>
      @if($getData->df_id !=='74' && $getData->df_id !=='77' && $getData->df_id !=='146' && $getData->df_id !=='147' && $getData->df_id !=='148' && $getData->df_id !=='149')
      <tr>
         <td class="fs-7 fw-bold">Appraisal Month</td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$getData->AppraisalMonth}}</td>
      </tr>
      @endif
   </tbody>
</table>
@endif



@if($type === 'ManagementContectDetails')
<table class="table table-row-bordered gy-3 table-hover">
   <tbody>
      <tr>
         <td class="fs-7 fw-bold">
            {{$n1}}
         </td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">
            <img src="{{ asset('utills/dist/assets/media/avatars/default-small.png') }}" alt="Cercil" class="align-middle me-2" style="height: 36px;">
            {{-- <img src="{{$aimg}}" alt="Cercil" class="align-middle me-2" style="height: 36px;"> --}}

            {{$a}} ({{$b}} )
         </td>
      </tr>
      @if($GenderType ==='FEMALE')
      <tr>
         <td class="fs-7 fw-bold">{{$n2}}</td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">
            <img src="{{ asset('utills/dist/assets/media/avatars/default-small.png') }}" alt="Cercil" class="align-middle me-2" style="height: 36px;">
            {{-- <img src="{{ $cimg}}" alt="Cercil" class="align-middle me-2" style="height: 36px;"> --}}
            {{$c}} ({{$d}} )
         </td>
      </tr>
      @endif
      <tr>
         <td class="fs-7 fw-bold">{{$n3}}</td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">
            <img src="{{ asset('utills/dist/assets/media/avatars/default-small.png') }}" alt="Cercil" class="align-middle me-2" style="height: 36px;">
            {{-- <img src="{{$$eimg }}" alt="Cercil" class="align-middle me-2" style="height: 36px;"> --}}
            {{$e}} ({{$f}} )
         </td>
      </tr>
      @if (!empty($sitespocMobile))
      <tr>
         <td class="fs-7 fw-bold">Site Spoc</td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">
            <img src="{{ asset('utills/dist/assets/media/avatars/default-small.png') }}" alt="Cercil" class="align-middle me-2" style="height: 36px;">
            {{-- <img src={{$sitespocimg}} alt="Cercil" class="align-middle me-2" style="height: 36px;"> --}}
            {{$s}} ({{$sitespocMobile}} )
         </td>
      </tr>
      @endif
   </tbody>
</table>
@endif

@if($type ==='reportingMap')
<table class="table table-row-bordered gy-3 table-hover">
   <tbody>
      <tr>
         <td class="fs-7 fw-bold">
            Reporting
         </td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">
            <img src="{{ $imsrc_rt }}" alt="Cercil" class="align-middle me-2" style="height: 36px;">
            {{$RT}} ({{$contact_rt}})
         </td>
      </tr>
      <tr>
         <td class="fs-7 fw-bold">
            Account Head
         </td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">
            <img src="{{ $imsrc_ah }}" alt="Cercil" class="align-middle me-2" style="height: 36px;">
            {{$AH}} ({{$contact_ah}})
         </td>
      </tr>

      <tr>
         <td class="fs-7 fw-bold">
            Process Head
         </td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">
            <img src="{{ $imsrc_ph }}" alt="Cercil" class="align-middle me-2" style="height: 36px;">
            {{$PH}} ({{$contact_ph}})
         </td>
      </tr>

      <tr>
         <td class="fs-7 fw-bold">
            Vertical Head
         </td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">
            <img src="{{ $imsrc_vh}}" alt="Cercil" class="align-middle me-2" style="height: 36px;">
            {{$VH}} ({{$contact_vh}})
         </td>
      </tr>
      @if(isset($QA_OPS))
      <tr>
         <td class="fs-7 fw-bold">
            QA OPS
         </td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">
            <img src="{{ $imsrc_vh}}" alt="Cercil" class="align-middle me-2" style="height: 36px;">
            {{$QA_OPS}}
         </td>
      </tr>
      @endif

      @if(isset($OH))
      <tr>
         <td class="fs-7 fw-bold">
            Opration Head
         </td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">
            <img src="{{ $imsrc_oh}}" alt="Cercil" class="align-middle me-2" style="height: 36px;">
            {{$OH}} ({{$contact_oh}})
         </td>
      </tr>
      @endif


      @if(isset($OH))
      <tr>
         <td class="fs-7 fw-bold">
            Quilty Head
         </td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">
            <img src="{{ $imsrc_qh}}" alt="Cercil" class="align-middle me-2" style="height: 36px;">
            {{$QH}} ({{$contact_qh}})
         </td>
      </tr>
      @endif


      @if(isset($TH))
      <tr>
         <td class="fs-7 fw-bold">
            Quilty Head
         </td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">
            <img src="{{ $imsrc_th}}" alt="Cercil" class="align-middle me-2" style="height: 36px;">
            {{$TH}} ({{$contact_th}})
         </td>
      </tr>
      @endif

   </tbody>
</table>
@endif

@if($type === 'processMap')
<table class="table table-row-bordered gy-3 table-hover">
   <tbody>
      <tr>
         <td class="fs-7 fw-bold">
            {{$rtDesignation}}
         </td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">
            <img src="{{ asset('utills/dist/assets/media/avatars/default-small.png') }}" alt="Cercil" class="align-middle me-2" style="height: 36px;">
            {{-- <img src="{{$aimg}}" alt="Cercil" class="align-middle me-2" style="height: 36px;"> --}}

            {{$rtName}} ({{$contact_rt_mobile}} )
         </td>
      </tr>

      <tr>
         <td class="fs-7 fw-bold">
            {{$rrdesignation}}
         </td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">
            <img src="{{ asset('utills/dist/assets/media/avatars/default-small.png') }}" alt="Cercil" class="align-middle me-2" style="height: 36px;">
            {{-- <img src="{{$aimg}}" alt="Cercil" class="align-middle me-2" style="height: 36px;"> --}}

            {{$rrtname}} ({{$contact_rrt_mobile}} )
         </td>
      </tr>
      @if(isset($isvalid))
      <tr>
         <td class="fs-7 fw-bold">
            {{$rrrdesignation}}
         </td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">
            <img src="{{ asset('utills/dist/assets/media/avatars/default-small.png') }}" alt="Cercil" class="align-middle me-2" style="height: 36px;">
            {{-- <img src="{{$aimg}}" alt="Cercil" class="align-middle me-2" style="height: 36px;"> --}}

            {{$rrrtname}} ({{$contact_rrrt_mobile}} )
         </td>
      </tr>
      @endif
   </tbody>
</table>
@endif


@if ($type ==='WarnDocs')
@if(isset($isvalid))

<div class="table-responsive">
   <table class="table table-row-bordered table-hover gy-2">
      <thead>
         <tr class="fw-semibold fs-7 border-bottom-2 border-gray-200">
            <th colspan=2>Warning and Refer to HR Letter</th>
            <th>Issued</th>
            <th>Document</th>
            <th>Action</th>
         </tr>
         <tr>
            <th>Type</th>
            <th>Sub Type</th>
            <th>Date</th>
            <th>Name</th>
            <th>Download </th>
         </tr>
      </thead>
      <tbody>
         @if ($getData->isNotEmpty())
         @foreach ($getData as $getData)
         <tr>
            <td class="fw-semibold fs-8 mt-4 text-gray-600 text-dark">{{$getData->ah_status}}</td>
            <td class="fw-semibold fs-8 mt-4 text-gray-600 text-dark">{{$getData->ah_subtype}}</td>
            <td class="fw-semibold fs-8 mt-4 text-gray-600 text-dark">{{$getData->ah_Datetime}}</td>
            <td class="fw-semibold fs-8 mt-4 text-gray-600 text-dark">{{$getData->Title}}</td>
            <td class="fw-semibold fs-8 mt-4 text-gray-600 text-dark">{{$getData->Document}}</td>
         </tr>
         @endforeach
         @endif
      </tbody>
   </table>
</div>
@else
<h4>No Data Found </h4>
@endif
@endif













@if($type ==='BankPF')
<table class="table table-row-bordered table-hover gy-2">
   <tbody>
      @if ((float)$getData->ctc1 < 21050) <tr>
         <td class="fs-7 fw-bold">ESIC Number</td>
         <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$getData->esi_no}}</td>
         </tr>
         @endif

         @if (strtoupper($getData->pf_status) == 'YES')
         <tr>
            <td class="fs-7 fw-bold">UAN Number</td>
            <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$getData->uan_no}}</td>
         </tr>
         @endif

         <tr>
            <td class="fs-7 fw-bold">Bank Name</td>
            <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$getData->BankName}}</td>
         </tr>
         <tr>
            <td class="fs-7 fw-bold">Bank Account Number</td>
            <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$getData->AccountNo}}</td>
         </tr>
         <tr>
            <td class="fs-7 fw-bold">Name as per Bank</td>
            <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$getData->Name}}</td>
         </tr>
         <tr>
            <td class="fs-7 fw-bold">IFSC</td>
            <td class="fw-semibold fs-7 mt-4 text-gray-600 text-dark">{{$getData->IFSC}}</td>
         </tr>
   </tbody>
</table>
@endif