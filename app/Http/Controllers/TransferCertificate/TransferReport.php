<?php

namespace App\Http\Controllers\TransferCertificate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transfer_Emp;
use Illuminate\Support\Facades\Session;

class TransferReport extends Controller

{
    public function viewtransferReport(Request $request)
    {
        try {
            return view('transferreport.transferReport');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function gettransferReport(Request $request)
    {
        try {
            $dates = explode(' - ', $request->DateFrom_To);
            $startDate = $dates[0];
            $endDate = $dates[1];
            $results = Transfer_Emp::join('location_master', 'transfer_emp.location', '=', 'location_master.id')
                ->join('client_master', 'transfer_emp.client_name', '=', 'client_master.client_id')
                ->join('new_client_master', 'new_client_master.cm_id', '=', 'transfer_emp.sub_process')
                ->whereBetween('transfer_emp.transfer_date', [$startDate, $endDate])
                ->select('transfer_emp.EmployeeID', 'location_master.location', 'client_master.client_name', 'transfer_emp.process', 'new_client_master.sub_process', 'transfer_emp.reports_to')->get();
            $totalCount = $results->count();
            $successMessage = $totalCount . ' Data Found !!';
            Session::flash('success', $successMessage);
            return view('transferreport.transferReport', compact('results'));
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }
}
