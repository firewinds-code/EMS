<?php

namespace App\Http\Controllers\BankMaster;

use App\Http\Controllers\Controller;
use App\Models\Bankmaster;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BankmasterController extends Controller
{
    public function view()
    {
        try {
            $results = DB::table('bank_master')->get();
            // dd( $results->BankName);
            return view('bankmaster.bankMaster', compact('results'));
        } catch (\Exception $e) {
            return back();
        }
    }
    public function addbank(Request $request)
    {
        try {
            $BankName = $request->BankName;
            $condition = DB::table('bank_master')->insert([
                'BankName' => $BankName
            ]);
            if ($condition) {
                return response()->json(['success' => true, 'message' => 'Bank Details Added Successfully']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Bank already Exits']);
        }
    }

    // public function save(Request $request)
    // {
    //     try {

    //         $validatedData = $request->validate([
    //             'editBankName' => 'required',
    //             'id' => 'required',
    //         ]);
    //         $dataToUpdate = [
    //             'BankName' => $validatedData['editBankName']
    //         ];
    //         $isDuplicate = Bankmaster::where('BankName', $validatedData['editBankName'])->count();

    //         if ($isDuplicate) {
    //             return response()->json(['error' => true, 'message' => 'Bank Name already exists.', 'code'=> 402 ]);
    //         }
    //         else {
    //             $updated = Bankmaster::where('id', $validatedData['id'])->update($dataToUpdate);
    //             if ($updated) {
    //                 return response()->json(['success' => true, 'message' => 'Record updated successfully!']);
    //             }
    //         }
    //     } catch (\Exception $e) {

    //         return response()->json(['error' => true, 'message' => 'An error occurred while updating the record.']);
    //     }
    // }

    public function save(Request $request)
    {
        try {

            $validatedData = $request->validate([
                'editBankName' => 'required',
                'id' => 'required',
            ]);
            $dataToUpdate = [
                'BankName' => $validatedData['editBankName']
            ];
            // $isDuplicate = Bankmaster::where('BankName', $validatedData['editBankName'])->count();

            // if ($isDuplicate) {
            //     return response()->json(['error' => true, 'message' => 'Bank Name already exists.', 'code'=> 402 ]);
            // }
            $updated = Bankmaster::where('id', $validatedData['id'])->update($dataToUpdate);
            if ($updated) {
                return response()->json(['success' => true, 'message' => 'Record updated successfully!']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Bank Already Exits!']);
        }
    }

    public function editbank($id)
    {
        try {
            $id = $id;
            $data = Bankmaster::where('id', $id)
                ->first();
            return response()->json(['success' => true, 'data' => $data]);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()->with("error", "Something Went Wrong");
        }
    }
}
