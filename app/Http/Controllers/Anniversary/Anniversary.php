<?php

namespace App\Http\Controllers\Anniversary;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class Anniversary extends Controller
{
    //
    public function bdayList(Request $req)
    {
        try {
            $data['getBdayData'] = DB::select("call get_birthday_list()");
            return view('anniversary.birthday', $data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function marrigeList(Request $req)
    {
        try {
            $data['get_m_Data'] = DB::select("call get_marrige_ani_list()");
            return view('anniversary.marrige', $data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function workList(Request $req)
    {
        try {
            $today = now()->format('m-d');
            $data['get_w_Data'] = DB::table('Active_Emp_Base as B')
                ->select(
                    'B.EmployeeName',
                    'B.client_name',
                    'B.process',
                    'B.sub_process',
                    'B.img',
                    'B.location',
                    'B.Designation',
                    'M.location as locname',
                    'B.DOJ'
                )
                ->leftJoin('location_master as M', 'M.ID', '=', 'B.location')
                ->whereRaw("DATE_FORMAT(B.DOJ, '%m-%d') = '$today'")
                ->get();
            return view('anniversary.work', $data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
