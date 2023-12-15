<?php

namespace App\Http\Controllers\Drm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\Drm\ReportMap;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class DynamicReportMaster extends Controller
{
    public function view()
    {
        try {
            $reports = DB::table('report_master')
                ->select('id', 'report_name')
                ->get();
            //  dd($reports);

            $processes = DB::table('new_client_master as t1')
                ->select('t1.cm_id', DB::raw('CONCAT(t2.client_name, "|", t1.process, "|", t1.sub_process, " (", t3.location, ")") as Process'))
                ->join('client_master as t2', 't1.client_name', '=', 't2.client_id')
                ->join('location_master as t3', 't1.location', '=', 't3.id')
                ->whereNotIn('t1.cm_id', function ($query) {
                    $query->select('cm_id')->from('client_status_master');
                })
                ->orderBy('t2.client_name')
                ->get();
            //  dd($results);

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
            // dd($result);
            return view('drm/dynamicReportMaster', compact('result', 'reports', 'processes'));
        } catch (Exception $e) {
           
            return back()->with("error", "Something Went Wrong");
        }
    }

    public function  getEditId($id)
    {
        try {
            $empid = request('id');
            $reportIDs = DB::table('report_map')
                ->select('reportID')
                ->distinct()
                ->where('EmpID', $empid)
                ->get();

            $query = DB::table('new_client_master as t1')
                ->select('t1.cm_id', DB::raw('CONCAT(t2.client_name, "|", t1.process, "|", t1.sub_process, " (", t3.location, ")") as Process'))
                ->join('client_master as t2', 't1.client_name', '=', 't2.client_id')
                ->join('location_master as t3', 't1.location', '=', 't3.id')
                ->whereNotIn('t1.cm_id', function ($subquery) {
                    $subquery->select('cm_id')->from('client_status_master');
                })
                ->whereIn('t1.cm_id', function ($subquery) use ($empid) {
                    $subquery->select('processID')
                        ->distinct()
                        ->from('report_map')
                        ->where('EmpID', $empid);
                })
                ->orderBy('t2.client_name')
                ->get();

            $reports = DB::table('report_master')
                ->select('id', 'report_name')
                ->get();

            $processes = DB::table('new_client_master as t1')
                ->select('t1.cm_id', DB::raw('CONCAT(t2.client_name, "|", t1.process, "|", t1.sub_process, " (", t3.location, ")") as Process'))
                ->join('client_master as t2', 't1.client_name', '=', 't2.client_id')
                ->join('location_master as t3', 't1.location', '=', 't3.id')
                ->whereNotIn('t1.cm_id', function ($query) {
                    $query->select('cm_id')->from('client_status_master');
                })
                ->orderBy('t2.client_name')
                ->get();

            $html = response()->json([
                'reports' => view('ajax.dynamic.report', compact('reportIDs', 'reports'))->render(),
                'process' => view('ajax.dynamic.process', compact('query', 'processes'))->render()
            ]);
            return $html;
        } catch (Exception $ex) {
            dd($ex->getMessage());
            return back()->with("error", "Something Went Wrong");
        }
    }

    public function update(Request $request)
    {
        try {
            $reportids = $request->report;
            $processids = $request->process;
            $empID = substr($request->input('searchEmp'), strpos($request->input('searchEmp'), "(") + 1, (strpos($request->input('searchEmp'), ")")) - (strpos($request->input('searchEmp'), "(") + 1));

            // // Delete existing records for the given EmpID
            ReportMap::where('EmpID', $empID)->delete();

            // Insert new records
            if (isset($reportids) && isset($processids)) {
                foreach ($reportids as $rvar) {
                    foreach ($processids as $pvar) {
                        $reportMap = new ReportMap();
                        $reportMap->EmpID = $empID;
                        $reportMap->reportID = $rvar;
                        $reportMap->processID = $pvar;
                        $reportMap->CreatedBy = Session::get('EmployeeID');
                        $reportMap->save();
                    }
                }
            } else {

                return response()->json(['message' => 'All fields are mandatory ! ', 'error' => true]);
            }
            return response()->json(['message' => 'Data Saved Successfully...!', 'success' => true]);
        } catch (Exception $e) {
            dd($e->getMessage());
            return response()->json(['message' => 'Something Went Wrong...!', 'error' => true]);
        }
    }

    public function list()
    {
        try {
            $reportData = DB::table('report_map as t1')
                ->select('t1.EmpID', 'p.EmployeeName', 't2.report_name', 'l1.location', 'c.client_name', 'nc.process', 'nc.sub_process', 't1.Createdon')
                ->leftJoin('report_master as t2', 't1.reportID', '=', 't2.id')
                ->leftJoin('new_client_master as nc', 't1.processID', '=', 'nc.cm_id')
                ->leftJoin('client_master as c', 'nc.client_name', '=', 'c.client_id')
                ->leftJoin('personal_details as p', 't1.EmpID', '=', 'p.EmployeeID')
                ->leftJoin('location_master as l1', 'l1.id', '=', 'nc.location')
                ->take(5000)
                ->get();

            return view('drm/dynamicReportList', compact('reportData'));
        } catch (Exception $e) {
            dd($e->getMessage());
            return back()->with("error", "Something Went Wrong");
        }
    }
}