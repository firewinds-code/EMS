<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\certificationrequirebycmid;
use App\Models\NewClientMaster;
use App\Models\ClientMaster;
use App\Models\LocationMaster;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use function Laravel\Prompts\select;

class TestmasterController extends Controller
{
    public function testview()
    {
        try {
            $results = DB::table('location_master')
                ->select('id', 'location')
                ->get();
            $datas = DB::table('certification_require_by_cmid as a')
                ->select('a.ID', 'a.cm_id', 'a.cert_name', 'a.filename', 'b.process', 'b.sub_process', 'c.client_name', 'd.location', 'd.id')
                ->join('new_client_master as b', 'a.cm_id', '=', 'b.cm_id')
                ->join('client_master as c', 'b.client_name', '=', 'c.client_id')
                ->join('location_master as d', 'b.location', '=', 'd.id')
                ->get();
            return view('Testmaster.testmaster', compact('results', 'datas'));
        } catch (\Exception $e) {
            return response()->json('something went wrong');
        }
    }

    public function process(Request $request)
    {
        try {
            $location = $request->location_val;
            $query = 'select distinct concat(t2.client_name,"|",t1.process,"|",t1.sub_process) as Process,t1.cm_id from new_client_master t1 join client_master t2 on t1.client_name = t2.client_id left join client_status_master t3 on t1.cm_id=t3.cm_id where t1.location=? and t3.cm_id is null order by process';
            $params = [$location];
            $process = collect(DB::select($query, $params));
            return $process;
        } catch (\Exception $e) {
            return response()->json('something went wrong');
        }
    }

    public function addtest(Request $request)
    {
        try {

            $createBy = Session::get('EmployeeID');
            

            if (!isset($createBy)) {
                return response()->json(['message' => 'EmployeeID not found in ', 'error' => true]);
            }

            $certificationrequirebycmid = new CertificationRequireByCmid();
            $certificationrequirebycmid->cm_id = $request->process;
            $certificationrequirebycmid->cert_name = $request->test;
            $certificationrequirebycmid->filename = $request->testfile;
            $certificationrequirebycmid->createdBy = $createBy;
            $certificationrequirebycmid->save();
            if ($certificationrequirebycmid) {
                return response()->json(['success' => true, 'message' => 'Addtion Successfully !']);
            } else {
                return response()->json(['error' => true, 'message' => 'Addtion faield!']);
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
            return response()->json(['error', 'Addtion faield!']);
        }
    }
    public function edit($id)
    {
        try {
            $testrow =  CertificationRequireByCmid::leftjoin('new_client_master', 'certification_require_by_cmid.cm_id', 'new_client_master.cm_id')
                ->leftjoin('location_master', 'new_client_master.location', 'location_master.id')->where(function ($query) use ($id) {
                    $query->where('new_client_master.cm_id', $id)->where('certification_require_by_cmid.cm_id', $id);
                })->select('certification_require_by_cmid.*', 'location_master.id as locationid')->first();

            return response()->json(['success' => true, 'testrow' => $testrow]);
        } catch (\Exception $e) {

            return back()->with("error", "Something Went Wrong");
        }
    }

    public function update(Request $request)
    {
        try {
            //  $createBy = Session::get('EmployeeID');
            $validatedData = $request->validate([
                'processtest' => 'required',
                'test' => 'required',
                'testfile' => 'required',
                'id' => 'required',
            ]);
            $dataToUpdate = [
                'cm_id' => $validatedData['processtest'],
                'cert_name' => $validatedData['test'],
                'filename' => $validatedData['testfile'],
                // 'createdby' => $validatedData['$createBy'],
            ];
            $updated = CertificationRequireByCmid::where('ID', $validatedData['id'])->update($dataToUpdate);
            if ($updated) {
                return response()->json(['success' => true, 'message' => 'Record updated successfully!']);
            }
            return response()->json(['error' => true, 'message' => 'Record update failed!']);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return response()->json(['error' => true, 'message' => 'something went wrong']);
        }
    }
}