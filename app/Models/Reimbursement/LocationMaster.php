<?php

namespace App\Models\Reimbursement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class LocationMaster extends Model
{
   use HasFactory;
   protected $table = "location_master";
   protected $fillable = ['id','location'];
}