<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class EmpIDName extends Model
{
   use HasFactory;
   protected $table = "EmpID_Name";
   protected $fillable = ['id', 'EmpID', 'EmpName', 'loc', 'FatherName', 'Gender', 'INTID', 'DOB', 'img', 'CreatedOn'];
}
