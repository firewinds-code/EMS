<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Doc_details;
use App\Models\Education_details;
use App\Models\Experince_details;
use App\Models\PersonalDetails;
use App\Models\EmployeeMap;
use App\Models\Status_table;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class Profile extends Controller
{
    public function viewProfile()
    {
        try {
            return view('profile.profile');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



    public function getAllDetails(Request $request)
    {
        try {
            $userData = session("userDetails");
            $type = $request->input('reqType');
            $ofc_loc =  intval([$userData[0]['location']]);
            $locationMapping = [
                1 => 'Noida',
                2 => 'Mumbai',
                3 => 'Meerut',
                4 => 'Bareilly',
                5 => 'Vadodara',
                6 => 'Mangalore',
                7 => 'Bangalore',
                8 => 'Nashik',
                9 => 'Anantapur',
            ];
            if (array_key_exists($ofc_loc, $locationMapping)) {
                $locationdir = $locationMapping[$ofc_loc];
            } else {
                $location = URL::to('unknown');
                return Redirect::to($location);
            }
            if ($type === "#profileData") {
                $result = DB::select("call get_personal(?)", [$userData[0]['EmployeeID']]);
                $data['getData'] = $result[0];
                $data['type'] = "profileDetails";
                return view('profile.profileStructure', $data);
            } else if ($type === "#contectDetails") {
                $result = DB::select("call get_contact(?)", [$userData[0]['EmployeeID']]);
                $data['getData'] = $result[0];
                $data['type'] = "contectDetails";
                return view('profile.profileStructure', $data);
            } else if ($type === "#documents") {
                $data['DocsData'] = Doc_details::where('EmployeeID', [$userData[0]['EmployeeID']])->get();
                $data['type'] = "documents";
                return view('profile.profileStructure', $data);
            } else if ($type === "#addressDetails") {
                $result = DB::select("call get_address(?)", [$userData[0]['EmployeeID']]);
                $data['getData'] = $result[0];
                $data['type'] = "addressDetails";
                return view('profile.profileStructure', $data);
            } else if ($type === "#eduDetails") {
                $data['EduData'] = Education_details::where('EmployeeID', [$userData[0]['EmployeeID']])->get();
                $data['type'] = "EducationDetails";
                return view('profile.profileStructure', $data);
            } else if ($type === '#expDetails') {
                $data['expData'] = Experince_details::where('EmployeeID', [$userData[0]['EmployeeID']])->get();
                $data['type'] = "ExperinceDetails";
                return view('profile.profileStructure', $data);
            } else if ($type === "#empMap") {
                $result = DB::select("call get_empmap_forme(?)", [$userData[0]['EmployeeID']]);
                $data['getData'] = $result[0];
                $data['type'] = "employeeMap";
                return view('profile.profileStructure', $data);
            } else if ($type === '#mngmtContect') {
                // Get FunctionID
                $functionId = EmployeeMap::join('df_master', 'df_master.df_id', '=', 'employee_map.df_id')
                    ->where('employee_map.EmployeeID', [$userData[0]['EmployeeID']])
                    ->pluck('function_id')
                    ->first();
                $data['functionId'] = $functionId;

                // Get Gender
                $gender = DB::table('personal_details')
                    ->where('EmployeeID', [$userData[0]['EmployeeID']])
                    ->value('Gender');

                // Get Employee Details
                $resultAll = DB::table('emp_dt_map')
                    ->whereIn('EmployeeID', ['CE03070003', 'CE07147134', 'CE05101779'])
                    ->get();

                $data['a'] = $resultAll[0]->EmployeeName ?? null;
                $data['aimg'] = $resultAll[0]->img ?? null;
                $data['b'] = $resultAll[0]->mobile ?? null;

                $data['c'] = $resultAll[1]->EmployeeName ?? null;
                $data['cimg'] = $resultAll[1]->img ?? null;
                $data['d'] = $resultAll[1]->mobile ?? null;

                $data['e'] = $resultAll[2]->EmployeeName ?? null;
                $data['eimg'] = $resultAll[2]->img ?? null;
                $data['f'] = $resultAll[2]->mobile ?? null;

                $data['g'] = $resultAll[3]->EmployeeName ?? null;
                $data['h'] = $resultAll[3]->mobile ?? null;

                $data['n1'] = $resultAll[0]->designation ?? null;
                $data['n2'] = $resultAll[1]->designation ?? null;
                $data['n3'] = $resultAll[2]->designation ?? null;
                $data['n4'] = $resultAll[3]->designation ?? null;

                // Get Site Spoc Details
                $siteSpoc = DB::table('new_client_master as c')
                    ->join('emp_dt_map as e', 'c.SiteSpoc', '=', 'e.EmployeeID')
                    ->where('c.cm_id', [$userData[0]['cm_id']])
                    ->select('c.SiteSpoc', 'c.cm_id', 'e.EmployeeName', 'e.mobile', 'e.designation', 'e.img')
                    ->first();

                $data['sitespocMobile'] = $siteSpoc->mobile ?? null;
                $data['s'] = $siteSpoc->EmployeeName ?? null;
                $sitespocimg = $siteSpoc->img ?? null;

                // Convert the image URL if not empty
                if (!empty($sitespocimg)) {
                    $data['sitespocimg'] = asset($locationdir . 'Images/' . $sitespocimg);
                }
                $data['type'] = "ManagementContectDetails";
                if (strtoupper($gender) === 'FEMALE') {
                    $data['GenderType'] = "FEMALE";
                    return view('profile.profileStructure', $data);
                } else {
                    $data['GenderType'] = "MALE";
                    return view('profile.profileStructure', $data);
                }
            } else if ($type === '#reportingMap') {
                $functionId = EmployeeMap::join('df_master', 'df_master.df_id', '=', 'employee_map.df_id')
                    ->where('employee_map.EmployeeID', [$userData[0]['EmployeeID']])
                    ->pluck('function_id')
                    ->first();

                $result = DB::select("call get_reporting_map_byempid(?)", [$userData[0]['EmployeeID']]);
                $getData = $result[0];
                if (!is_null($getData) && isset($getData->account_head)) {

                    $result_rt = PersonalDetails::join('contact_details', 'contact_details.EmployeeID', '=', 'personal_details.EmployeeID')
                        ->where('personal_details.EmployeeID', '=', $getData->ReportTo)
                        ->select('personal_details.img', 'personal_details.EmployeeName', 'contact_details.mobile')
                        ->limit(1)
                        ->get();
                    if ($result_rt->count() > 0) {
                        $contact_rt = $result_rt[0]->mobile;
                        $imsrc_rt = $result_rt[0]->img;
                    }
                    $data['contact_rt'] = $contact_rt;
                    $data['imsrc_rt'] = $imsrc_rt;
                    $data['RT'] = $result_rt[0]->EmployeeName;

                    if ($functionId === 7 || $functionId === 8 || $functionId === 10) {
                        dd("it's Works ||");
                    }
                    $result_ah = PersonalDetails::join('contact_details', 'contact_details.EmployeeID', '=', 'personal_details.EmployeeID')
                        ->where('personal_details.EmployeeID', '=', $getData->account_head)
                        ->select('contact_details.mobile', 'personal_details.img')
                        ->limit(1)
                        ->get();
                    if ($result_ah->count() > 0) {
                        $contact_ah = $result_ah[0]->mobile;
                        $imsrc_ah = $result_ah[0]->img;
                    }
                    $data['contact_ah'] = $contact_ah;
                    $data['imsrc_ah'] = $imsrc_ah;
                    $data['AH'] = $getData->AH;




                    $result_ph  = PersonalDetails::join('contact_details', 'contact_details.EmployeeID', '=', 'personal_details.EmployeeID')
                        ->where('personal_details.EmployeeID', '=', $getData->process_head)
                        ->select('contact_details.mobile', 'personal_details.img', 'personal_details.EmployeeName')
                        ->limit(1)
                        ->get();
                    if ($result_ph->count() > 0) {
                        $contact_ph = $result_ph[0]->mobile;
                        $imsrc_ph = $result_ph[0]->img;
                    }

                    $data['contact_ph'] = $contact_ph;
                    $data['imsrc_ph'] = $imsrc_ph;
                    $data['PH'] = $result_ph[0]->EmployeeName;

                    $result_vh  = PersonalDetails::join('contact_details', 'contact_details.EmployeeID', '=', 'personal_details.EmployeeID')
                        ->where('personal_details.EmployeeID', '=', $getData->vh)
                        ->select('contact_details.mobile', 'personal_details.img', 'personal_details.EmployeeName')
                        ->limit(1)
                        ->get();
                    if ($result_vh->count() > 0) {
                        $contact_vh = $result_vh[0]->mobile;
                        $imsrc_vh = $result_vh[0]->img;
                    }

                    $data['contact_vh'] = $contact_vh;
                    $data['imsrc_vh'] = $imsrc_vh;
                    $data['VH'] = $result_vh[0]->EmployeeName;


                    $data['type'] = "reportingMap";
                    return view('profile.profileStructure', $data);
                }
            } else if ($type === '#processMap') {
                $rid = Status_table::where('employeeid', [$userData[0]['EmployeeID']])->value('ReportTo');
                $rrid = Status_table::where('employeeid', $rid)->value('ReportTo');
                $rrrid = Status_table::where('employeeid', $rrid)->value('ReportTo');


                $result_rt =    PersonalDetails::select('personal_details.img', 'emp_dt_map.designation', 'personal_details.EmployeeName', 'contact_details.mobile')
                    ->join('contact_details', 'contact_details.EmployeeID', '=', 'personal_details.EmployeeID')
                    ->join('emp_dt_map', 'personal_details.EmployeeID', '=', 'emp_dt_map.EmployeeID')
                    ->where('personal_details.EmployeeID', '=', $rid)
                    ->limit(1)
                    ->first();
                if ($result_rt) {
                    $data['contact_rt_mobile'] = $result_rt->mobile;
                    $data['imsrc_rt_img'] = $result_rt->img;
                    $data['rtName'] = $result_rt->EmployeeName;
                    $data['rtDesignation'] = $result_rt->designation;
                }

                if ($rid != $rrid) {
                    $result_rrt = PersonalDetails::select('personal_details.img', 'emp_dt_map.designation', 'personal_details.EmployeeName', 'contact_details.mobile')
                        ->join('contact_details', 'contact_details.EmployeeID', '=', 'personal_details.EmployeeID')
                        ->join('emp_dt_map', 'emp_dt_map.EmployeeID', '=', 'personal_details.EmployeeID')
                        ->where('personal_details.EmployeeID', '=', $rrid)
                        ->first();

                    if ($result_rrt) {
                        $data['imsrc_rrt'] = $result_rrt->img;
                        $data['rrdesignation'] = $result_rrt->designation;
                        $data['rrtname'] = $result_rrt->EmployeeName;
                        $data['contact_rrt_mobile'] = $result_rrt->mobile;
                    }
                }


                if ($rrrid != $rrid && $rrrid != $rid) {
                    $result_rrrt = PersonalDetails::select('personal_details.img', 'personal_details.EmployeeName', 'emp_dt_map.designation', 'contact_details.mobile')
                        ->join('contact_details', 'contact_details.EmployeeID', '=', 'personal_details.EmployeeID')
                        ->join('emp_dt_map', 'emp_dt_map.EmployeeID', '=', 'personal_details.EmployeeID')
                        ->where('personal_details.EmployeeID', '=', $rrrid)
                        ->first();
                    if ($result_rrrt) {
                        $data['imsrc_rrrt'] = $result_rrrt->img;
                        $data['rrrdesignation'] = $result_rrrt->designation;
                        $data['rrrtname'] = $result_rrrt->EmployeeName;
                        $data['contact_rrrt_mobile'] = $result_rrrt->mobile;
                        $data['isvalid'] = true;
                    }
                }
                $data['type'] = "processMap";
                return view('profile.profileStructure', $data);
            } else if ($type === '#WarnDocs') {
                $query = "SELECT MAX(i.ah_status) as ah_status,
                               MAX(i.ah_subtype) as ah_subtype,
                        MAX(i.ah_Datetime) as ah_Datetime,
                                 d.Title,
                         d.Document,
                            COUNT(*) as count
                              FROM warning_rth i
                                        INNER JOIN warning_rth_documents d
                                  ON i.EmployeeID = d.EmployeeID AND i.id = d.DataId
                            WHERE i.EmployeeID = ?
                                      GROUP BY d.DataId, d.Title, d.Document
                                 ";

                $getData = DB::select($query, [$userData[0]['EmployeeID']]);
                if (count($getData) > 0) {
                    $data['getData'] = $getData;
                }
                $data['type'] = "WarnDocs";
                return view('profile.profileStructure', $data);
            } else if ($type === '#bankPF') {
                $result = DB::select("call get_salarydetails(?)", [$userData[0]['EmployeeID']]);
                $data['getData'] = $result[0];
                $data['type'] = "BankPF";
                return view('profile.profileStructure', $data);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
