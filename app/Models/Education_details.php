<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Education_details extends Model
{
   use HasFactory;
   protected $table = "education_details";
   protected $fillable = ['edu_id', 'oldedu_id', 'edu_level', 'edu_name', 'specialization', 'board', 'college', 'edu_type', 'division', 'EmployeeID', 'edu_file', 'createdon', 'createdby', 'modifiedon', 'modifiedby', 'percentage', 'passing_year', 'INTID'];
}
