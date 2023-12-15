<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DistrictManage;
use App\Models\StateModel;
use Session;
use Validator;

class DistrictManageController extends Controller
{



    public function __construct(DistrictManage $districtManage,StateModel $stateModel)
    {
          $this->districtManage = $districtManage;
          $this->stateModel = $stateModel;
    }




    public function getState()
    {
       $stateList = $this->stateModel::all();
       return response()->json(['stateList' => $stateList]);
    }

    public function districtList()
    {
            try {
                  $lists = $this->districtManage::all();
                  return view('district.list',compact('lists'));
            } catch (\Exception $ex) {
                dd($ex->getMessage());
               return view('district.list')->with('error', 'Something Went Wrong !');
             }
    }

    public function editDistrict($id)
    {
       try {
            $row = $this->districtManage::where('id',$id)->first();
            return response()->json(['row' => $row,]);
            //return view('district.list',compact('row'));
        } catch (\Exception $ex) {
            return response()->json(['error' => true, 'message' => 'Something Went Wrong !']);

        }

    }

    public function districtUpdateOrSave(Request $request)
    {
          try {

                if(isset($request->district_id))
                   {
                    $this->districtManage::where('id',$request->district_id)->update(['district' => $request->district_name,'state_id' =>$request->state,'updatedby'=>Session::get('EmployeeID')]);
                    return response()->json(['success' => true, 'message' => 'District Updated Successfully !']);
                   }
                   $validator = Validator::make($request->all(), [
                    'education_board'    =>  'required|unique:district,district'
                    ]);

                if ($validator->fails()) {
                    return response()->json(['error' =>true ,'message' => 'District Already Exists ']);
                }

                   $this->districtManage::insert(['district' => $request->district_name,'state_id' =>$request->state,'createdby'=>Session::get('EmployeeID')]);
                    return response()->json([ 'success' => true, 'message' => 'District Inserted Successfully !']);

          } catch (\Exception $ex) {
             return response()->json(['error' => true , 'message' => 'Something Went Wrong !']);
          }
    }


}
