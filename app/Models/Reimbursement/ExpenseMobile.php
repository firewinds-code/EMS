<?php

namespace App\Models\Reimbursement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ExpenseMobile extends Model
{
   use HasFactory;
   protected $table = "expense_mobile";
   protected $fillable = ['id', 'EmployeeID', 'empName', 'amount', 'remarks', 'receipt_no', 'receipt_image', 'date', 'req_status', 'reqType', 'mgrComment', 'reviewComment', 'mgrStatus', 'approverStatus', 'reviewerStatus', 'created_at', 'modified_at', 'updated_at'];
}
