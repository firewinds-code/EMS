<?php

namespace App\Models\Acknowladge;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class WeeklyCovid extends Model
{
   use HasFactory;
   protected $table = "ack_covid_weekly_form";
   protected $fillable = ['id', 'EmployeeID', 'Employeename', 'EmpMobile', 'empAddress', 'createdOn','created_at','updated_at'];
}
