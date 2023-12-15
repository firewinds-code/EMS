<?php

namespace App\Http\Controllers\Wmt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\wmt\ContactDetail;
use App\Models\Wmt\MailTemplate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Exception;

class WmtController extends Controller
{
    public function view()
    {
        try {
            $sqlConnect = DB::table('mail_template as t1')
                ->select(
                    't1.id',
                    'empid as EmployeeID',
                    'name as EmployeeName',
                    'location',
                    'doj',
                    'assignment',
                    'linkdinLink as url',
                    't2.mobile as number',
                    DB::raw("CASE WHEN t2.ofc_emailid IS NULL THEN 'Email ID not created' WHEN t2.ofc_emailid = '' THEN 'Email ID not created' ELSE t2.ofc_emailid END AS email"),
                    'designation',
                    DB::raw("immediate_manager as 'manager'")
                )
                ->join('contact_details as t2', 't1.empid', '=', 't2.EmployeeID')
                ->join('employee_map as t3', 't1.empid', '=', 't3.EmployeeID')
                ->where('t3.emp_status', 'Active')
                ->where(function ($query) {
                    $query->where('t1.flag', 0)
                        ->orWhere('t1.flag', 1);
                })
                ->get();
            // dd($sqlConnect);
            return view('wmt/wmtView', compact('sqlConnect'));
        } catch (Exception $e) {
            return back()->with("error", "Something Went Wrong");
        }
    }
    public function update(Request $request)
    {
        try {


            // Update the MailTemplate record
            $employeeID = $request->input('EmployeeID');

            $mailTemplate = MailTemplate::where('empid', $employeeID)->first();

            if ($mailTemplate) {
                $mailTemplate->name = $request->input('EmployeeName');
                $mailTemplate->email = $request->input('email');
                $mailTemplate->contact_no = $request->input('number');
                $mailTemplate->doj = $request->input('doj');
                $mailTemplate->designation = $request->input('designation');
                $mailTemplate->immediate_manager = $request->input('manager');
                $mailTemplate->assignment = $request->input('assignment');
                $mailTemplate->linkdinLink = $request->input('url');
                $mailTemplate->flag = 1;
                $mailTemplate->ModifiedBy = Session::get('EmployeeID');
                $mailTemplate->save();
            }

            // Update the ContactDetail record
            $employeeID = $request->input('EmployeeID');
            $contactDetail = ContactDetail::where('EmployeeID', $employeeID)->first();
            if ($contactDetail) {
                $contactDetail->mobile = $request->input('number');
                $contactDetail->ofc_emailid = $request->input('email');
                $contactDetail->save();
            }
            return response()->json(['message' => 'Data Saved Successfully...!', 'success' => true]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Something Went Wrong...!', 'error' => true]);
        }
    }
}