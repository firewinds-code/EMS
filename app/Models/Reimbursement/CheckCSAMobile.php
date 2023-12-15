<?php

namespace App\Models\Reimbursement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CheckCSAMobile extends Model
{
   use HasFactory;
   protected $table = "expense_mobile_csa";
   protected $fillable = ['id', 'empid', 'created_at'];
}
