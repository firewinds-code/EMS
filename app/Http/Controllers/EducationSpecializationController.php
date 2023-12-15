<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EducationSpecialization;
use Validator;
use Session;

class EducationSpecializationController extends Controller
{
    public function __construct(EducationSpecialization $eduSpecialization)
    {
        $this->eduSpecialization = $eduSpecialization;
    }


    public function list()
    {
           try {
                  $lists = $this->eduSpecialization::all();
                  return view('educationspecialization.list',compact('lists'));
           } catch (\Exception $ex) {
            return view('educationspecialization.list')->with('error', 'Something Went Wrong !');
           }
    }

    public function editEduSpecialization($id)
    {

          try {
            $row = $this->eduSpecialization::where('id',$id)->first();
            return response()->json(['row' => $row]);
          } catch (\Exception $ex) {
            return response()->json(['error' => true , 'message' => 'Something Went Wrong !']);
          }
    }

    public function updateOrSave(Request $request)
    {
           try {

            if(isset($request->specialization_id))
            {
                $this->eduSpecialization::where('id',$request->specialization_id)->update(['specilization' => $request->specialization_name, 'updatedby' => Session::get('EmployeeID')]);
                return response()->json(['success' => true , 'message' => 'Education Specialization Updated Successfully !']);
            }

            $validator = Validator::make($request->all(), [
                'specialization_name'    =>  'required|unique:education_specilization,specilization'
                ]);

            if ($validator->fails()) {
                return response()->json(['error' =>true ,'message' => 'Education Specialization Already Exists ']);
            }

            $this->eduSpecialization::insert(['specilization' => $request->specialization_name,'createdby' => Session::get('EmployeeID')]);
                return response()->json(['success' => true , 'message' => 'Education Specialization Inserted Successfully !']);

           } catch (\Exception $ex) {
            dd( $ex->getMessage());
            return response()->json(['error' => true , 'message' => 'Something Went Wrong !']);
           }
    }
}
