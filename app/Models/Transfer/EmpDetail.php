<?php

namespace App\Models\Transfer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpDetail extends Model
{
    use HasFactory;
    protected $table = "emp_details";
    protected $fillable = ['EmployeeID', 'EmployeeName', 'designation', 'process', 'subprocess','ReportTo'];
}