<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Experince_details extends Model
{
   use HasFactory;
   protected $table = "experince_details";
   protected $fillable = ['exp_id', 'employer', 'location', 'from', 'to', 'designation', 'discription', 'contact_person', 'contact_no', 'releiving_experience_doc', 'appointment_offerletter_doc', 'salaryslip_bankstatement_doc', 'ClientIndustry', 'createdon', 'createdby', 'modifiedby', 'modifiedon', 'EmployeeID', 'exp_type', 'INTID'];
}
