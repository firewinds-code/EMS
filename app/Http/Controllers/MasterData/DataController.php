<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\MasterData\ViewEmpinfoActive;
use Exception;

class DataController extends Controller
{
    public function view()
    {
        try {
            return view('masterData/masterDataView');
        } catch (Exception $e) {
            dd($e->getMessage());
            return back()->with("error", "Something Went Wrong");
        }
    }
    public function activeData(Request $request)
    {
        try {



            $subqueryAdhar = DB::table('doc_details')
                ->select('EmployeeID', DB::raw('MAX(dov_value) AS AdharCard'))
                ->where('doc_stype', '=', 'Aadhar Card')
                ->groupBy('EmployeeID');

            $subqueryPan = DB::table('doc_details')
                ->select('EmployeeID', DB::raw('MAX(dov_value) AS PanCard'))
                ->where('doc_stype', '=', 'PAN Card')
                ->groupBy('EmployeeID');

            $result = DB::table('View_EmpinfoActive AS t1')
                ->leftJoinSub($subqueryAdhar, 'adhar', function ($join) {
                    $join->on('t1.EmployeeID', '=', 'adhar.EmployeeID');
                })
                ->leftJoinSub($subqueryPan, 'pan', function ($join) {
                    $join->on('t1.EmployeeID', '=', 'pan.EmployeeID');
                })
                ->select('t1.*', 'adhar.AdharCard', 'pan.PanCard')
                ->take(500)
                ->get();
            // dd($result);
            return response()->json(['table' =>  view('ajax.masterdata.table', compact('result'))->render(), 'success' => true]);
        } catch (Exception $e) {
            dd($e->getMessage());
            return back()->with("error", "Something Went Wrong");
        }
    }
    public function inactiveData(Request $request)
    {
        try {

            $Year = $request->year;

            $results = DB::table('View_EmpinfoInActive AS t1')
                ->leftJoin(DB::raw('(SELECT EmployeeID, MAX(dov_value) AS dov_value FROM doc_details WHERE doc_stype = "Aadhar Card" GROUP BY EmployeeID) adhar'), 't1.EmployeeID', '=', 'adhar.EmployeeID')
                ->leftJoin(DB::raw('(SELECT EmployeeID, MAX(dov_value) AS dov_value FROM doc_details WHERE doc_stype = "PAN Card" GROUP BY EmployeeID) pan'), 't1.EmployeeID', '=', 'pan.EmployeeID')
                ->whereYear('DOJ', '=', $Year)
                ->select('t1.*', 'adhar.dov_value AS AdharCard', 'pan.dov_value AS PanCard')
                ->take(500)
                ->get();

            return view('masterData/masterDataView', compact('results'));
        } catch (Exception $e) {
            dd($e->getMessage());
            return back()->with("error", "Something Went Wrong");
        }
    }
}