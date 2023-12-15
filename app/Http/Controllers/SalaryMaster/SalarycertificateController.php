<?php

namespace App\Http\Controllers\SalaryMaster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Salarymaster\location_master;
use App\Models\Salarymaster\salary_master;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class SalarycertificateController extends Controller
{
  public function viewsalarymaster(Request $request)
  {
    try {
      $results = DB::table('salary_master as X')
        ->select('X.id', 'X.EmpID', 'X.location as loc_id', 'Y.location')
        ->join(DB::raw('(SELECT ed.id, GROUP_CONCAT(b.location ORDER BY b.id) AS location FROM salary_master ed INNER JOIN location_master b ON FIND_IN_SET(b.id , ed.location) > 0 GROUP BY ed.id) as Y'), 'X.id', '=', 'Y.id')
        ->get();
      // Retrieve all records from the table
      $data = location_master::all(); // Retrieve all records from the table
      return view('salarymastercertificate.salaryMaster', compact('data', 'results'));
    } catch (\Exception $e) {
      return response()->json(['error' => $e->getMessage()], 500);
    }
  }

  public function storesalarymaster(Request $request)
  {

    $request->validate(
      [
        'EmpID' => 'required',
      ]
    );

    if ($request->ReqType === "Submit") { {
        try { {
            // dd($request->all());
            $location = implode(',', $request->input('location'));
            $employee_id = $request->input('EmpID');
            $salaryMaster = salary_master::where('EmpID', $employee_id)->first();

            if ($salaryMaster) {
              // dd($salaryMaster);
              $salaryMaster->location = $location;
              $salaryMaster->save();
              Session::flash('success', 'Updated successfully !!');
              return redirect('salarymaster');
              return response()->json(['message' => 'Updated successfully !!'], 200);
            } else {
              $salaryMaster = new salary_master();
              $salaryMaster->EmpID = $employee_id;
              $salaryMaster->location = $location;
              $salaryMaster->save();
              Session::flash('success', 'Created successfully !!');
              return redirect('salarymaster');
              return response()->json(['message' => 'Created successfully !!'], 200);
            }
          }
        } catch (\Exception $e) {
          return response()->json(['error' => $e->getMessage()], 500);
        }
      }
    }

    if ($request->ReqType === "update") { {
        try { {

            $location = implode(',', $request->input('location'));
            $employee_id = $request->input('EmpID');
            $salaryMaster = salary_master::where('EmpID', $employee_id)->first();

            if ($salaryMaster) {
              //  dd($salaryMaster);
              $salaryMaster->location = $location;
              $salaryMaster->save();
              Session::flash('success', 'Created successfully !!');
              return redirect('salarymaster');
              return response()->json(['message' => 'Updated  successfully !!'], 200);
            } else {
              $salaryMaster = new salary_master();
              $salaryMaster->EmpID = $employee_id;
              $salaryMaster->location = $location;
              $salaryMaster->save();
              Session::flash('success', 'Created successfully !!');
              return redirect('salarymaster');
              return response()->json(['message' => 'Created successfully !!'], 200);
            }
          }
        } catch (\Exception $e) {
          return response()->json(['error' => $e->getMessage()], 500);
        }
      }
    }
  }
 public function  deletesalarymaster($empId)
    {
        try {
          $delete = salary_master::where('EmpID',$empId)->delete();
          //  dd( $delete);
            if($delete)
            {
                return  response()->json(['success' => true, 'message'=> "salary Record Deleted Successfully !"]);
            }
            return  response()->json(['error' => true, 'message'=> "salary Record Deleted Failed !"]);
        } catch (\Exception $ex) {
            return  response()->json(['error' => true, 'message'=> "Something  Went  Wrong"]);
        }
    }
}
