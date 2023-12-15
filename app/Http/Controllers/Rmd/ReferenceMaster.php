<?php

namespace App\Http\Controllers\Rmd;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\Rmd\RefMaster;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;



class ReferenceMaster extends Controller
{
    public function view()
    {
        try {
            $refData = DB::table('ems.ref_master')
                ->select('ref_id', 'Type', 'ContactPerson', 'ContactNo', 'RefName', 'Status', 'Payout')
                ->where('ref_id', '>', 4)
                ->get();

            return view('rmd/rmdView', compact('refData'));
        } catch (Exception $e) {
            return back()->with("error", "Something Went Wrong");
        }
    }
    public function update(Request $request)
    {
        try {
            $id = $request->id;
            $data = DB::table('ems.ref_master')
                ->where('ref_id', $id)
                ->first();
            return response()->json(['data' => $data]);
        } catch (Exception $e) {
            return back()->with("error", "Something Went Wrong");
        }
    }

    public function save(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'Contact_person' => 'required',
                'ContactNo' => 'required',
                'refName' => 'required',
                'amount' => 'required',
                'id' => 'required',
            ]);
            $dataToUpdate = [
                'Type' => "Consultancy",
                'ContactPerson' => $validatedData['Contact_person'],
                'ContactNo' => $validatedData['ContactNo'],
                'RefName' => $validatedData['refName'],
                'Payout' => $validatedData['amount'],
                'Status' => 1,
                'ModifiedBy' => Session::get('EmployeeID'),
                'ModifiedOn' => now()
            ];
            $updated = RefMaster::where('ref_id', $validatedData['id'])->update($dataToUpdate);
            if ($updated) {
                return response()->json(['success' => true, 'message' => 'Record updated successfully!']);
            }
            return response()->json(['error' => true, 'message' => 'Record update failed!']);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'An error occurred while updating the record.']);
        }
    }

    public function add(Request $request)
    {
        try {
            $Type = "Consultancy";
            $refName = $request->Consultancy;
            $ContactPerson = $request->ContactPerson;
            $number = $request->number;
            $payout = $request->payout;
            $status = 1;
            $CreatedOn = now();
            $CreatedBy = Session::get('EmployeeID');

            // Insert data into the database
            $condition = DB::table('ref_master')->insert([
                'Type' => $Type,
                'RefName' => $refName,
                'ContactPerson' => $ContactPerson,
                'ContactNo' => $number,
                'Payout' => $payout,
                'Status' => $status,
                'CreatedOn' => $CreatedOn,
                'CreatedBy' => $CreatedBy
            ]);

            if ($condition) {
                return response()->json(['success' => true, 'message' => 'Reference Details Added Successfully']);
            }
            return response()->json(['error' => true, 'message' => 'Add Reference Details Failed !']);
        } catch (Exception $ex) {
            return back()->with("error", "Something Went Wrong");
        }
    }

    public function list(Request $request)
    {
        try {

            if ($request->report_search == "search") {
                $dates = explode(' - ', $request->DateFrom);
                $startDate = $dates[0];
                $endDate = $dates[1];

                $results = DB::table('tbl_reference_reg_detail')
                    ->select(
                        'RefID',
                        'createdon',
                        'CandidateName',
                        'CandidateNumber',
                        'EmployeeID',
                        'EmployeeName',
                        DB::raw("CONCAT(Client, '-',Process, '-',SubProcess) as Process")
                    )
                    ->whereBetween(DB::raw("CAST(createdon AS DATE)"), [$startDate, $endDate])
                    ->orderBy('createdon')
                    ->get();

                if ($results) {
                    return view('rmd/rmdList', compact('results'));
                } else {
                    return back()->with(['error', 'Data Not Found !']);
                }
            } else {
                return view('rmd/rmdList');
            }
        } catch (Exception $e) {
            return back()->with(['error', 'An error occurred: ' . $e->getMessage()]);
        }
    }
}