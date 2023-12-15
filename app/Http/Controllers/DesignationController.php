<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeginationMaster;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class DesignationController extends Controller
{

    public $designation;

    public function __construct(DeginationMaster $designation)
    {
            $this->designation = $designation;
    }



    public function designation(Request $request)
    {
       $designations = $this->designation->getdesignation();
       return view('designation.list',compact('designations'));

    }

    public function savedesignation(Request $request)
    {

        $designations = $this->designation->getdesignation();
        $checkDuplicacy = $designations->pluck('Designation');
        if($checkDuplicacy->contains($request->name) == false)
        {

           $condition = $this->designation::insert(['Designation' => $request->name,
             'createdon' => Carbon::now(),
            'createdby' => Session::get('EmployeeID')]);

             if($condition)
            {
                return response()->json(['success'=> true , 'message' => 'designation Saved Successfully In Our Records']);
             }
             return response()->json(['error'=> true, 'message' => 'Sorry, looks like there are some errors detected, please try again']);

        }
        return response()->json(['error'=> true, 'message' => 'designation Already Exists In Our Records']);

    }

    public function  deletedesignation($id)
    {
        try {
            $deleteDepart = $this->designation::where('ID', $id)->delete();
            if($deleteDepart)
            {
                return  response()->json(['success' => true, 'message'=> "Designation Deleted Successfully !"]);
            }
            return  response()->json(['error' => true, 'message'=> "Designation Deleted Failed !"]);
        } catch (\Exception $ex) {
            return  response()->json(['error' => true, 'message'=> "Something  Went  Wrong"]);
        }
    }


    public function  editdesignation($id)
    {

        try {
            $row = $this->designation::where('ID', $id)->first();
           if($row)
            {
                return  response()->json(['success' => true, 'html' => view('ajax.editdesignation',compact('row'))->render()]);
            }
            return  response()->json(['error' => true, 'message'=> "Something  Went  Wrong"]);
        } catch (\Exception $ex) {
            return  response()->json(['error' => true, 'message'=> "Something  Went  Wrong"]);
        }
    }


    public function updatedesignation(Request $request)
    {

        try {
            $update = ['Designation' => $request->name,
            'modifiedon' => Carbon::now(),
            'modifiedby' => Session::get('EmployeeID')
        ];
            $condition = $this->designation::where('ID', $request->designation_id)->update($update);
            if($condition)
            {
                return  response()->json(['success' => true,  'message'=> "designation Updated Successfully."]);
            }
            return  response()->json(['error' => true, 'message'=> "Something  Went  Wrong"]);
        } catch (\Exception $ex) {
            dd($ex->getMessage());
            return  response()->json(['error' => true, 'message'=> "Something  Went  Wrong"]);
        }

    }
}
