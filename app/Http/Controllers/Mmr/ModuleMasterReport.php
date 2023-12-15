<?php

namespace App\Http\Controllers\Mmr;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;

class ModuleMasterReport extends Controller
{
    public function view(Request $request)
    {
        try {
            if ($request->ajax()) {

                $data = DB::table('module_master_new as t1')
                    ->join('location_master as t2', 't1.loc_id', '=', 't2.id')
                    ->join('new_client_master as t3', 't1.cm_id', '=', 't3.cm_id')
                    ->join('personal_details as t4', 't1.EmployeeID', '=', 't4.EmployeeID')
                    ->select(
                        't1.EmployeeID',
                        't4.EmployeeName',
                        't2.location',
                        DB::raw("CONCAT(t3.process, '|', t3.sub_process) as Process"),
                        't1.level',
                        't1.l1empid as L1',
                        't1.l1name as L1Name',
                        't1.l2empid as L2',
                        't1.l2name as L2Name',
                        DB::raw("CASE WHEN t1.flag = 1 THEN 'Module Level' WHEN t1.flag = 2 THEN 'Employee Level' END as Mapping")
                    );
                return DataTables::of($data)
                    ->filter(function ($query) use ($request) {
                        if ($request->has('search.value')) {
                            $value = $request->input('search.value');
                            $query->where('t1.EmployeeID', 'like', "%$value%")
                                ->orWhere('t4.EmployeeName', 'like', "%$value%")
                                ->orWhere('t2.location', 'like', "%$value%")
                                ->orWhere(DB::raw("CONCAT(t3.process, '|', t3.sub_process)"), 'like', "%$value%")
                                ->orWhere('t1.level', 'like', "%$value%")
                                ->orWhere('t1.l1empid', 'like', "%$value%")
                                ->orWhere('t1.l1name', 'like', "%$value%")
                                ->orWhere('t1.l2empid', 'like', "%$value%")
                                ->orWhere('t1.l2name', 'like', "%$value%")
                                ->orWhere(DB::raw("CASE WHEN t1.flag = 1 THEN 'Module Level' WHEN t1.flag = 2 THEN 'Employee Level' END"), 'like', "%$value%");
                        }
                    })
                    ->make(true);
            }

            return view('mmr.moduleMasterReport');
        } catch (Exception $e) {
            return back()->with("error", "Something Went Wrong");
        }
    }
}