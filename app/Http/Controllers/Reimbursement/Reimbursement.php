<?php

namespace App\Http\Controllers\Reimbursement;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Reimbursement\ExpenseTravel;
use App\Models\Reimbursement\ExpenseFood;
use App\Models\Reimbursement\ExpenseHotel;
use App\Models\Reimbursement\ExpenseMobile;
use App\Models\Reimbursement\ExpenseMiscellaneous;
use App\Models\Reimbursement\LocationMaster;
use App\Models\Reimbursement\CheckCSAMobile;
use App\Models\Reimbursement\ExpenseLog;
use App\Models\EmployeeMap;
use Illuminate\Support\Facades\Session;

class Reimbursement extends Controller
{

    /* For Raise Reimbrusment */

    public function viewRaise()
    {
        try {
            $userData = session("userDetails");
            $checkCsk = '';
            $cskData = CheckCSAMobile::where('empid', $userData[0]['EmployeeID'])->get();
            if ($cskData->count() > 0) {
                $checkCsk = true;
            } else {
                $checkCsk = false;
            }
            return view('reimbursement.raiseAll', ['checkCsk' => $checkCsk]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    /*Start For Food */
    public function getFoodData(Request $request)
    {
        try {
            $employeeID = $request->input('EmployeeID');
            $type = $request->input('reqType');
            if ($type === "review") {

                $data['foodData'] = ExpenseFood::select('expense_food.*')
                    ->join('EmpID_Name', 'expense_food.EmployeeID', '=', 'EmpID_Name.empid')
                    ->join('expense_matrix', 'EmpID_Name.loc', '=', 'expense_matrix.location')
                    ->where('expense_matrix.EmployeeID', '=', $employeeID)
                    ->where('expense_matrix.is_reviewer', '=', 'Yes')
                    ->where('expense_food.reviewerStatus', '=', 'Pending')
                    ->get();
                // return view('reimbursement.review.foodStructureReview', ['foodData' => $foodData]);
                $data['type'] = "review";

                return view('reimbursement.approve.foodStructureApprove_review', $data);
            } else if ($type === "approver") {
                $data['foodData'] = ExpenseFood::select('expense_food.*')
                    ->join('EmpID_Name', 'expense_food.EmployeeID', '=', 'EmpID_Name.empid')
                    ->join('expense_matrix', 'EmpID_Name.loc', '=', 'expense_matrix.location')
                    ->where('expense_matrix.EmployeeID', '=', $employeeID)
                    ->where('expense_matrix.is_approver', '=', 'Yes')
                    ->where('expense_food.reviewerStatus', '=', 'Approve')
                    ->where('expense_food.mgrStatus', '=', 'Pending')
                    ->get();
                $data['type'] = "approve";
                return view('reimbursement.approve.foodStructureApprove_review', $data);
            } else {
                $foodData = DB::table('expense_food')
                    ->where('EmployeeID', $employeeID)
                    ->orderBy('created_at')
                    ->get();
                return view('reimbursement.foodStructure', ['foodData' => $foodData]);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function createReiseFood(Request $request)
    {
        try {
            $userData = session("userDetails");
            if ($request->reqType === "review") {
                $validator = Validator::make($request->all(), [
                    'Reviewer' => 'required',
                    'FoodCommentReviewer' => 'required|min:3',
                ]);
                if ($validator->fails()) {
                    return response()->json(['error' => $validator->errors()], 400);
                } else {
                    $expenseFood = ExpenseFood::find($request->foodID_);
                    if ($expenseFood) {
                        $expenseFood->reviewerStatus = $request->Reviewer;
                        $expenseFood->reviewComment = $request->FoodCommentReviewer;
                        $expenseFood->modified_at = now();
                        $expenseFood->save();
                        return response()->json(['message' => 'Update successfully !!'], 200);
                    }
                }
            } else if ($request->reqType === "approve") {
                $expenseFood = ExpenseFood::find($request->foodID_);
                $expenseFood->mgrStatus = $request->Approver;
                $expenseFood->mgrComment = $request->FoodCommentApprover;
                $expenseFood->approverStatus = "Approved";
                $expenseFood->modified_at = now();
                $expenseFood->save();
                return response()->json(['message' => 'Update successfully !!'], 200);
            } else {
                $userData = session("userDetails");
                $validator = Validator::make($request->all(), [
                    'FoodDate' => 'required',
                    'FoodAmount' => 'required',
                    'FoodReceiptNo' => 'required',
                    'FoodRemakrs' => 'required|min:3',
                    'FoodReceiptFile' => 'required|mimes:jpeg,png,jpg,gif,pdf|max:2048'
                ]);

                if ($validator->fails()) {
                    return response()->json(['error' => $validator->errors()], 400);
                } else {
                    $currentTime = now()->format('Y-m-d-His');
                    $milliseconds = round(microtime(true) * 1000);
                    $misFile = $request->file('FoodReceiptFile');
                    $path = public_path('reimbursement/ExpenseFood');
                    $extfile = $misFile->getClientOriginalExtension();
                    $filePath = "{$userData[0]['EmployeeID']}_{$currentTime}_{$milliseconds}.{$extfile}";
                    $misFile->move($path, $filePath);


                    ExpenseFood::create([
                        "EmployeeID" => $userData[0]['EmployeeID'],
                        "empName" => $userData[0]['EmployeeName'],
                        "date" => $request->FoodDate,
                        "amount" => $request->FoodAmount,
                        "receipt_no" => $request->FoodReceiptNo,
                        "receipt_image" => $filePath,
                        "remarks" => $request->FoodRemakrs,
                        "req_status" => "Pending",
                        "reqType" => "FoodRequest",
                        "reviewerStatus" => "Pending",
                        "mgrStatus" => "Pending",
                        "approverStatus" => "Pending",
                    ]);

                    $foodData = ExpenseFood::where('EmployeeID', $userData[0]['EmployeeID'])
                        ->orderBy('created_at')
                        ->get();

                    return response()->json(['message' => 'Food expense record created successfully', 'foodData' => $foodData], 200);
                }
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function deleteRaiseFood(Request $request)
    { {
            try {

                $userData = session("userDetails");
                $id = $request->input('id');


                $expenseFood = ExpenseFood::find($id);
                if (!$expenseFood) {
                    return response()->json(['error' => 'Record not found'], 404);
                } else {

                    ExpenseLog::create([
                        "EmployeeID" => $expenseFood->EmployeeID,
                        "empName" => $expenseFood->empName,
                        "date" => $expenseFood->date,
                        "reqType" => $expenseFood->reqType,
                        "remarks" => $expenseFood->remarks,
                    ]);

                    $file =  $expenseFood->receipt_image;
                    if ($file !== null) {
                        $path = public_path('reimbursement/ExpenseFood') . '/' . $file;
                        file_exists($path) ? unlink($path) : "";
                    }
                    ExpenseFood::where("id", $id)->delete();
                    //dd("OK");
                    $foodData = ExpenseFood::where('EmployeeID', $userData[0]['EmployeeID'])
                        ->orderBy('created_at')
                        ->get();

                    return response()->json(['message' => 'Food expense Deleted successfully', 'foodData' => $foodData], 200);
                }
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
    }
    /*End Food */


    /*Start Travel */
    public function getTravelData(Request $request)
    {
        try {
            $type = $request->input('reqType');
            $employeeID = $request->input('EmployeeID');
            $data['type'] = "abc";
            if ($type === "review") {
                $data['TravelData'] = ExpenseTravel::select('expense_travel.*')
                    ->join('EmpID_Name', 'expense_travel.EmployeeID', '=', 'EmpID_Name.empid')
                    ->join('expense_matrix', 'EmpID_Name.loc', '=', 'expense_matrix.location')
                    ->where('expense_matrix.EmployeeID', '=', $employeeID)
                    ->where('expense_matrix.is_reviewer', '=', 'Yes')
                    ->where('expense_travel.reviewerStatus', '=', 'Pending')
                    ->get();
                $data['type'] = "review";
                return view('reimbursement.approve.travelStructureApprove_review', $data);
            } else if ($request->reqType === "approver") {
                $data['TravelData'] = ExpenseTravel::select('expense_travel.*')
                    ->join('EmpID_Name', 'expense_travel.EmployeeID', '=', 'EmpID_Name.empid')
                    ->join('expense_matrix', 'EmpID_Name.loc', '=', 'expense_matrix.location')
                    ->where('expense_matrix.EmployeeID', '=', $employeeID)
                    ->where('expense_matrix.is_approver', '=', 'Yes')
                    ->where('expense_travel.reviewerStatus', '=', 'Approve')
                    ->where('expense_travel.mgrStatus', '=', 'Pending')
                    ->get();
                $data['type'] = "approve";
                return view('reimbursement.approve.travelStructureApprove_review', $data);
            } else {
                $data['TravelData'] = DB::table('expense_travel')
                    ->where('EmployeeID', $employeeID)
                    ->orderBy('created_at')
                    ->get();
                return view('reimbursement.travelStructure', $data);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function createReiseTravel(Request $request)
    {
        try {
            $userData = session("userDetails");

            if ($request->reqType === "review") {

                $validator = Validator::make($request->all(), [
                    'Reviewer' => 'required',
                    'TravelCommentReviewer' => 'required|min:3',
                ]);
                if ($validator->fails()) {
                    return response()->json(['error' => $validator->errors()], 400);
                } else {

                    $expenseTravel = ExpenseTravel::find($request->TravelID_);
                    if ($expenseTravel) {
                        $expenseTravel->reviewerStatus = $request->Reviewer;
                        $expenseTravel->reviewComment = $request->TravelCommentReviewer;
                        $expenseTravel->modified_at = now();
                        $expenseTravel->save();
                        return response()->json(['message' => 'Update successfully !!'], 200);
                    }
                }
            } else if ($request->reqType === "approve") {
                $validator = Validator::make($request->all(), [
                    'Approver' => 'required',
                    'TravelCommentApprover' => 'required|min:3',
                ]);
                if ($validator->fails()) {
                    return response()->json(['error' => $validator->errors()], 400);
                } else {
                    $expenseFood = ExpenseTravel::find($request->TravelID_);
                    if ($expenseFood) {
                        $expenseFood->mgrStatus = $request->Approver;
                        $expenseFood->mgrComment = $request->TravelCommentApprover;
                        $expenseFood->approverStatus = "Approved";
                        $expenseFood->modified_at = now();
                        $expenseFood->save();
                        return response()->json(['message' => 'Update successfully !!'], 200);
                    }
                }
            } else {

                $validator = Validator::make($request->all(), [
                    'travel_date' => 'required',
                    'travel_place_from' => 'required',
                    'travel_place_to' => 'required',
                    'travel_type' => 'required',
                    'travel_remarks' => 'required|min:3',
                ]);

                if ($request->input('travel_type') !== 'car') {
                    $validator->addRules([
                        'travel_ammount' => 'required|min:3',
                        'travel_receipt_no' => 'required|min:3',
                        'travel_receipt_file' => 'required|mimes:jpeg,png,jpg,gif,pdf|max:2048',
                    ]);
                }
                $validator->validate();


                if ($validator->passes()) {
                    $travel_type = $request->travel_type;
                    if ($travel_type === "car") {
                        try {
                            $fileCarKmPath = null;
                            $fileCarPkPath = null;
                            $fileCarTollPath = null;

                            $currentTime = now()->format('Y-m-d-His');
                            $milliseconds = round(microtime(true) * 1000);
                            if ($request->file('travel_km_receipt_file') !== null) {
                                $TravelFile = $request->file('travel_km_receipt_file');
                                $path = public_path('reimbursement/ExpenseTrevel');
                                $extfile = $TravelFile->getClientOriginalExtension();
                                $fileCarKmPath = "{$userData[0]['EmployeeID']}_CarKm_{$currentTime}_{$milliseconds}.{$extfile}";
                                $TravelFile->move($path, $fileCarKmPath);
                            }
                            if ($request->file('travel_pk_receipt_file') !== null) {
                                $TravelFile = $request->file('travel_pk_receipt_file');
                                $path = public_path('reimbursement/ExpenseTrevel');
                                $extfile = $TravelFile->getClientOriginalExtension();
                                $fileCarPkPath = "{$userData[0]['EmployeeID']}_CarPk_{$currentTime}_{$milliseconds}.{$extfile}";
                                $TravelFile->move($path, $fileCarPkPath);
                            }
                            if ($request->file('travel_toll_receipt_file') !== null) {
                                $TravelFile = $request->file('travel_toll_receipt_file');
                                $path = public_path('reimbursement/ExpenseTrevel');
                                $extfile = $TravelFile->getClientOriginalExtension();
                                $fileCarTollPath = "{$userData[0]['EmployeeID']}_CarToll_{$currentTime}_{$milliseconds}.{$extfile}";
                                $TravelFile->move($path, $fileCarTollPath);
                            }

                            ExpenseTravel::create([
                                "EmployeeID" => $userData[0]['EmployeeID'],
                                "empName" => $userData[0]['EmployeeName'],
                                "date" => $request->travel_date,
                                "modeOftravel" => $request->travel_type,
                                "reqType" => "TravelRequest",
                                "placeFrom" => $request->travel_place_from,
                                "placeTO" => $request->travel_place_to,
                                "amount" => $request->travel_total_ammount,
                                "car_km" => $request->travel_km,
                                "car_km_receipt" => $fileCarKmPath,
                                "car_toll_receipt" => $fileCarTollPath,
                                "car_parking_receipt" => $fileCarPkPath,
                                "remarks" => $request->travel_remarks,
                                "req_status" => "Pending",
                                "reviewerStatus" => "Pending",
                                "mgrStatus" => "Pending",
                                "approverStatus" => "Pending",

                            ]);
                            $travelData = ExpenseTravel::where('EmployeeID', $userData[0]['EmployeeID'])
                                ->orderBy('created_at')
                                ->get();
                            return response()->json(['message' => 'Travel expense record created successfully', 'travelData' => $travelData], 200);
                        } catch (\Throwable $th) {
                            return response()->json(['message' => 'Someting Went Wrong', 'type' => 'Travel>car']);
                            dd($th);
                        }
                    } else if ($travel_type === "flight") {
                        try {
                            $currentTime = now()->format('Y-m-d-His');
                            $milliseconds = round(microtime(true) * 1000);

                            $TravelFile = $request->file('travel_receipt_file');
                            $path = public_path('reimbursement/ExpenseTrevel');
                            $extfile = $TravelFile->getClientOriginalExtension();
                            $filePath = "{$userData[0]['EmployeeID']}_{$currentTime}_{$milliseconds}.{$extfile}";
                            $TravelFile->move($path, $filePath);
                            ExpenseTravel::create([
                                "EmployeeID" => $userData[0]['EmployeeID'],
                                "empName" => $userData[0]['EmployeeName'],
                                "date" => $request->travel_date,
                                "modeOftravel" => $request->travel_type,
                                "reqType" => "TravelRequest",
                                "placeFrom" => $request->travel_place_from,
                                "placeTO" => $request->travel_place_to,
                                "returnDate" => $request->travel_return_date,
                                "amount" => $request->travel_ammount,
                                "receipt_no" => $request->travel_receipt_no,
                                "receipt_image" => $filePath,
                                "remarks" => $request->travel_remarks,
                                "req_status" => "Pending",
                                "reviewerStatus" => "Pending",
                                "mgrStatus" => "Pending",
                                "approverStatus" => "Pending",

                            ]);
                            $travelData = ExpenseTravel::where('EmployeeID', $userData[0]['EmployeeID'])
                                ->orderBy('created_at')
                                ->get();
                            return response()->json(['message' => 'Travel expense record created successfully', 'travelData' => $travelData], 200);
                        } catch (\Throwable $th) {
                            return response()->json(['message' => 'Someting Went Wrong', 'type' => 'Travel>Flight']);
                            dd($th);
                        }
                    } else {
                        try {
                            $currentTime = now()->format('Y-m-d-His');
                            $milliseconds = round(microtime(true) * 1000);

                            $TravelFile = $request->file('travel_receipt_file');
                            $path = public_path('reimbursement/ExpenseTrevel');
                            $extfile = $TravelFile->getClientOriginalExtension();
                            $filePath = "{$userData[0]['EmployeeID']}_{$currentTime}_{$milliseconds}.{$extfile}";
                            $TravelFile->move($path, $filePath);

                            ExpenseTravel::create([
                                "EmployeeID" => $userData[0]['EmployeeID'],
                                "empName" => $userData[0]['EmployeeName'],
                                "date" => $request->travel_date,
                                "modeOftravel" => $request->travel_type,
                                "reqType" => "TravelRequest",
                                "placeFrom" => $request->travel_place_from,
                                "placeTO" => $request->travel_place_to,
                                "amount" => $request->travel_ammount,
                                "receipt_no" => $request->travel_receipt_no,
                                "receipt_image" => $filePath,
                                "remarks" => $request->travel_remarks,
                                "req_status" => "Pending",
                                "reviewerStatus" => "Pending",
                                "mgrStatus" => "Pending",
                                "approverStatus" => "Pending",

                            ]);
                            $travelData = ExpenseTravel::where('EmployeeID', $userData[0]['EmployeeID'])
                                ->orderBy('created_at')
                                ->get();
                            return response()->json(['message' => 'Travel expense record created successfully', 'travelData' => $travelData], 200);
                        } catch (\Throwable $th) {
                            return response()->json(['message' => 'Someting Went Wrong', 'type' => 'Travel>Default']);
                            dd($th);
                        }
                    }
                } else {
                    dd("All fields are required");
                }
            }
        } catch (\Throwable $th) {
            dd($th);
            return response()->json(['message' => 'Someting Went Wrong', 'type' => 'Travel']);
            dd($th);
        }
    }


    public function deleteRaiseTravel(Request $request)
    { {
            try {
                $userData = session("userDetails");
                $id = $request->input('id');

                $expenseTravel = ExpenseTravel::find($id);
                if (!$expenseTravel) {
                    return response()->json(['error' => 'Record not found'], 404);
                } else {
                    if ($expenseTravel->modeOftravel === "car") {


                        if ($expenseTravel->car_km_receipt !== null) {
                            $fileKm =  $expenseTravel->car_km_receipt;
                            $pathFileKm = public_path('reimbursement/ExpenseTrevel/') . $fileKm;
                            file_exists($pathFileKm) ? unlink($pathFileKm) : "";
                        }
                        if ($expenseTravel->car_toll_receipt !== null) {
                            $filetoll =  $expenseTravel->car_toll_receipt;
                            $pathFiletoll = public_path('reimbursement/ExpenseTrevel/') . $filetoll;
                            file_exists($pathFiletoll) ? unlink($pathFiletoll) : "";
                        }
                        if ($expenseTravel->car_parking_receipt !== null) {
                            $filePk =  $expenseTravel->car_parking_receipt;
                            $pathFilePk = public_path('reimbursement/ExpenseTrevel/') . $filePk;
                            file_exists($pathFilePk) ? unlink($pathFilePk) : "";
                        }
                    }
                    ExpenseLog::create([
                        "EmployeeID" => $expenseTravel->EmployeeID,
                        "empName" => $expenseTravel->empName,
                        "date" => $expenseTravel->date,
                        "reqType" => $expenseTravel->reqType,
                        "remarks" => $expenseTravel->remarks,
                    ]);
                    $expenseTravel->delete();
                    $travelData = ExpenseTravel::where('EmployeeID', $userData[0]['EmployeeID'])
                        ->orderBy('created_at')
                        ->get();

                    return response()->json(['message' => 'Travel expense Deleted successfully', 'travelData' => $travelData], 200);
                }
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
    }

    /*End Travel */


    /* Start Hotel */
    public function getHotelData(Request $request)
    {
        try {
            $type = $request->input('reqType');
            $employeeID = $request->input('EmployeeID');

            if ($type === "review") {
                $data['hotelData'] = ExpenseHotel::select('expense_hotel.*')
                    ->join('EmpID_Name', 'expense_hotel.EmployeeID', '=', 'EmpID_Name.empid')
                    ->join('expense_matrix', 'EmpID_Name.loc', '=', 'expense_matrix.location')
                    ->where('expense_matrix.EmployeeID', '=', $employeeID)
                    ->where('expense_matrix.is_reviewer', '=', 'Yes')
                    ->where('expense_hotel.reviewerStatus', '=', 'Pending')
                    ->get();
                $data['type'] = "review";
                return view('reimbursement.approve.hotelStructureApprove_review', $data);
            } else if ($type === "approver") {
                $data['hotelData'] = ExpenseHotel::select('expense_hotel.*')
                    ->join('EmpID_Name', 'expense_hotel.EmployeeID', '=', 'EmpID_Name.empid')
                    ->join('expense_matrix', 'EmpID_Name.loc', '=', 'expense_matrix.location')
                    ->where('expense_matrix.EmployeeID', '=', $employeeID)
                    ->where('expense_matrix.is_approver', '=', 'Yes')
                    ->where('expense_hotel.reviewerStatus', '=', 'Approve')
                    ->where('expense_hotel.mgrStatus', '=', 'Pending')
                    ->get();
                $data['type'] = "approve";
                return view('reimbursement.approve.hotelStructureApprove_review', $data);
            } else {

                $employeeID = $request->input('EmployeeID');
                $hotelData = DB::table('expense_hotel')
                    ->where('EmployeeID', $employeeID)
                    ->orderBy('created_at')
                    ->get();
                return view('reimbursement.hotelStructure', ['hotelData' => $hotelData]);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getVisitedLocation(Request $request)
    {
        try {
            $getLocation = LocationMaster::select('id', 'location')->get();
            return response()->json(['Status' => false, 'getLocation' => $getLocation], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getVisitedClientName(Request $request)
    {
        try {
            $location = $request->input('locationID');
            $getLocatioClinent  =   DB::table('new_client_master as t1')
                ->join('client_master as t2', 't1.client_name', '=', 't2.client_id')
                ->select('t2.client_name')
                ->distinct()
                ->whereNotIn('t1.cm_id', function ($query) {
                    $query->select('cm_id')->from('client_status_master');
                })
                ->where('t1.location', '=', $location)
                ->orderBy('t2.client_name')
                ->get();

            return response()->json(['Status' => true, 'getLocatioClinent' => $getLocatioClinent], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function createReiseHotel(Request $request)
    {
        try {
            $userData = session("userDetails");
            if ($request->reqType === "review") {

                $validator = Validator::make($request->all(), [
                    'Reviewer' => 'required',
                    'HotelCommentReviewer' => 'required|min:3',
                ]);
                if ($validator->fails()) {
                    return response()->json(['error' => $validator->errors()], 400);
                } else {
                    $ExpenseHotel = ExpenseHotel::find($request->HotelID_);
                    if ($ExpenseHotel) {
                        $ExpenseHotel->reviewerStatus = $request->Reviewer;
                        $ExpenseHotel->reviewComment = $request->HotelCommentReviewer;
                        $ExpenseHotel->modified_at = now();
                        $ExpenseHotel->save();
                        return response()->json(['message' => 'Update successfully !!'], 200);
                    }
                }
            } else if ($request->reqType === "approve") {
                $ExpenseHotel = ExpenseHotel::find($request->HotelID_);
                $ExpenseHotel->mgrStatus = $request->Approver;
                $ExpenseHotel->mgrComment = $request->HotelCommentApprover;
                $ExpenseHotel->approverStatus = "Approved";
                $ExpenseHotel->modified_at = now();
                $ExpenseHotel->save();
                return response()->json(['message' => 'Update successfully !!'], 200);
            } else {
                $currentTime = now()->format('Y-m-d-His');
                $milliseconds = round(microtime(true) * 1000);
                $validator = Validator::make($request->all(), [
                    'HotelDateFrom' => 'required',
                    'HotelDateTo' => 'required',
                    'visitedLocation' => 'required',
                    'visitedClient' => 'required|min:3',
                    'hotelName' => 'required|min:3',
                    'Amount' => 'required|min:3',
                    'HotelRemakrs' => 'required|min:3',
                    'recieptNo' => 'required|min:3',
                    'ReceiptFile' => 'required|mimes:jpeg,png,jpg,gif,pdf|max:2048'
                ]);
                if ($validator->fails()) {
                    return response()->json(['error' => $validator->errors()], 400);
                } else {

                    $MobFile = $request->file('ReceiptFile');
                    $path = public_path('reimbursement/ExpenseHotel');
                    $extfile = $MobFile->getClientOriginalExtension();
                    $filePath = "{$userData[0]['EmployeeID']}_{$currentTime}_{$milliseconds}.{$extfile}";
                    $MobFile->move($path, $filePath);


                    ExpenseHotel::create([
                        "EmployeeID" => $userData[0]['EmployeeID'],
                        "empName" => $userData[0]['EmployeeName'],
                        "dateFrom" => $request->HotelDateFrom,
                        "dateTo" => $request->HotelDateTo,
                        "noOfdays" => $request->NoOFDays,
                        "location" => $request->visitedLocation,
                        "client_name" => $request->visitedClient,
                        "hotelName" => $request->hotelName,
                        "amount" => $request->Amount,
                        "receipt_no" => $request->recieptNo,
                        "receipt_image" => $filePath,
                        "remarks" => $request->HotelRemakrs,
                        "req_status" => "Pending",
                        "reqType" => "HotelRequest",
                        "reviewerStatus" => "Pending",
                        "mgrStatus" => "Pending",
                        "approverStatus" => "Pending",
                    ]);
                    $hotelData = ExpenseHotel::where('EmployeeID', $userData[0]['EmployeeID'])
                        ->orderBy('created_at')
                        ->get();

                    return response()->json(['message' => 'Hotel expense record created successfully', 'hotelData' => $hotelData], 200);
                }
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function deleteRaiseHotel(Request $request)
    { {
            try {
                $userData = session("userDetails");
                $id = $request->input('id');

                $expenseHotel = ExpenseHotel::find($id);
                if (!$expenseHotel) {
                    return response()->json(['error' => 'Record not found'], 404);
                } else {
                    $file =  $expenseHotel->receipt_image;
                    if ($file !== null) {
                        $path = public_path('reimbursement/ExpenseHotel') . '/' . $file;
                        file_exists($path) ? unlink($path) : "";
                    }

                    ExpenseLog::create([
                        "EmployeeID" => $expenseHotel->EmployeeID,
                        "empName" => $expenseHotel->empName,
                        "date" => $expenseHotel->dateFrom,
                        "reqType" => $expenseHotel->reqType,
                        "remarks" => $expenseHotel->remarks,
                    ]);

                    $expenseHotel->delete();

                    $hotelData = ExpenseHotel::where('EmployeeID', $userData[0]['EmployeeID'])
                        ->orderBy('created_at')
                        ->get();
                    return response()->json(['message' => 'Hotel Expense Deleted successfully', 'hotelData' => $hotelData], 200);
                }
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
    }

    /*Start Mobile*/
    public function getMobileData(Request $request)
    {
        try {
            $employeeID = $request->input('EmployeeID');
            $type = $request->input('reqType');
            if ($type === "review") {
                $data['mobileData'] = ExpenseMobile::select('expense_mobile.*')
                    ->join('EmpID_Name', 'expense_mobile.EmployeeID', '=', 'EmpID_Name.empid')
                    ->join('expense_matrix', 'EmpID_Name.loc', '=', 'expense_matrix.location')
                    ->where('expense_matrix.EmployeeID', '=', $employeeID)
                    ->where('expense_matrix.is_reviewer', '=', 'Yes')
                    ->where('expense_mobile.reviewerStatus', '=', 'Pending')
                    ->get();


                $data['type'] = "review";

                return view('reimbursement.approve.mobileStructureApprove_review', $data);
            } else if ($type === "approver") {
                $data['mobileData'] = ExpenseMobile::select('expense_mobile.*')
                    ->join('EmpID_Name', 'expense_mobile.EmployeeID', '=', 'EmpID_Name.empid')
                    ->join('expense_matrix', 'EmpID_Name.loc', '=', 'expense_matrix.location')
                    ->where('expense_matrix.EmployeeID', '=', $employeeID)
                    ->where('expense_matrix.is_approver', '=', 'Yes')
                    ->where('expense_mobile.reviewerStatus', '=', 'Approve')
                    ->where('expense_mobile.mgrStatus', '=', 'Pending')
                    ->get();
                $data['type'] = "approve";
                return view('reimbursement.approve.mobileStructureApprove_review', $data);
            } else {
                $employeeID = $request->input('EmployeeID');
                $mobileData = DB::table('expense_mobile')
                    ->where('EmployeeID', $employeeID)
                    ->orderBy('created_at')
                    ->get();
                return view('reimbursement.mobileStructure', ['mobileData' => $mobileData]);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function createReiseMobile(Request $request)
    {
        try {
            $userData = session("userDetails");
            if ($request->reqType === "review") {
                $validator = Validator::make($request->all(), [
                    'Reviewer' => 'required',
                    'mobileCommentReviewer' => 'required|min:3',
                ]);
                if ($validator->fails()) {
                    return response()->json(['error' => $validator->errors()], 400);
                } else {
                    $ExpenseMobile = ExpenseMobile::find($request->mobileID_);
                    if ($ExpenseMobile) {
                        $ExpenseMobile->reviewerStatus = $request->Reviewer;
                        $ExpenseMobile->reviewComment = $request->mobileCommentReviewer;
                        $ExpenseMobile->modified_at = now();
                        $ExpenseMobile->save();
                        return response()->json(['message' => 'Update successfully !!'], 200);
                    }
                }
            } else if ($request->reqType === "approve") {
                $ExpenseMobile = ExpenseMobile::find($request->mobileID_);
                $ExpenseMobile->mgrStatus = $request->Approver;
                $ExpenseMobile->mgrComment = $request->mobileCommentApprover;
                $ExpenseMobile->approverStatus = "Approved";
                $ExpenseMobile->modified_at = now();
                $ExpenseMobile->save();
                return response()->json(['message' => 'Update successfully !!'], 200);
            } else {
                $currentTime = now()->format('Y-m-d-His');
                $milliseconds = round(microtime(true) * 1000);
                $validator = Validator::make($request->all(), [
                    'mobileDate' => 'required',
                    'mobileAmount' => 'required',
                    'mobileReceiptNo' => 'required',
                    'mobileRemakrs' => 'required|min:3',
                    'mobileReceiptFile' => 'required|mimes:jpeg,png,jpg,gif,pdf|max:2048'
                ]);

                if ($validator->fails()) {
                    return response()->json(['error' => $validator->errors()], 400);
                } else {
                    $MobFile = $request->file('mobileReceiptFile');
                    $path = public_path('reimbursement/ExpenseMobile');
                    $extfile = $MobFile->getClientOriginalExtension();
                    $filePath = "{$userData[0]['EmployeeID']}_{$currentTime}_{$milliseconds}.{$extfile}";
                    $MobFile->move($path, $filePath);


                    ExpenseMobile::create([
                        "EmployeeID" => $userData[0]['EmployeeID'],
                        "empName" => $userData[0]['EmployeeName'],
                        "date" => $request->mobileDate,
                        "amount" => $request->mobileAmount,
                        "receipt_no" => $request->mobileReceiptNo,
                        "receipt_image" => $filePath,
                        "remarks" => $request->mobileRemakrs,
                        "req_status" => "Pending",
                        "reqType" => "MobileRequest",
                        "reviewerStatus" => "Pending",
                        "mgrStatus" => "Pending",
                        "approverStatus" => "Pending",
                    ]);

                    $mobileData = ExpenseMobile::where('EmployeeID', $userData[0]['EmployeeID'])
                        ->orderBy('created_at')
                        ->get();
                    return response()->json(['message' => 'Mobile expense record created successfully', 'mobileData' => $mobileData], 200);
                }
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function deleteRaiseMobile(Request $request)
    { {
            try {
                $userData = session("userDetails");
                $id = $request->input('id');

                $expenseMobile = ExpenseMobile::find($id);
                if (!$expenseMobile) {
                    return response()->json(['error' => 'Record not found'], 404);
                } else {
                    $file =  $expenseMobile->receipt_image;
                    if ($file !== null) {
                        $path = public_path('reimbursement/ExpenseMobile') . '/' . $file;
                        file_exists($path) ? unlink($path) : "";
                    }


                    ExpenseLog::create([
                        "EmployeeID" => $expenseMobile->EmployeeID,
                        "empName" => $expenseMobile->empName,
                        "date" => $expenseMobile->date,
                        "reqType" => $expenseMobile->reqType,
                        "remarks" => $expenseMobile->remarks,
                    ]);

                    $expenseMobile->delete();

                    $mobileData = ExpenseMobile::where('EmployeeID', $userData[0]['EmployeeID'])
                        ->orderBy('created_at')
                        ->get();
                    return response()->json(['message' => 'Mobile expense Deleted successfully', 'mobileData' => $mobileData], 200);
                }
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
    }
    /* End Mobile */

    /* Start Miscellaneous  */

    public function getMiscellaneousData(Request $request)
    {
        try {
            $type = $request->input('reqType');
            $employeeID = $request->input('EmployeeID');
            if ($type === "review") {
                $data['miscData'] = ExpenseMiscellaneous::select('expense_miscellaneous.*')
                    ->join('EmpID_Name', 'expense_miscellaneous.EmployeeID', '=', 'EmpID_Name.empid')
                    ->join('expense_matrix', 'EmpID_Name.loc', '=', 'expense_matrix.location')
                    ->where('expense_matrix.EmployeeID', '=', $employeeID)
                    ->where('expense_matrix.is_reviewer', '=', 'Yes')
                    ->where('expense_miscellaneous.reviewerStatus', '=', 'Pending')
                    ->get();
                $data['type'] = "review";
                return view('reimbursement.approve.miscellaneousApprove_review', $data);
            } else if ($type === "approver") {
                $data['miscData'] = ExpenseMiscellaneous::select('expense_miscellaneous.*')
                    ->join('EmpID_Name', 'expense_miscellaneous.EmployeeID', '=', 'EmpID_Name.empid')
                    ->join('expense_matrix', 'EmpID_Name.loc', '=', 'expense_matrix.location')
                    ->where('expense_matrix.EmployeeID', '=', $employeeID)
                    ->where('expense_matrix.is_approver', '=', 'Yes')
                    ->where('expense_miscellaneous.reviewerStatus', '=', 'Approve')
                    ->where('expense_miscellaneous.mgrStatus', '=', 'Pending')
                    ->get();
                $data['type'] = "approve";
                return view('reimbursement.approve.miscellaneousApprove_review', $data);
            } else {
                $employeeID = $request->input('EmployeeID');
                $miscellaneousData = DB::table('expense_miscellaneous')
                    ->where('EmployeeID', $employeeID)
                    ->orderBy('created_at')
                    ->get();
                return view('reimbursement.miscellaneousStructure', ['miscellaneousData' => $miscellaneousData]);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function createReiseMiscellaneous(Request $request)
    {
        try {


            if ($request->reqType === "review") {
                $validator = Validator::make($request->all(), [
                    'Reviewer' => 'required',
                    'miscCommentReviewer' => 'required|min:3',
                ]);
                if ($validator->fails()) {
                    return response()->json(['error' => $validator->errors()], 400);
                } else {
                    $ExpenseMiscellaneous = ExpenseMiscellaneous::find($request->miscID_);
                    if ($ExpenseMiscellaneous) {
                        $ExpenseMiscellaneous->reviewerStatus = $request->Reviewer;
                        $ExpenseMiscellaneous->reviewComment = $request->miscCommentReviewer;
                        $ExpenseMiscellaneous->modified_at = now();
                        $ExpenseMiscellaneous->save();
                        return response()->json(['message' => 'Update successfully !!'], 200);
                    }
                }
            } else if ($request->reqType === "approve") {
                $ExpenseMiscellaneous = ExpenseMiscellaneous::find($request->miscID_);
                $ExpenseMiscellaneous->mgrStatus = $request->Approver;
                $ExpenseMiscellaneous->mgrComment = $request->miscCommentApprover;
                $ExpenseMiscellaneous->approverStatus = "Approved";
                $ExpenseMiscellaneous->modified_at = now();
                $ExpenseMiscellaneous->save();
                return response()->json(['message' => 'Update successfully !!'], 200);
            } else {

                $currentTime = now()->format('Y-m-d-His');
                $milliseconds = round(microtime(true) * 1000);
                $userData = session("userDetails");
                $validator = Validator::make($request->all(), [
                    'miscellaneousDate' => 'required',
                    'miscellaneousAmount' => 'required',
                    'miscellaneousReceiptNo' => 'required',
                    'miscellaneousRemakrs' => 'required|min:3',
                    'miscellaneousReceiptFile' => 'required|mimes:jpeg,png,jpg,gif,pdf|max:2048'
                ]);

                if ($validator->fails()) {
                    return response()->json(['error' => $validator->errors()], 400);
                } else {

                    $misFile = $request->file('miscellaneousReceiptFile');
                    $path = public_path('reimbursement/ExpenseMiscellaneous');
                    $extfile = $misFile->getClientOriginalExtension();
                    $filePath = "{$userData[0]['EmployeeID']}_{$currentTime}_{$milliseconds}.{$extfile}";
                    $misFile->move($path, $filePath);

                    ExpenseMiscellaneous::create([
                        "EmployeeID" => $userData[0]['EmployeeID'],
                        "empName" => $userData[0]['EmployeeName'],
                        "date" => $request->miscellaneousDate,
                        "amount" => $request->miscellaneousAmount,
                        "receipt_no" => $request->miscellaneousReceiptNo,
                        "receipt_image" => $filePath,
                        "remarks" => $request->miscellaneousRemakrs,
                        "req_status" => "Pending",
                        "reqType" => "MiscellaneousRequest",
                        "reviewerStatus" => "Pending",
                        "mgrStatus" => "Pending",
                        "approverStatus" => "Pending",
                    ]);

                    $miscellaneousData = ExpenseMiscellaneous::where('EmployeeID', $userData[0]['EmployeeID'])
                        ->orderBy('created_at')
                        ->get();
                    return response()->json(['message' => 'Miscellaneous expense record created successfully', 'miscellaneousData' => $miscellaneousData], 200);
                }
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function deleteRaiseMiscellaneous(Request $request)
    { {
            try {
                $userData = session("userDetails");
                $id = $request->input('id');

                $expenseMiscellaneous = ExpenseMiscellaneous::find($id);
                if (!$expenseMiscellaneous) {
                    return response()->json(['error' => 'Record not found'], 404);
                } else {
                    $file =  $expenseMiscellaneous->receipt_image;
                    if ($file !== null) {
                        $path = public_path('reimbursement/ExpenseMiscellaneous') . '/' . $file;
                        file_exists($path) ? unlink($path) : "";
                    }
                    ExpenseLog::create([
                        "EmployeeID" => $expenseMiscellaneous->EmployeeID,
                        "empName" => $expenseMiscellaneous->empName,
                        "date" => $expenseMiscellaneous->date,
                        "reqType" => $expenseMiscellaneous->reqType,
                        "remarks" => $expenseMiscellaneous->remarks,
                    ]);

                    $expenseMiscellaneous->delete();
                    $miscellaneousData = ExpenseMiscellaneous::where('EmployeeID', $userData[0]['EmployeeID'])
                        ->orderBy('created_at')
                        ->get();
                    return response()->json(['message' => 'Miscellaneous expense record Delete successfully', 'miscellaneousData' => $miscellaneousData], 200);
                }
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
    }


    /* For Review Reimbrusment */

    public function viewReview()
    {
        try {
            return view('reimbursement.reviewer');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /* For Approve Reimbrusment */
    public function viewApprove()
    {
        try {
            return view('reimbursement.approve');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function viewReport()
    {
        try {
            return view('reimbursement.report');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function getReport(Request $request)
    {
        try {


            $dates = explode(' - ', $request->DateFrom_To);
            $startDate = $dates[0];
            $endDate = $dates[1];
            $foodData = "";
            if ($request->reimbursement_type === "food") {
                $results = EmployeeMap::join('EmpID_Name as t2', 'employee_map.EmployeeID', '=', 't2.EmpID')
                    ->join('new_client_master as t3', 'employee_map.cm_id', '=', 't3.cm_id')
                    ->join('client_master as t4', 't3.client_name', '=', 't4.client_id')
                    ->join('df_master as t5', 'employee_map.df_id', '=', 't5.df_id')
                    ->join('designation_master as t6', 't5.des_id', '=', 't6.ID')
                    ->join('location_master as t7', 't2.loc', '=', 't7.id')
                    ->join('expense_food as ef', 'ef.EmployeeID', '=', 't2.EmpID')
                    ->select('ef.*', 't4.client_name', 't3.process', 't3.sub_process', 't6.Designation', 't7.location')
                    ->whereBetween(DB::raw('DATE(ef.created_at)'), [$startDate, $endDate])
                    ->get();
                $totalCount = $results->count();
                $dataType = 'Food';

                $successMessage = $totalCount . ' Data Found !!';
                if (!empty($results)) {
                    Session::flash('success', $successMessage);
                    return view('reimbursement.report', compact('results', 'dataType'));
                } else {
                    return redirect()->back()->withInput()->with('success', $successMessage);
                }
            } else if ($request->reimbursement_type === "travel") {
                $results = EmployeeMap::join('EmpID_Name as t2', 'employee_map.EmployeeID', '=', 't2.EmpID')
                    ->join('new_client_master as t3', 'employee_map.cm_id', '=', 't3.cm_id')
                    ->join('client_master as t4', 't3.client_name', '=', 't4.client_id')
                    ->join('df_master as t5', 'employee_map.df_id', '=', 't5.df_id')
                    ->join('designation_master as t6', 't5.des_id', '=', 't6.ID')
                    ->join('location_master as t7', 't2.loc', '=', 't7.id')
                    ->join('expense_travel as et', 't2.EmpID', '=', 'et.EmployeeID')
                    ->whereBetween(DB::raw('DATE(et.created_at)'), [$startDate, $endDate])
                    ->select('et.*', 't4.client_name', 't3.process', 't3.sub_process', 't6.Designation', 't7.location')
                    ->get();
                $totalCount = $results->count();
                $dataType = 'Travel';
                $successMessage = $totalCount . ' Data Found !!';
                if (!empty($results)) {
                    Session::flash('success', $successMessage);
                    return view('reimbursement.report', compact('results', 'dataType'));
                } else {
                    return redirect()->back()->withInput()->with('success', $successMessage);
                }
            } else if ($request->reimbursement_type === "hotel") {
                $results = EmployeeMap::join('EmpID_Name as t2', 'employee_map.EmployeeID', '=', 't2.EmpID')
                    ->join('new_client_master as t3', 'employee_map.cm_id', '=', 't3.cm_id')
                    ->join('client_master as t4', 't3.client_name', '=', 't4.client_id')
                    ->join('df_master as t5', 'employee_map.df_id', '=', 't5.df_id')
                    ->join('designation_master as t6', 't5.des_id', '=', 't6.ID')
                    ->join('location_master as t7', 't2.loc', '=', 't7.id')
                    ->join('expense_hotel as eh', 't2.EmpID', '=', 'eh.EmployeeID')
                    ->whereBetween(DB::raw('DATE(eh.created_at)'), [$startDate, $endDate])
                    ->select('eh.*', 't4.client_name', 't3.process', 't3.sub_process', 't6.Designation', 't7.location')
                    ->get();
                $totalCount = $results->count();
                $dataType = 'Hotel';
                $successMessage = $totalCount . ' Data Found !!';
                if (!empty($results)) {
                    Session::flash('success', $successMessage);
                    return view('reimbursement.report', compact('results', 'dataType'));
                } else {
                    return redirect()->back()->withInput()->with('success', $successMessage);
                }
            } else if ($request->reimbursement_type === "mobile") {
                $results = EmployeeMap::join('EmpID_Name as t2', 'employee_map.EmployeeID', '=', 't2.EmpID')
                    ->join('new_client_master as t3', 'employee_map.cm_id', '=', 't3.cm_id')
                    ->join('client_master as t4', 't3.client_name', '=', 't4.client_id')
                    ->join('df_master as t5', 'employee_map.df_id', '=', 't5.df_id')
                    ->join('designation_master as t6', 't5.des_id', '=', 't6.ID')
                    ->join('location_master as t7', 't2.loc', '=', 't7.id')
                    ->join('expense_mobile as eb', 't2.EmpID', '=', 'eb.EmployeeID')
                    ->whereBetween(DB::raw('DATE(eb.created_at)'), [$startDate, $endDate])
                    ->select('eb.*', 't4.client_name', 't3.process', 't3.sub_process', 't6.Designation', 't7.location')
                    ->get();
                $totalCount = $results->count();
                $dataType = 'Mobile';
                $successMessage = $totalCount . ' Data Found !!';
                if (!empty($results)) {
                    Session::flash('success', $successMessage);
                    return view('reimbursement.report', compact('results', 'dataType'));
                } else {
                    return redirect()->back()->withInput()->with('success', $successMessage);
                }
            } else if ($request->reimbursement_type === "miscellaneous") {
                $results = EmployeeMap::join('EmpID_Name as t2', 'employee_map.EmployeeID', '=', 't2.EmpID')
                    ->join('new_client_master as t3', 'employee_map.cm_id', '=', 't3.cm_id')
                    ->join('client_master as t4', 't3.client_name', '=', 't4.client_id')
                    ->join('df_master as t5', 'employee_map.df_id', '=', 't5.df_id')
                    ->join('designation_master as t6', 't5.des_id', '=', 't6.ID')
                    ->join('location_master as t7', 't2.loc', '=', 't7.id')
                    ->join('expense_miscellaneous as em', 't2.EmpID', '=', 'em.EmployeeID')
                    ->whereBetween(DB::raw('DATE(em.created_at)'), [$startDate, $endDate])
                    ->select('em.*', 't4.client_name', 't3.process', 't3.sub_process', 't6.Designation', 't7.location')
                    ->get();
                $totalCount = $results->count();
                $dataType = 'Miscellaneous';
                $successMessage = $totalCount . ' Data Found !!';
                if (!empty($results)) {
                    Session::flash('success', $successMessage);
                    return view('reimbursement.report', compact('results', 'dataType'));
                } else {
                    return redirect()->back()->withInput()->with('success', $successMessage);
                }
            } else {
                return redirect()->back()->withInput()->with('error', "Something Went Wrong !!");
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
