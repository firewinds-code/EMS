<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppraisalMaster;

class AppraisalMasterController extends Controller
{

    public $appraisalMaster;

     public function __construct(AppraisalMaster $appraisalMaster)
         {
            $this->appraisalMaster = $appraisalMaster;
         }


      public function appraisalMasterList()
      {
        try {

             $lists = $this->appraisalMaster::join('new_client_master','apraisal_matrix.cm_id','new_client_master.cm_id')
                                          ->join('location_master', 'new_client_master.location','location_master.id')
                                          ->select('new_client_master.cm_id','new_client_master.process','new_client_master.sub_process','apraisal_matrix.EmpID','apraisal_matrix.createdby','apraisal_matrix.createdon','location_master.location as loc','apraisal_matrix.ID')
                                          ->get();

           return view('appraisal.list',compact('lists'));


        } catch (\Exception $ex) {
            dd($ex->getMessage());
            return back()->with('error', 'Something Went Wrong !');
        }
      }


      public function editAppraisal($appraisalID)
      {
        try {

        } catch (\Exception $ex) {

        }
      }


      public function saveOrUpdateAppraisal(Request $request)
      {
        try {

        } catch (\Exception $ex) {

        }
      }

}
