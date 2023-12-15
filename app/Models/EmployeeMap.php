<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class EmployeeMap extends Model
{
   use HasFactory;
   protected $table = "employee_map";
   protected $fillable = ['id', 'EmployeeID', 'df_id', 'cm_id', 'dateofjoin', 'password', 'emp_level', 'emp_status', 'secques', 'secans', 'createdon', 'createdby', 'modifiedon', 'modifiedby', 'flag', 'password_updated_time', 'dept_id'];
}
