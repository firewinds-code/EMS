<?php

namespace App\Http\Controllers\Downtime;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DowntimeRequest;
use App\Models\NewClientMaster;
use App\Models\BuddyDowntime;
use Session;
class DowntimeController extends Controller
{


   public function __construct(DowntimeRequest $downtimeRequest, NewClientMaster $newClientMaster, BuddyDowntime $buddyDowntime)
   {
        $this->downtimeRequest = $downtimeRequest;
        $this->newClientMaster = $newClientMaster;
        $this->buddyDowntime = $buddyDowntime;
   }

   public function downtimeList()
   {
    try {
        $lists = $this->downtimeRequest::all();
        return view('downtime.list',compact('lists'));
    } catch (\Exception $ex) {

    }
   }

   public function downtimeEdit($id)
   {
    try {
        $row = $this->downtimeRequest::where('id',$id)->first();
        return  response()->json(['row' =>$row, 'success'=> true]);
    } catch (\Exception $ex) {
        return  response()->json(['message' =>'Something Went Wrong !', 'error'=> true]);
    }
   }

   public function updateDowntime(Request $request)
   {
    try {

        $downTime = [
        "Process" => $request->process,
        "SubProcess" =>$request->sub_process,
        "QualityID" => $request->quality_id,
        "TrainingID" =>$request->training_id,
        "OpsID" =>$request->ops_id,
        "HRID" => $request->hr_id,
        "ITID" => $request->it_id,
        "ReportsTo" => $request->reporting_id];

        $row = $this->downtimeRequest::where('ID',$request->downtime_id)->update($downTime);
        if($row)
        {
            return  response()->json(['success'=> true, 'message' => 'Downtime Details Updated Successfuly !']);
        }
        return  response()->json(['error'=> true, 'message' => 'Downtime Details Updated Failed !']);

    } catch (\Exception $ex) {
        return  response()->json(['message' =>'Something Went Wrong !', 'error'=> true]);
    }

   }

   public function buddyDowntimeList()
   {
    try {
          $buddyList = $this->newClientMaster::join('buddy_dtmatrix', 'new_client_master.cm_id', 'buddy_dtmatrix.cm_id')
                                            ->join('client_master', 'new_client_master.client_name' , 'client_master.client_id')
                                            ->get();
         if(!empty($buddyList)){
              return view('downtime.buddylist',compact('buddyList'));
         }
        return view('downtime.buddylist',compact('buddyList'))->with('error', 'No Data Found');
       } catch (\Exception $ex) {
        return view('downtime.buddylist')->with('error', 'Something Went Wrong !');
       }
   }


   public function buddyDowntimeProcess($id = null)
   {
    try {
          $processList = $this->newClientMaster::join('client_master', 'new_client_master.client_name' , 'client_master.client_id')
                                               ->orderby('client_master.client_name')->get();
          if(!empty($processList) && isset($id)){
              $editRow = $this->buddyDowntime::where('ID',$id)->first();
              return response()->json(['processList' => $processList, 'editRow'=> $editRow, 'success' => true]);
          }
          return response()->json(['processList' => $processList, 'success' => true]);
         return response()->json(['error' => true, 'message' => 'process Does Not Exists !']);
       } catch (\Exception $ex) {
        return response()->json(['error' => true, 'message' => 'Something Went Wrong !']);
       }
   }


   public function saveBuddyDowntime(Request $request)
   {
        try {
              $downTimebuddy = ['cm_id' => $request->buddyprocess , 'Min_Time' => $request->min_time, 'Max_Time' =>  $request->max_time, 'CreatedBy' => Session::get('EmployeeID')];

            if(isset($request->buddy_id))
            {
               $buddyDowntime = $this->buddyDowntime::where(function($query) use ($request){
                $query->where('ID',$request->buddy_id)->where('cm_id', $request->buddyprocess);
                })->update($downTimebuddy);
               if($buddyDowntime)
               {
                   return response()->json(['success'=> true, 'message' => 'Buddy DownTime Updated Successfully !']);
               }
               return response()->json(['error'=> true, 'message' => 'Buddy DownTime Updated Failed !']);
            }
            $buddyDowntime = $this->buddyDowntime::insert($downTimebuddy);
               if($buddyDowntime)
               {
                   return response()->json(['success'=> true, 'message' => 'Buddy DownTime Saved Successfully !']);
               }
               return response()->json(['error'=> true, 'message' => 'Buddy DownTime Saved Failed !']);

        } catch (\Exception $ex) {
            dd($ex->getMessage());
            return response()->json(['error'=> true, 'message' => 'Something Went Wrong!']);
        }

   }

   public function deleteBuddyDownTime($id)
   {

          try{

            $downTimeDelete =  $this->buddyDowntime::where('ID', $id)->delete();
            if($downTimeDelete)
            {
                return response()->json(['success'=> true, 'message' => 'Buddy Down Time Deleted Successfully !']);
            }
            return response()->json(['error'=> true, 'message' => 'Buddy Down Time Deleted Failed !']);
          }catch(\Exception $ex)
          {
            return response()->json(['error'=> true, 'message' => 'Something Went Wrong!']);
          }



   }


}
