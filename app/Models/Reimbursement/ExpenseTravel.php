<?php

namespace App\Models\Reimbursement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ExpenseTravel extends Model
{
   use HasFactory;
   protected $table = "expense_travel";
   protected $fillable = ['id', 'EmployeeID', 'empName', 'date', 'placeFrom', 'placeTO', 'modeOftravel', 'car_km', 'car_km_receipt', 'car_toll_receipt', 'car_parking_receipt', 'returnDate', 'amount', 'receipt_no', 'receipt_image', 'remarks', 'req_status', 'reqType', 'mgrComment', 'reviewComment', 'mgrStatus', 'approverStatus', 'reviewerStatus', 'created_at', 'modified_at', 'updated_at'];
}


