<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalarySlab;
use DB;
class SalarySlabController extends Controller
{


    public function __construct(SalarySlab $salarySlab)
    {
        $this->salarySlab = $salarySlab;
    }


    public function list()
        {
         try {
                $query = 'SELECT t1.id, t1.cm_id, t1.min_lim, t1.max_lim, t1.avg_sal, t3.client_name, t2.process, t4.location, t2.sub_process,t1.createdon
                                        FROM tbl_salary_slab_by_cps t1 inner join new_client_master t2 on t2.cm_id = t1.cm_id
                                        inner join client_master t3 on t2.client_name = t3.client_id
                                        inner join location_master t4 on t4.id=t2.location
                                        left outer join client_status_master cs on cs.cm_id=t2.cm_id
                                        where cs.cm_id is null  order by client_name';
                $lists = DB::select($query);
                return view('salaryslab.list',compact('lists'));
             } catch (\Exception $ex) {
                  return back()->with('error', 'Sorry, Something Went Wrong !');
            }
        }

        public function editSalarySlab($processID)
        {
         try {
                $query = 'SELECT t1.id, t1.cm_id, t1.min_lim, t1.max_lim, t1.avg_sal, t3.client_name, t2.process, t4.id as locationid
                                        FROM tbl_salary_slab_by_cps t1 inner join new_client_master t2 on t2.cm_id = t1.cm_id
                                        inner join client_master t3 on t2.client_name = t3.client_id
                                        inner join location_master t4 on t4.id=t2.location
                                        left outer join client_status_master cs on cs.cm_id=t2.cm_id
                                        where cs.cm_id is null and t1.cm_id = "'.$processID.'" limit 1';
                 $slabrow =  DB::select($query);
                if(!isset($slabrow) || empty($slabrow))
                {
                    return response()->json(['error' => true, 'message' => 'Data Row Does Not Exists !']);
                }

                 return response()->json(['salaryrow' => $slabrow, 'success' => true]);
             } catch (\Exception $ex) {
                dd($ex->getMessage());
                return response()->json(['error'=>true , 'message' => 'Sorry, Something Went Wrong !']);
            }
        }

        public function saveOrUpdateSalarySlab(Request $request)
        {
                try {
                      $salarySlab = ["cm_id" => $request->process,
                                    "min_lim" => $request->minimum_salary,
                                    "avg_sal" => $request->average_salary,
                                    "max_lim" => $request->maximum_salary];
                    if(isset($request->edit_slab_id))
                     {
                        $slabExists = $this->salarySlab::where(function($query) use($request){
                            $query->where('id',$request->edit_slab_id);
                           })->exists();
                        if($slabExists)
                        {
                            $slabExists = $this->salarySlab::where(function($query) use($request){
                                $query->where('id',$request->edit_slab_id);
                               })->update($salarySlab);

                               return response()->json(['success'=>true, 'message' => 'Salary Slab Updated Successfully !']);
                        }
                     }

                     $slabExists = $this->salarySlab::insert($salarySlab);
                     return response()->json(['success'=>true, 'message' => 'Salary Slab Saved Successfully !']);

                } catch (\Exception $ex) {
                    dd($ex->getMessage());
                    return response()->json(['error'=>true, 'message' => 'Something Went Wrong or Slab Not Be Updated Or Saved  !']);
                }
        }

}
