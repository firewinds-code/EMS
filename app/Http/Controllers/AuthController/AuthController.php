<?php

namespace App\Http\Controllers\AuthController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login_Emp(Request $request)
    {
        try {
            $empID = $request->input('LoginId');
            $pass = $request->input('refrance');
            $hashPass = md5($pass);

            $result = DB::select("call app_get_login('$empID','$hashPass')");
            if (!empty($result)) {
                $resultArray = json_decode(json_encode($result), true);


                Session::put('EmployeeID', $resultArray[0]['EmployeeID']);
                Session::put('EmployeeName', $resultArray[0]['EmployeeName']);
                Session::put('userDetails', $resultArray);
                $expData = DB::table('expense_matrix')
                    ->where('EmployeeID', $empID)
                    ->get();

                if (count($expData) > 0) {
                    Session::put('reviewer', $expData[0]->is_reviewer);
                    Session::put('approver', $expData[0]->is_approver);
                }

                return redirect()->route('dashboard');
            } else {
                return redirect("/login?error=Invalid%20Credentials");
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function changePassword(Request $request)
    {
        try {
            $userData = session("userDetails");
            $employeeID = $userData[0]['EmployeeID'];

            $request->validate([
                'password' => ['required', 'string', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'],
                'confirmpassword' => 'required|same:password',
            ]);

            $newPassword = $request->input('password');
            $hashPass = md5($newPassword);

            $result = DB::selectOne("SELECT password FROM employee_map WHERE EmployeeID = ?", [$employeeID]);
            $oldPassword = $result->password;

            if ($hashPass === $oldPassword) {
                return response()->json(['message' => "Old password and new Password Can't be the same!", 'status' => false], 404);
            } else {
                $result = DB::select("call change_pwd(?, ?)", [$hashPass, $employeeID]);

                if ($result > 0) {
                    DB::update("UPDATE emp_auth SET flag = 0 WHERE EmployeeID = ?", [$employeeID]);
                    return response()->json(['message' => 'Password updated successfully!'], 200);
                } else {
                    return response()->json(['message' => "Something went wrong!", 'Type' => "pass1"], 404);
                }
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function changeSec(Request $request)
    {
        try {
            $userData = session("userDetails");
            $employeeID = $userData[0]['EmployeeID'];
            if ($request->type === "update") {
                $validator = Validator::make($request->all(), [
                    'Qns' => 'required',
                    'ans' => 'required',
                ]);

                if ($validator->fails()) {
                    return response()->json(['error' => $validator->errors()], 400);
                } else {
                    $result = DB::select("call change_sec(?,?,?)", [$request->Qns, $request->ans, $employeeID]);
                    if ($result > 0) {
                        return response()->json(['message' => 'Security updated successfully!'], 200);
                    } else {
                        return response()->json(['message' => "Something went wrong!", 'Type' => "ChangeSec"], 404);
                    }
                }
            } else {
                $result = DB::select("call get_ques(?)", [$employeeID]);
                $row = $result[0];
                return response()->json(['message' => 'successfully', 'secData' => $row], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    function logout(Request $request)
    {
        $request->session()->flush();
        $request->session()->invalidate();
        return redirect('dashboard');
    }
}
