<?php

namespace App\Models\Reimbursement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ExpenseMatrix extends Model
{
   use HasFactory;
   protected $table = "expense_matrix";
   protected $fillable = ['id', 'EmployeeID', 'is_reviewer', 'is_approver', 'location'];
}
