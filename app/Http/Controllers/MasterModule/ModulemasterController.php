<?php

namespace App\Http\Controllers\MasterModule;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\Exports\ExportUsers;
use App\Models\ModuleMaster;
use App\Models\ModuleMasterNew;
use Illuminate\Support\Facades\Session;

class ModulemasterController extends Controller
{
  public function addmaster(Request $request)
  {
    try {

      $EmpID = $EmpName = $EmpID2 = $EmpName2 = $EmployeeID = '';
      $processlist = $request->input('listProcess');
      $location = $request->input('location');
      $Process = $request->input('process');
      $Module = $request->input('module');
      $Level = $request->input('level');
      $EmpID1 = $request->input('emp2');

      $EmpID = substr($EmpID1, strpos($EmpID1, "(") + 1, (strpos($EmpID1, ")")) - (strpos($EmpID1, "(") + 1));
      $EmpName = substr($EmpID1, 0, strpos($EmpID1, "(") - 1);


      if ($Level == "2") {
        $EmpID2 = substr($request->input('emp3'), strpos($request->input('emp3'), "(") + 1, (strpos($request->input('emp3'), ")")) - (strpos($request->input('emp3'), "(") + 1));
        $EmpName2 = substr($request->input('emp3'), 0, strpos($request->input('emp3'), "(") - 1);
      }
      $createBy = Session::get('EmployeeID');
      if ($processlist == "1") {

        $moduleMaster = [
          'loc_id' => $location,
          'cm_id' => $Process,
          'module_name' => $Module,
          'level' => $Level,
          'l1empid' => trim($EmpID),
          'l1name' => trim($EmpName),
          'l2empid' => trim($EmpID2),
          'l2name' => trim($EmpName2),
          'CreatedBy' => $createBy
        ];

        $insertedId =  ModuleMaster::insertGetId($moduleMaster);
        if ($insertedId) {
          return response()->json(['message' => 'Created Successfully !!'], 200);
        } else
          return response()->json(['message' => 'Food expense record created successfully'], 404);
      } elseif ($processlist == "2") {

        $EmployeeID = substr($request->input('emp3'), strpos($request->input('emp3'), "(") + 1, (strpos($request->input('emp3'), ")")) - (strpos($request->input('emp3'), "(") + 1));
        $location = $Process = 0;
        $moduleMasternew = [
          'loc_id' => $location,
          'cm_id' => $Process,
          'module_name' => $Module,
          'level' => $Level,
          'l1empid' => trim($EmpID),
          'l1name' => trim($EmpName),
          'l2empid' => trim($EmpID2),
          'l2name' => trim($EmpName2),
          'CreatedBy' => $createBy,
          'EmployeeID' => $EmployeeID
        ];
        $insertedId2 =  ModuleMasternew::insertGetId($moduleMasternew);
        if ($insertedId2) {
          return response()->json(['message' => 'Created Successfully !!'], 200);
        } else
          return response()->json(['message' => 'Food expense record created successfully'], 404);
      } elseif ($processlist == "3") {

        // $request->validate([
        //   'file' => 'required|mimes:xls,xlsx',
        // ]);

        $file = $request->file('excelfile');

        $filePath = $file->store('imported-files');

        Excel::import(new UsersImport, $file);
        return back()->with('success', 'Uploded Successfully');
      }
    } catch (\Exception $e) {
      return response()->json(['error' => $e->getMessage()], 500);
    }
  }
  public function viewmodulemaster(Request $request)
  {
    try {
      $results = DB::table('location_master')
        ->select('id', 'location')
        ->get();

      $data = DB::table('personal_details as t1')
        ->select('t1.EmployeeID', 't1.EmployeeName')
        ->join('employee_map as t2', 't1.EmployeeID', '=', 't2.EmployeeID')
        ->where('t2.emp_status', 'Active')
        ->whereNotIn('t2.df_id', ['74', '77'])
        ->orderBy('t1.EmployeeName')
        ->get();

      $result = $data->map(function ($value) {
        return [
          'id' => $value->EmployeeID,
          'name' => $value->EmployeeName,
        ];
      });
      return view('managemodulemaster.modulemaster', compact('results', 'result'));
    } catch (\Exception $e) {
      return response()->json();
    }
  }

  public function process(Request $request)
  {



    try {
      $location = $request->location_val;
      $process = DB::table('new_client_master as t1')
        ->select(DB::raw('distinct concat(t2.client_name, "|", t1.process, "|", t1.sub_process) as Process'), 't1.cm_id')
        ->join('client_master as t2', 't1.client_name', '=', 't2.client_id')
        ->leftJoin('client_status_master as t3', 't1.cm_id', '=', 't3.cm_id')
        ->where('t1.location', $location)
        ->whereNull('t3.cm_id')
        ->orderBy('Process')
        ->get();

      return $process;
    } catch (\Exception $e) {

      return response()->json(['error' => $e->getMessage()], 500);
    }
  }
  public function searchemp(Request $request)
  {
    $term = $request->input('term');

    $data = DB::table('personal_details as t1')
      ->join('employee_map as t2', 't1.EmployeeID', '=', 't2.EmployeeID')
      ->where('t2.emp_status', '=', 'Active')
      ->whereNotIn('t2.df_id', ['74', '77'])
      ->orderBy('t1.EmployeeName')
      ->select('t1.EmployeeID', 't1.EmployeeName')
      ->get();
    // dd( $data);
    $result = [];
    foreach ($data as $value) {
      $result[] = $value->EmployeeName . ' (' . $value->EmployeeID . ')';
    }
    return response()->json($result);
  }
  public function Export()
  {
    try {
      return Excel::download(new ExportUsers, 'ModuleMasterNew.xls');
      return back();
    } catch (\Exception $e) {
      return response()->json(['error' => $e->getMessage()], 500);
    }
  }
}
