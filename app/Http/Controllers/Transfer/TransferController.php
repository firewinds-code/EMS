<?php

namespace App\Http\Controllers\Transfer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Transfer\EmpDetail;
use Illuminate\Support\Facades\Session;

use Exception;

class TransferController extends Controller
{
    public function viewtransferEmp()
    {
        try {
            return view('transfer/transferEmployee');
        } catch (Exception $e) {
            return back()->with("error", "Something Went Wrong");
        }
    }
    public function search(Request $request)
    {
        try {
            if ($request->report_search === "search") {
                $employeeId = $request->employee_id;
                if (empty($employeeId)) {
                    return back()->with("error", "Please Enter Employee ID");
                }
                $results = EmpDetail::select('emp_details.EmployeeID', 'emp_details.EmployeeName', 'emp_details.designation', 'emp_details.process', 'emp_details.subprocess', 'emp_details.ReportTo', 'location_master.location')
                    ->leftjoin('location_master', 'emp_details.location', '=', 'location_master.id')
                    ->where('emp_details.EmployeeID', $employeeId)
                    ->first();

                $location = DB::select("select id,location from location_master where id !=(select location from emp_details where  EmployeeId='" . $employeeId . "')");

                if (!empty($results)) {
                    return view('transfer.transferEmployee', compact('results', 'location'));
                }
                return back()->with('error', 'No results found');
            } else {
                try {
                    return view('transfer.transferEmployee');
                } catch (Exception $e) {
                    return back()->with("error", "Something Went Wrong");
                }
            }
        } catch (Exception $e) {
            return back()->with("error", "Something Went Wrong");
        }
    }

    public function clientname(Request $request)
    {
        try {
            $locationval = $request->location_val;
            $client = DB::table('client_master')
                ->select('client_id', 'client_name')
                ->whereIn('client_id', function ($query) use ($locationval) {
                    $query->select(DB::raw('distinct client_name'))
                        ->from('whole_details_peremp')
                        ->where('location', '=', $locationval);
                })
                ->orderBy('client_name')
                ->get();
            return $client;
        } catch (Exception $ex) {
            return back()->with("error", "Something Went Wrong");
        }
    }

    public function process(Request $request)
    {
        try {
            $clientName = $request->client_val;
            $location = $request->location_val;
            $process = DB::table('new_client_master')
                ->select('process')
                ->distinct()
                ->where('client_name', '=', $clientName)
                ->where('location', '=', $location)
                ->get();
            return $process;
        } catch (Exception $ex) {
            return back()->with("error", "Something Went Wrong");
        }
    }
    public function subprocess(Request $request)
    {
        try {
            $process = $request->process_val;
            $location = $request->location_val;

            $subprocess = DB::table('new_client_master')
                ->select('sub_process', 'cm_id')
                ->where('process', '=', $process)
                ->where('location', '=', $location)
                ->whereNotIn('cm_id', function ($query) {
                    $query->select('cm_id')
                        ->from('client_status_master');
                })
                ->get();
            return $subprocess;
        } catch (Exception $ex) {
            return back()->with("error", "Something Went Wrong");
        }
    }

    public function reportTo(Request $request)
    {
        try {

            $clientName = $request->client_val;
            $location = $request->location_val;
            $employeeId = $request->employee_id_val;

            $firstQuery = DB::table('employee_map as t1')
                ->select(DB::raw("DISTINCT t3.client_name, CONCAT(t2.EmpName, '(', t2.empid, ')') as Name, t1.EmployeeID, t2.loc, t2.EmpName"))
                ->join('EmpID_Name as t2', 't1.EmployeeID', '=', 't2.EmpID')
                ->join('new_client_master as t3', 't1.cm_id', '=', 't3.cm_id')
                ->where('client_name', '=', $clientName)
                ->where('loc', '=', $location)
                ->where('emp_status', '=', 'Active')
                ->where('df_id', '!=', 74);

            //query for Nitin Sir ID
            $secondQuery = DB::table('employee_map as t1')
                ->select(DB::raw("DISTINCT t3.client_name, CONCAT(t2.EmpName, '(', t2.empid, ')') as Name, t1.EmployeeID, t2.loc, t2.EmpName"))
                ->join('EmpID_Name as t2', 't1.EmployeeID', '=', 't2.EmpID')
                ->join('new_client_master as t3', 't1.cm_id', '=', 't3.cm_id')
                ->where('EmployeeID', '=', $employeeId)
                ->where('emp_status', '=', 'Active');

            $result = $firstQuery->union($secondQuery)
                ->orderBy('EmpName')
                ->get();
            return $result;
        } catch (Exception $ex) {
            return back()->with("error", "Something Went Wrong");
        }
    }

    public function save(Request $request)
    {
        try {
            $employeeId = $request->employeeid;
            $location = $request->location;
            $clientName = $request->client;
            $process = $request->process;
            $subProcess = $request->subprocess;
            $reportsTo = $request->ReportTo;
            $transferDate = $request->transfer_date;
            $createdOn = now();

            $condition =  DB::table('transfer_emp')->insert([
                'EmployeeID' => $employeeId,
                'location' => $location,
                'client_name' => $clientName,
                'process' => $process,
                'sub_process' => $subProcess,
                'reports_to' => $reportsTo,
                'transfer_date' => $transferDate,
                'createdon' => $createdOn,
            ]);
            if ($condition) {
                return  response()->json(['success' => true, 'message' => 'Employee Transfered Successfully']);
            }
            return response()->json(['error' => true, 'message' => 'Employee Transfer Failed !']);
        } catch (Exception $ex) {
            return back()->with("error", "Something Went Wrong");
        }
    }
}