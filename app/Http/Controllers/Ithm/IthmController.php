<?php

namespace App\Http\Controllers\Ithm;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Ithm\IthmModel;
use App\Models\Ithm\location_master;
use Illuminate\Support\Facades\Session;
use Exception;

class IthmController extends Controller
{
    public function view()
    {
        try {
            $results = DB::table('ithdk_master_email_address')
                ->select('id', 'email', 'emailType', 'location', 'createdBy', 'createdDate')
                ->get();
            $data = location_master::all(); // Retrieve all records from the table
            return view('ithm/view', compact('data', 'results'));
        } catch (Exception $e) {
            return back()->with("error", "Something Went Wrong");
        }
    }

    public function  deleteEmail($id)
    {
        try {
            $delete = IthmModel::where('id', $id)->delete();
            if ($delete) {
                return  response()->json(['success' => true, 'message' => "Email Deleted Successfully !"]);
            }
            return  response()->json(['error' => true, 'message' => "Email Deleted Failed !"]);
        } catch (\Exception $ex) {
            return  response()->json(['error' => true, 'message' => "Something  Went  Wrong"]);
        }
    }
    public function save(Request $request)
    {
        try {

            // Get the selected locations as an array
            $selectedLocations = $request->input('locations');

            // Convert the selected locations array to a comma-separated string
            $location = implode(', ', $selectedLocations);
            $email = $request->email;
            $emailType = $request->emailType;
            $createdBy = Session::get('EmployeeID');
          
            // Insert data into the database
            $condition = DB::table('ithdk_master_email_address')->insert([
                'location' => $location,
                'email' => $email,
                'emailType' => $emailType,
                'createdBy' => $createdBy,
            ]);

            if ($condition) {
                return response()->json(['success' => true, 'message' => 'Email Added Successfully']);
            }
            return response()->json(['error' => true, 'message' => 'Add Email Failed !']);
        } catch (Exception $ex) {
            return back()->with("error", "Something Went Wrong");
        }
    }
}