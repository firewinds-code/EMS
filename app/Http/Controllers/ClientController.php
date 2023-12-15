<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\BackgroundVerification;
use App\Models\NewClientMaster;
use Session;
use App\Models\ClientMaster;
use App\Models\ProcessMap;
use App\Models\DowntimeRequest;
use Carbon\Carbon;
class ClientController extends Controller
{

    public $bgverification;

    public $newClient;

    public $clientMaster;

    public function __construct(BackgroundVerification $bgverification,NewClientMaster $newClient,
    ClientMaster $clientMaster,ProcessMap $processMap, DowntimeRequest $downTimeRequest)
     {
     $this->bgverification = $bgverification;
     $this->newClient = $newClient;
     $this->clientMaster = $clientMaster;
     $this->processMap = $processMap;
     $this->downTimeRequest = $downTimeRequest;
     }

   public function  clients(Request $request)
    {
             $clients = DB::select('call select_client()');
             return view('clients.list',compact('clients'));
    }




     public function getDropdown($type,$location)
     {

        if ($type == "ah") {

            $sql = 'SELECT personal_details.EmployeeID,personal_details.EmployeeName FROM employee_map left outer join personal_details on employee_map.EmployeeID=personal_details.EmployeeID  left outer join df_master on employee_map.df_id=df_master.df_id left outer join designation_master on designation_master.ID=df_master.des_id where   emp_status="Active" and location= '.$location.'  and emp_status="Active" and ((Designation like "%Manager%") or Designation in ("Business Analyst","Director","Vice President","Assistant Vice President","Chief Executive Officer","OSD")) and personal_details.EmployeeID is not null Union select "CE03070003" as EmployeeID, "Sachin Siwach" as EmployeeName
            Union select "CE07147134" as EmployeeID, "Nitin Sahni" as EmployeeName order by EmployeeName';
            $statement =  DB::select($sql);

        } else if ($type == "vh") {
            $sql = 'SELECT personal_details.EmployeeID,personal_details.EmployeeName FROM employee_map left outer join personal_details on employee_map.EmployeeID=personal_details.EmployeeID  left outer join df_master on employee_map.df_id=df_master.df_id left outer join designation_master on designation_master.ID=df_master.des_id where   emp_status="Active" and emp_status="Active" and ((Designation like "%Manager%") or Designation in ("Business Analyst","Director","Vice President","Assistant Vice President","Chief Executive Officer","OSD")) and personal_details.EmployeeID is not null Union select "CE03070003" as EmployeeID, "Sachin Siwach" as EmployeeName
            Union select "CE07147134" as EmployeeID, "Nitin Sahni" as EmployeeName order by EmployeeName';
            $statement =  DB::select($sql);

        } else if ($type == "hr") {
            $sql = 'select EmployeeID,EmployeeName from whole_details_peremp where sub_process like"Human Resource%" and location= '.$location.' ';
            $statement =  DB::select($sql);

        } else if ($type == "excep") {
            $sql = "select t2.EmployeeID,trim(t2.EmployeeName) as EmployeeName from employee_map t1 join personal_details t2 on t1.EmployeeID=t2.EmployeeID where t1.emp_status='Active' and df_id not in (74,77) order by trim(t2.EmployeeName)";
            $statement =  DB::select($sql);

        } else if ($type == "site") {
            $sql = "select distinct(t2.EmpName) as EmployeeName, t1.EmployeeID from employee_map as t1 join EmpID_Name as  t2 on t1.EmployeeID=t2.EmpID
             where loc= $location and emp_status='Active' and df_id not in (74,77) order by EmpName";
            $statement =  DB::select($sql);

        }

        return $statement;
     }





    public function getOtherField($location, $type)
    {

        try {
            $statement = $this->getDropdown($type, $location);
            return response()->json(['statement' => $statement,  'success' => true, 'status' => 200]);
            //return response()->json(['html' => view('ajax.clients.dropdown',compact('statement'))->render(),'status' => 200 , 'success' => true]);
            } catch (\Exception $ex) {
             return response()->json(['status' => 502 , 'error' => true]);
           }

   }

   public function getDepartment(Request $request)
   {
                       $query = "select dept_id,dept_name from dept_master";
                       $department  = DB::select($query);
                       if(!empty($department))
                       {
                          return response()->json(['department' => $department,  'success' => true, 'status' => 200]);
                        //  return response()->json(['html' => view('ajax.clients.dropdown',compact('department'))->render(), 'success' => true, 'status' => 200]);
                       }
                       return response()->json(['error' => true, 'status' => 502]);
  }


  public function saveNewClient(Request $request)
  {
       DB::beginTransaction();

        try {

            $row = $this->clientMaster::where('client_name', $request->clients)->first();
            $clientids = isset($row) ? $row->client_id : 0;
            $processExist = $this->newClient::where('process', $request->process_name)->where('client_name', $clientids)->exists();
            if($processExist)
            {
                return response()->json(['error' => true, 'message' => 'Client Name already Exists In our Records']);
            }


            $exist = $this->clientMaster::where('client_name',$request->clients)->exists();
            if($exist){
                $row = $this->clientMaster::where('client_name',$request->clients)->select('client_id')->first();
                $clientId = $row->client_id;
            }else{
                $clientId = $this->clientMaster::insertGetId(['client_name' => $request->clients ,'createdby' => Session::get('EmployeeID')]);
            }
        $clientData = [
        'client_name' => $clientId,
        'account_head' => isset($request->account_head) ? trim($request->account_head) : null,
        'dept_id' => isset($request->department) ? trim($request->department) : null,
        'process' => isset($request->process_name) ? trim($request->process_name) : null,
        'oh' => isset($request->operation_head) ? trim($request->operation_head) : null,
        'qh' => isset($request->quality_head) ? trim($request->quality_head) : null,
        'th' => isset($request->training_head) ? trim($request->training_head) : null,
        'er_scop'=> isset($request->er_spoc) ? trim($request->er_spoc) : null,
        'er_spoc2' => isset($request->er_spoc2) ? trim($request->er_spoc2) : null,
        'er_spoc3' => isset($request->er_spoc3) ? trim($request->er_spoc3) : null,
        'sub_process' => isset($request->sub_process_name) ? trim($request->sub_process_name) : null,
        'SiteSpoc' =>isset($request->site_spoc) ? $request->site_spoc : null,
        'Stipend' => isset($request->Stipen2) ? trim($request->Stipen2) : null,
        'StipendDays' => isset($request->StipendDays) ? trim($request->StipendDays) : null,
        'createdby' => Session::get('EmployeeID'),
        'days_from_joining' => isset($request->induction) ? trim($request->induction) : null,
        'days_from_floor' => isset($request->er_induction) ? trim($request->er_induction) : null,
        'days_of_rotation' => isset($request->er_induction_period) ? trim($request->er_induction_period) : null,
        'VH' => isset($request->vertical_head) ? trim($request->vertical_head) : null,
        'location' => isset($request->location) ? trim($request->location) : null
        ];

        $insertClientProcess =$this->newClient::insert($clientData);
        if($insertClientProcess)
        {

            $cmIdrow = $this->newClient::where(function($query) use ($request,$clientId) {
                $query->where('sub_process', $request->sub_process_name)
                ->where('process', $request->process_name)
                ->where('location', $request->location)
                ->Where('client_name', $clientId);
            })->select('cm_id')->first();

        if(isset($cmIdrow))
        {
            $downTime = ['Process' => isset($request->process_name) ? trim($request->process_name) : null ,
            'SubProcess' => isset($request->sub_process_name) ? trim($request->sub_process_name) : null,
            'QualityID' => isset($request->downtime_quality) ? trim($request->downtime_quality) : null,
            'TrainingID' => isset($request->downtime_training) ? trim($request->downtime_training) : null,
            'OpsID' => isset($request->downtime_ops) ? trim($request->downtime_ops) : null,
            'HRID' => isset($request->hr) ? trim($request->hr) : null,
            'ITID' => isset($request->it) ? trim($request->it) : null,
            'ReportsTo' => isset($request->reports_to) ? trim($request->reports_to) : null,
            'cm_id' => $cmIdrow->cm_id,
            'updated_on' => Carbon::now()];
            $this->downTimeRequest::insert($downTime);
        }


        if($request->process_name != '')
        {
        $process =  $this->processMap::where('process', $request->process_name)->doesntExist();
        if($process)
        {

                    $maxProcess = $this->processMap::max('process_id');
                    $processId = $maxProcess + 1;
                    $process = ['process' => $request->process_name, 'process_name' => $request->process_name ,'process_id' =>$processId ];
                    $this->processMap::insert($process);

        }
        }

        $cmid = $this->newClient::max('cm_id');

       $csaBGv = [
            'cm_id' => $request->cm_id,
            'desig' => 'CSA',
            'Addr' => isset($request->address_for_csa) ? $request->address_for_csa : 'No',
            'Edu' => isset($request->education_for_csa) ? $request->address_for_csa : 'No',
            'Emp'=> isset($request->employment_for_csa) ? $request->employment_for_csa : 'No',
            'Crim' => isset($request->criminal_for_csa) ? $request->criminal_for_csa : 'No'
           ];

        $supportBGv = [
            'cm_id' => $request->cm_id,
            'desig' => 'Support',
            'Addr' => isset($request->address_for_support) ? $request->address_for_support : 'No',
            'Edu' => isset($request->education_for_support) ? $request->education_for_support : 'No',
            'Emp'=> isset($request->employment_for_support) ?$request->employment_for_support : 'No',
            'Crim'=> isset($request->criminal_for_support) ? $request->criminal_for_support : 'No'
            ];

        $inserBGVCSA = BackgroundVerification::insert($csaBGv);
        $inserBGVSUPPORT = BackgroundVerification::insert($supportBGv);
        DB::commit();
        return response()->json(['message' => 'Client Added Successfully !', 'success' => true]);
        }

        DB::rollback();
        return response()->json(['message' => 'Client Details Should not be empty !', 'error' => true]);

        } catch (\Exception $ex) {
            DB::rollback();
            dd($ex->getMessage());
            return response()->json(['message' => 'Something Went Wrong !', 'error' => true]);
         }
    }

    public function editClientDetails($cmId)
     {
        try {
                $clientDetails = $this->newClient::leftjoin('client_master','new_client_master.client_name', 'client_master.client_id')
                ->leftjoin('downtimereqid1', 'new_client_master.cm_id', 'downtimereqid1.cm_id')->where('new_client_master.cm_id',$cmId)->first();
                $background_csa = BackgroundVerification::where('cm_id', $cmId)->where('desig', 'CSA')->first();
                $background_support = BackgroundVerification::where('cm_id', $cmId)->where('desig', 'Support')->first();
                return response()->json(['row' => $clientDetails, 'background_support' => $background_support, 'background_csa' => $background_csa,'success' => true,]);
        } catch (\Exception $ex) {
            dd($ex->getMessage());
            return response()->json(['error' => true,'message' => 'Something Went Wrong !']);
        }

    }


    public function updateClientDetails(Request $request)
    {


        DB::beginTransaction();

        try {

            $row =  $this->newClient::where('cm_id', $request->cm_id)->first();
            $clientId = '';
            $exist = $this->clientMaster::where('client_id', $row->client_name)->exists();
            if($exist){
                $this->clientMaster::where('client_id', $row->client_name)->update(['client_name' => $request->editclientname ,'modifiedby' => Session::get('EmployeeID')]);
            }else{
                $clientId = $this->clientMaster::insertGetId(['client_name' => $request->clients ,'createdby' => Session::get('EmployeeID')]);
            }

            $clientName = isset($clientId) ? $row->client_name : $clientId;

        $clientData = [
        'client_name' => $clientName,
        'account_head' => isset($request->edit_account_head) ? trim($request->edit_account_head) : null,
        'dept_id' => isset($request->edit_department) ? trim($request->edit_department) : null,
        'process' => isset($request->edit_process_name) ? trim($request->edit_process_name) : null,
        'oh' => isset($request->edit_operation_head) ? trim($request->edit_operation_head) : null,
        'qh' => isset($request->edit_quality_head) ? trim($request->edit_quality_head) : null,
        'th' => isset($request->edit_training_head) ? trim($request->edit_training_head) : null,
        'er_scop'=> isset($request->edit_er_spoc) ? trim($request->edit_er_spoc) : null,
        'er_spoc2' => isset($request->edit_er_spoc2) ? trim($request->edit_er_spoc2) : null,
        'er_spoc3' => isset($request->edit_er_spoc3) ? trim($request->edit_er_spoc3) : null,
        'sub_process' => isset($request->edit_sub_process_name) ? trim($request->edit_sub_process_name) : null,
        'SiteSpoc' =>isset($request->edit_site_spoc) ? $request->edit_site_spoc : null,
        'Stipend' => isset($request->edit_Stipen2) ? trim($request->edit_Stipen2) : null,
        'StipendDays' => isset($request->edit_StipendDays) ? trim($request->edit_StipendDays) : null,
        'createdby' => Session::get('EmployeeID'),
        'days_from_joining' => isset($request->edit_induction) ? trim($request->edit_induction) : null,
        'days_from_floor' => isset($request->edit_er_induction) ? trim($request->edit_er_induction) : null,
        'days_of_rotation' => isset($request->edit_er_induction_period) ? trim($request->edit_er_induction_period) : null,
        'VH' => isset($request->edit_vertical_head) ? trim($request->edit_vertical_head) : null,
        'location' => isset($request->editlocation) ? trim($request->editlocation) : null
        ];

        $updateClientProcess =$this->newClient::where('cm_id',$request->cm_id)->update($clientData);

        if($updateClientProcess)
        {

            $downTimeArr = ['Process' => isset($request->edit_process_name) ? trim($request->edit_process_name) : null ,
            'SubProcess' => isset($request->edit_sub_process_name) ? trim($request->edit_sub_process_name) : null,
            'QualityID' => isset($request->edit_downtime_quality) ? trim($request->edit_downtime_quality) : null,
            'TrainingID' => isset($request->edit_downtime_training) ? trim($request->edit_downtime_training) : null,
            'OpsID' => isset($request->edit_downtime_ops) ? trim($request->edit_downtime_ops) : null,
            'HRID' => isset($request->edit_hr) ? trim($request->edit_hr) : null,
            'ITID' => isset($request->edit_it) ? trim($request->edit_it) : null,
            'ReportsTo' => isset($request->edit_reports_to) ? trim($request->edit_reports_to) : null,
            'cm_id' => $request->cm_id,
            'updated_on' => Carbon::now()];

            $downTime = $this->downTimeRequest::where('cm_id', $request->cm_id)->exists();
             if($downTime){

                $this->downTimeRequest::where('cm_id', $request->cm_id)->update($downTimeArr);
             }
             else{
             $this->downTimeRequest::insert($downTimeArr);
             }




        // if($request->process_name != '')
        // {
        // $process =  $this->processMap::where('process', $request->process_name)->doesntExist();
        // if($process)
        // {

        //             $maxProcess = $this->processMap::max('process_id');
        //             $processId = $maxProcess + 1;
        //             $process = ['process' => $request->process_name, 'process_name' => $request->process_name ,'process_id' =>$processId ];
        //             $this->processMap::insert($process);

        // }
        // }


        $csaBGv = [
            'cm_id' => $request->cm_id,
            'desig' => 'CSA',
            'Addr' => isset($request->edit_address_for_csa) ? $request->edit_address_for_csa : 'No',
            'Edu' => isset($request->education_for_csa) ? $request->edit_education_for_csa : 'No',
            'Emp'=> isset($request->edit_employment_for_csa) ? $request->edit_employment_for_csa : 'No',
            'Crim' => isset($request->edit_criminal_for_csa) ? $request->edit_criminal_for_csa : 'No'
           ];

        $supportBGv = [
            'cm_id' => $request->cm_id,
            'desig' => 'Support',
            'Addr' => isset($request->edit_address_for_support) ? $request->edit_address_for_support : 'No',
            'Edu' => isset($request->edit_education_for_support) ? $request->edit_education_for_support : 'No',
            'Emp'=> isset($request->edit_employment_for_support) ?$request->edit_employment_for_support : 'No',
            'Crim'=> isset($request->edit_criminal_for_support) ? $request->edit_criminal_for_support : 'No'
            ];

        $existBGVCSA = BackgroundVerification::where('cm_id',$request->cm_id)->exists();
         if($existBGVCSA){
            $inserBGVCSA = BackgroundVerification::where('cm_id',$request->cm_id)->where('desig','CSA')->update($csaBGv);
         }else{
            $inserBGVCSA = BackgroundVerification::insert($csaBGv);
         }

         $existBGVSUPPORT = BackgroundVerification::where('cm_id',$request->cm_id)->exists();
         if($existBGVSUPPORT){
            $inserBGVSUPPORT = BackgroundVerification::where('cm_id',$request->cm_id)->where('desig','Support')->update($supportBGv);
         }else{
            $inserBGVSUPPORT = BackgroundVerification::insert($supportBGv);
         }


        DB::commit();
        return response()->json(['message' => 'Client Updated Successfully !', 'success' => true]);
        }

        DB::rollback();
        return response()->json(['message' => 'Client Details Should not be empty !', 'error' => true]);

        } catch (\Exception $ex) {
            DB::rollback();
            dd($ex->getMessage());
            return response()->json(['message' => 'Something Went Wrong !', 'error' => true]);
         }



    }

}
