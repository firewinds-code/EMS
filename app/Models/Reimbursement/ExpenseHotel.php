<?php

namespace App\Models\Reimbursement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ExpenseHotel extends Model
{
   use HasFactory;
   protected $table = "expense_hotel";
   protected $fillable = ['id', 'EmployeeID', 'empName', 'dateFrom', 'dateTo', 'noOfdays', 'location', 'client_name', 'hotelName', 'amount', 'receipt_no', 'receipt_image', 'remarks', 'req_status', 'reqType', 'mgrComment', 'reviewComment', 'mgrStatus', 'approverStatus', 'reviewerStatus', 'created_at', 'modified_at', 'updated_at'];
}
