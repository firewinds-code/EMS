<?php

namespace App\Models\Reimbursement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ExpenseFood extends Model
{
   use HasFactory;
   protected $table = "expense_food";
   protected $fillable = ['id', 'EmployeeID', 'empName', 'date', 'amount', 'receipt_no', 'receipt_image', 'remarks', 'req_status', 'reqType', 'mgrComment', 'mgrStatus', 'approverStatus', 'reviewerStatus', 'reviewComment', 'created_at', 'modified_at', 'updated_at'];
}
