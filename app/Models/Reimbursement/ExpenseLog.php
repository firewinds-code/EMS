<?php

namespace App\Models\Reimbursement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ExpenseLog extends Model
{
   use HasFactory;
   protected $table = "expense_log";
   protected $fillable = ['id', 'EmployeeID', 'empName', 'date', 'reqType', 'remarks', 'created_at', 'updated_at'];
}
