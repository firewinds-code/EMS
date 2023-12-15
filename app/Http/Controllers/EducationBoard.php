<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EducationBoardModel;
use Session;
use Validator;

class EducationBoard extends Controller
{

    public function __construct(EducationBoardModel $educationBoardModal)
    {
       $this->educationBoardModal = $educationBoardModal;
    }


   public function  educationBoardList()
    {
           try {
                   $lists = $this->educationBoardModal::all();
                return view('educationboard.list',compact('lists'));
           } catch (\Exception $tex) {

           }
    }

    public function editBoard($id =null)
    {

        if(isset($id))
        {
           $boardRow =  $this->educationBoardModal::where('id',$id)->first();
           if(isset($boardRow))
           {
             return response()->json(['row' => $boardRow ,'success' => true]);
           }
           return response()->json(['message' => 'Data Does Not Exists !' ,'error' => true]);
        }
    }

    public function updateBoard(Request $request)
    {

       try {

        if(isset($request->board_id))
        {
            $updateBoard =  $this->educationBoardModal::where('id', $request->board_id)->update(['board' =>$request->education_board]);
                return response()->json(['message' => 'Board Updated Successfully !' ,'success' => true]);
        }


        $validator = Validator::make($request->all(), [
            'education_board'    =>  'required|unique:education_board,board'
            ]);

        if ($validator->fails()) {
            return response()->json(['error' =>true ,'message' => 'Education Board Already Exists ']);
        }

        $insertBoard =  $this->educationBoardModal::insert(['board' => $request->education_board , 'createdby' => Session::get('EmployeeID')]);
        if($insertBoard)
        {
            return response()->json(['message' => 'Board Created Successfully !' ,'success' => true]);
        }
        return response()->json(['message' => 'Board Created Failed !','error' => true]);

        } catch (\Exception $ex) {
            return response()->json(['message' => 'Something Went Wrong !', 'error' => true]);
        }

    }



}
