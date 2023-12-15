<?php

namespace App\Http\Controllers\Message;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function viewMessageByAdmin(Request $request)
    {
        try {
            if ($request->message_search == "search") {
                $dates = explode(' - ', $request->DateFrom);
                $startDate = $dates[0];
                $endDate = $dates[1];
                $messages = DB::table('tbl_chat_message as t1')
                    ->select('t1.ID', 't1.ackstatus', 't1.msg_date', 't1.text_msg', 't1.to_empid', 't1.sender_empid', 't1.sender_name', 't2.EmployeeName')
                    ->join('personal_details as t2', 't1.to_empid', '=', 't2.EmployeeID')
                    ->orderBy('msg_date', 'asc')
                    ->whereBetween('msg_date', [$startDate, $endDate])
                    ->get();

                if ($messages) {
                    return  response()->json(['success' => true, 'html' => view('ajax.message.table', compact('messages'))->render()]);
                } else {
                    return  response()->json(['error' => true, 'message' => 'Something Went Wrong !']);
                }
            } else {
                $messages = DB::table('tbl_chat_message as t1')
                    ->select('t1.ID', 't1.ackstatus', 't1.msg_date', 't1.text_msg', 't1.to_empid', 't1.sender_empid', 't1.sender_name', 't2.EmployeeName')
                    ->join('personal_details as t2', 't1.to_empid', '=', 't2.EmployeeID')
                    ->orderBy('msg_date', 'desc')
                    ->limit(500)
                    ->get();
                if ($messages) {
                    return  response()->json(['success' => true, 'html' => view('ajax.message.table', compact('messages'))->render()]);
                } else {
                    return  response()->json(['error' => true, 'message' => 'Something Went Wrong !']);
                }
            }
        } catch (Exception $e) {
            return  response()->json(['error' => true, 'message' => 'Something Went Wrong from catch!']);
        }
    }

    public function view(Request $request)
    {
        try {
            if ($request->message_search == "search") {
                $dates = explode(' - ', $request->DateFrom);
                $startDate = $dates[0];
                $endDate = $dates[1];
                $messages = DB::table('tbl_chat_message as t1')
                    ->select('t1.ID', 't1.ackstatus', 't1.msg_date', 't1.text_msg', 't1.to_empid', 't1.sender_empid', 't1.sender_name', 't2.EmployeeName')
                    ->join('personal_details as t2', 't1.to_empid', '=', 't2.EmployeeID')
                    ->orderBy('msg_date', 'asc')
                    ->whereBetween('msg_date', [$startDate, $endDate])
                    ->get();
                if ($request->ajax()) {
                    if ($messages) {
                        return  response()->json(['success' => true, 'html' => view('ajax.message.table', compact('messages'))->render()]);
                    } else {
                        return  response()->json(['error' => true, 'message' => 'Something Went Wrong !']);
                    }
                }
                if ($messages) {
                    return view('message/message', compact('messages'));
                } else {
                    return back()->with(['error', 'Data Not Found !']);
                }
            } else {
                $messages = DB::table('tbl_chat_message as t1')
                    ->select('t1.ID', 't1.ackstatus', 't1.msg_date', 't1.text_msg', 't1.to_empid', 't1.sender_empid', 't1.sender_name', 't2.EmployeeName')
                    ->join('personal_details as t2', 't1.to_empid', '=', 't2.EmployeeID')
                    ->orderBy('msg_date', 'desc')
                    ->limit(500)
                    ->get();
                if ($request->ajax()) {
                    if ($messages) {
                        return  response()->json(['success' => true, 'html' => view('ajax.message.table', compact('messages'))->render()]);
                    } else {
                        return  response()->json(['error' => true, 'message' => 'Something Went Wrong !']);
                    }
                }
                if ($messages) {
                    return view('message/message', compact('messages'));
                } else {
                    return back()->with(['error', 'Data Not Found !']);
                }
            }
        } catch (Exception $e) {
            return back()->with("error", "Something Went Wrong");
        }
    }

    public function updateMessage(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'message' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => true, 'message' => $validator->errors()->all()]);
            }

            $acknowledge = $request->message;
            $acknowledgedate = now();
            $ackstatus = "1";
            $id = $request->message_id;

            // Insert data into the database
            $newMessage = DB::table('tbl_chat_message')->where('ID', $id)->update([
                'acknowledge' => $acknowledge,
                'acknowledgedate' => $acknowledgedate,
                'ackstatus' => $ackstatus,
            ]);

            if ($newMessage) {
                return response()->json(['success' => true,  'message' => "Acknowledgement Inserted Successfully."]);
            }
            return response()->json(['error' => true, 'message' => "Something Went Wrong"]);
        } catch (\Exception $ex) {
            // dd($ex->getMessage());
            return response()->json(['error' => true, 'message' => "Something Went Wrong"]);
        }
    }
}