<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OJTDowntime;
use App\Models\LocationMaster;
use Session;

class OJTDowntimeController extends Controller
{


    public function __construct(LocationMaster $location,OJTDowntime $ojtDowntime)
    {
           $this->ojtDowntime = $ojtDowntime;
           $this->location = $location;
    }

   public function list()
   {
     try {
        $lists = $this->ojtDowntime::join('new_client_master','new_client_master.cm_id' , 'downtime_time_master.cm_id')
                              ->join('client_master','new_client_master.client_name', 'client_master.client_id')
                              ->join('location_master', 'location_master.id', 'new_client_master.location')
                            //   ->leftjoin('client_status_master', 'client_status_master.cm_id', 'new_client_master.cm_id')
                            //   ->whereNull('client_status_master.cm_id')
                              ->orderBy('client_master.client_name')
                              ->get();
        return view('downtime.ojtlist',compact('lists'));
        } catch (\Exception $ex) {
            dd($ex->getMessage());
          return view('downtime.ojtlist')->with('error','Data Does Not Exists  Or Soemthing Went Wrong !');
       }
   }


   public function edtDowntimeOjt($id)
   {
    try {
            $editrow = $this->ojtDowntime::join('new_client_master','new_client_master.cm_id' , 'downtime_time_master.cm_id')
            ->join('client_master','new_client_master.client_name', 'client_master.client_id')
            ->join('location_master', 'location_master.id', 'new_client_master.location')
            ->where('downtime_time_master.cm_id', $id)->select('downtime_time_master.cm_id as processid','downtime_time_master.*','location_master.id as locationid')->first();
        return response()->json(['success' => true, 'editrow' => $editrow]);
     } catch (\Exception $ex) {
        return response()->json(['error' => true, 'message'=> 'Data Does Not Exists  Or Soemthing Went Wrong !']);
     }
   }


   public function updateOJtDetails(Request $request)
   {

    try {
        $lists =  $this->location::where('cm_id',$id)->first();
        return view('Ojt.list',compact('lists'));
    } catch (\Exception $ex) {
        return view('Ojt.list')->with('error','Data Does Not Exists  Or Soemthing Went Wrong !');
    }
   }

   public function saveDowntimeOjt(Request $request)
   {

    try {

           $inputData = [
            "cm_id" => $request->process,"training_days" => $request->training_days,"ojt_days" => $request->ojt_time,"client_time_ttl" => $request->total_time,
            "client_training" => $request->client_training, "client_time_min" => $request->min_time, "client_time_max" => $request->max_time,
            "ojt_day_1" => $request->day_1, "ojt_day_2" => $request->day_2, "ojt_day_3" => $request->day_3, "ojt_day_4" => $request->day_4,"ojt_day_5" => $request->day_5,"ojt_day_6" => $request->day_6,"ojt_day_7" => $request->day_7,"ojt_day_8" => $request->day_8,"ojt_day_9" => $request->day_9,
            "ojt_day_10" => $request->day_10,"ojt_day_11" => $request->day_11,"ojt_day_12" => $request->day_12,"ojt_day_13" => $request->day_13,
            "ojt_day_14" => $request->day_14,"ojt_day_15" => $request->day_15,"ojt_day_16" => $request->day_16,"ojt_day_17" => $request->day_17,
            "ojt_day_18" => $request->day_18,"ojt_day_19" => $request->day_19,"ojt_day_20" => $request->day_20 ];

         $checkExists =   $this->ojtDowntime::where('cm_id', $request->process)->exists();
         if($checkExists)
          {
            $inputData['modifiedby'] = Session::get('EmployeeID');
            $update = $this->ojtDowntime::where('cm_id', $request->process)->update($inputData);
            if($update)
            {
                 return response()->json(['success' => true, 'message' => 'OJT Downtime Details Updated Successfully !']);
            }
            return response()->json(['error' => true, 'message' => 'OJT Downtime Details Updated Failed !']);
          }
          else{
            $inputData['createdby'] = Session::get('EmployeeID');
            $inserted = $this->ojtDowntime::insert($inputData);
            if($inserted)
            {
                 return response()->json(['success' => true, 'message' => 'OJT Downtime Details Inserted Successfully !']);
            }
            return response()->json(['error' => true, 'message' => 'OJT Downtime Details Inserted Failed !']);
          }

    } catch (\Exception $ex) {
        return response()->json(['error' => true, 'message' => 'Data Does Not Exists  Or Soemthing Went Wrong  !']);
    }
   }

   public function getLocation()
   {
     try {
           $lists =  $this->location::all();
           return response()->json(['lists' => $lists, 'success' => true]);
      } catch (\Exception $ex) {
        return response()->json(['message' => 'Something Went Wrong !', 'error' => true]);
     }

   }



}
