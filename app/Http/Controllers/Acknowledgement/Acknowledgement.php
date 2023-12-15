<?php

namespace App\Http\Controllers\Acknowledgement;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\PersonalDetails;
use App\Models\Acknowladge\WeeklyCovid;








class Acknowledgement extends Controller
{
   public function viewCovidAcknowledge()
   {
      try {
         $userData = session("userDetails");
         $location = PersonalDetails::where('EmployeeID', $userData[0]['EmployeeID'])->value('location');
         return view('ack.weekly_ack_covid19_form', [
            'location' => $location,
         ]);
      } catch (\Exception $e) {
         return response()->json(['error' => $e->getMessage()], 500);
      }
   }



   public function createWeeklyCovidAcknowledge(Request $request)
   {
      try {
         $userData = session("userDetails");
         $validator = Validator::make($request->all(), [
            'mobileNo' => 'required',
            'address' => 'required',
         ]);

         if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
         } else {
            $currentMondayDate = Carbon::now()->startOfWeek()->format('Y-m-d');
            $covidForms = WeeklyCovid::select('createdOn')
               ->where('EmployeeID', $userData[0]['EmployeeID'])
               ->whereDate('createdOn', '>=', $currentMondayDate)
               ->whereDate('createdOn', '<=', Carbon::now())
               ->get();
            if ($covidForms->count() < 1) {
               WeeklyCovid::create([
                  "EmployeeID" => $userData[0]['EmployeeID'],
                  "Employeename" => $userData[0]['EmployeeName'],
                  "EmpMobile" => $request->mobileNo,
                  "empAddress" => $request->address
               ]);
               return view('dashboard');
            } else {
               return redirect()->back()->withInput()->with('error', "Allready acknowledged in this week");
            }
         }
      } catch (\Exception $e) {
         return response()->json(['error' => $e->getMessage()], 500);
      }
   }
}
