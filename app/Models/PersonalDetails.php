<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PersonalDetails extends Model
{
   use HasFactory;
   protected $table = "personal_details";
   protected $fillable = ['emp_id', 'EmployeeID', 'INTID', 'EmployeeName', 'FirstName', 'MiddleName', 'LastName', 'DOB', 'FatherName', 'MotherName', 'Gender', 'BloodGroup', 'MarriageStatus', 'Spouse', 'MarriageDate', 'ChildStatus', 'createdby', 'createdon', 'modifiedby', 'modifiedon', 'img', 'ref_id', 'ref_txt', 'primary_language', 'secondary_language', 'first_dod', 'day_stpn', 'location', 'spouse_dob', 'nominee_name', 'nominee_relation', 'father_dob', 'mother_dob', 'dstatus', 'total_experience'];
}
