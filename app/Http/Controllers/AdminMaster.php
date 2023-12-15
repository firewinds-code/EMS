<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class AdminMaster extends Controller
{

    protected $modelAdmin;

    public function __construct(AdminModel $modelAdmin)
    {
         $this->modelAdmin = $modelAdmin;
    }


    public function department(Request $request)
    {
       $departments = $this->modelAdmin->getDepartment();
       return view('department.list',compact('departments'));

    }

    public function saveDepartment(Request $request)
    {

        $departments = $this->modelAdmin->getDepartment();
        $checkDuplicacy = $departments->pluck('dept_name');
        if($checkDuplicacy->contains($request->name) == false)
        {

           $condition = $this->modelAdmin::insert(['dept_name' => $request->name,
             'modifiedon' => Carbon::now(),
            'modifiedby' => Session::get('EmployeeID')]);

             if($condition)
            {
                return response()->json(['success'=> true , 'message' => 'Department Saved Successfully In Our Records']);
             }
             return response()->json(['error'=> true, 'message' => 'Sorry, looks like there are some errors detected, please try again']);

        }
        return response()->json(['error'=> true, 'message' => 'Department Already Exists In Our Records']);

    }

    public function  deleteDepartment($id)
    {
        try {
            $deleteDepart = $this->modelAdmin::where('dept_id', $id)->delete();
            if($deleteDepart)
            {
                return  response()->json(['success' => true, 'message'=> "Deaprtment Deleted Successfully !"]);
            }
            return  response()->json(['error' => true, 'message'=> "Deaprtment Deleted Failed !"]);
        } catch (\Exception $ex) {
            return  response()->json(['error' => true, 'message'=> "Something  Went  Wrong"]);
        }
    }


    public function  editDepartment($id)
    {

        try {
            $row = $this->modelAdmin::where('dept_id', $id)->first();
            if($row)
            {
                return  response()->json(['success' => true, 'html' => view('ajax.editdepartment',compact('row'))->render()]);
            }
            return  response()->json(['error' => true, 'message'=> "Something  Went  Wrong"]);
        } catch (\Exception $ex) {
            return  response()->json(['error' => true, 'message'=> "Something  Went  Wrong"]);
        }
    }


    public function updateDepartment(Request $request)
    {

        try {
            $update = ['dept_name' => $request->name,
            'modifiedon' => Carbon::now(),
            'modifiedby' => Session::get('EmployeeID')
        ];
            $condition = $this->modelAdmin::where('dept_id', $request->department_id)->update($update);
            if($condition)
            {
                return  response()->json(['success' => true,  'message'=> "Department Updated Successfully."]);
            }
            return  response()->json(['error' => true, 'message'=> "Something  Went  Wrong"]);
        } catch (\Exception $ex) {
            dd($ex->getMessage());
            return  response()->json(['error' => true, 'message'=> "Something  Went  Wrong"]);
        }

    }

}