<?php

namespace App\Http\Controllers\Issue;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Issue\Issue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Exception;

class IssueMaster extends Controller
{
    public function view()
    {
        try {
            $results = DB::table('issue_master')
                ->select('issue_master.id', 'issue_master.queary', 'issue_master.bt', 'personal_details.EmployeeName', 'issue_master.handler', 'issue_master.tat')
                ->leftJoin('personal_details', 'personal_details.EmployeeID', '=', 'issue_master.handler')
                ->get();

            return view('issue/issueView', compact('results'));
        } catch (Exception $e) {
            return back()->with("error", "Something Went Wrong");
        }
    }

    public function update(Request $request)
    {
        try {
            $id = $request->id;
            $data = DB::table('ems.issue_master')
                ->where('id', $id)
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
                'query' => 'required',
                'belong_to' => 'required',
                'handler_to' => 'required',
                'tat_edit' => 'required',
                'id_edit' => 'required',
            ]);
            $dataToUpdate = [
                'queary' => $validatedData['query'],
                'bt' => $validatedData['belong_to'],
                'handler' => $validatedData['handler_to'],
                'tat' => $validatedData['tat_edit'],
                'modifiedby' => Session::get('EmployeeID'),
                'modifiedon' => now()
            ];

           
            $updated = Issue::where('id', $validatedData['id_edit'])->update($dataToUpdate);
            if ($updated) {
                return response()->json(['success' => true, 'message' => 'Record updated successfully!']);
            }
            return response()->json(['error' => true, 'message' => 'Record update failed!']);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return response()->json(['error' => true, 'message' => 'An error occurred while updating the record.']);
        }
    }

    public function add(Request $request)
    {
        try {

            $issue = $request->issue;
            $belongto = $request->belongto;
            $handlerto = $request->handlerto;
            $tat = $request->tat;
            $CreatedOn = now();
            $loginID = session("EmployeeID");
            // Insert data into the database
            $condition = DB::table('issue_master')->insert([
                'queary' => $issue,
                'bt' => $belongto,
                'handler' => $handlerto,
                'tat' => $tat,
                'createdon' => $CreatedOn,
                'createdby' => $loginID,
            ]);

            if ($condition) {
                return response()->json(['success' => true, 'message' => 'Issue Details Added Successfully']);
            }
            return response()->json(['error' => true, 'message' => 'Add Issue Details Failed !']);
        } catch (Exception $ex) {
            dd($ex->getMessage());
            return back()->with("error", "Something Went Wrong");
        }
    }
}