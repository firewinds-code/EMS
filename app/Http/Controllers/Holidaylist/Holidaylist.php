<?php

namespace App\Http\Controllers\Holidaylist;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Holidaylist\Ho_list_admin;

class Holidaylist extends Controller
{
    public function holidaylist()
    {
        try {
            $userData = session("userDetails");
            $holidaydetails = Ho_list_admin::where('location', $userData[0]['location'])->orderBy('DateOn', 'asc')->get();
            return view('holidaylist.holiday_all', [
                'holidaydetails' => $holidaydetails,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
