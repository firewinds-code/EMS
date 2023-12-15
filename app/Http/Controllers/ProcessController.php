<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ProcessStatus;
use Carbon\Carbon;

class ProcessController extends Controller
{

     public function  process(Request $request)
       {

        try {
             $process =  DB::select('select client_id,client_master.client_name,process,sub_process,client_status_master.id,new_client_master.cm_id,t1.location  from new_client_master inner join client_master on client_master.client_id = new_client_master.client_name left outer join client_status_master on new_client_master.cm_id = client_status_master.cm_id join location_master t1 on new_client_master.location=t1.id');
             return view('process.list',compact('process'));
            } catch (\Exception $ex) {
             return view('process.list')->with(['error', 'Something Went Wrong !']);
            }
       }


       public function updateProcessStatus(Request $request)
       {

       try {



         if(isset($request->client) && $request->status == '1')
        {
             $updateProcess =  ProcessStatus::where('cm_id', $request->client)->delete();
              return response()->json(['success' => true, 'message' => 'Process  Status Activated Successfully !']);
        }

        if(isset($request->client) && $request->status == '0')
        {
           $process = ['createdon' => Carbon::now() , 'cm_id' => $request->client ];
            $exist  = ProcessStatus::where('cm_id', $request->client)->exists();
            if(!$exist)
           {
            $updateProcess =  ProcessStatus::insert($process);




            
            return response()->json(['success' => true, 'message' => 'Process  Status  In-Activated Successfully !']);
           }
           return response()->json(['success' => true, 'message' => 'Process  Status  Already In-Activated !']);
        }
        return response()->json(['error' => true, 'message' => 'Process Updated Failed !']);

       } catch (\Exception  $ex) {

        dd($ex->getMessage());

        \Log::info($ex->getMessage());
        return response()->json(['error' => true, 'message' => 'Something went wrong !']);

       }

     }


     public function editProcess($cmid)
     {
        $status = 0;
        $active = ProcessStatus::where('cm_id', $cmid)->exists();
        if($active)
        {
            $status = 1;
            return response()->json(['success' => true ,'html' => view('ajax.process.edit',compact('cmid','status'))->render()]);
        }
        return response()->json(['success' => true ,'html' => view('ajax.process.edit',compact('cmid','status'))->render()]);

     }

}
