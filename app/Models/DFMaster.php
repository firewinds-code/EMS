<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class DFMaster extends Model
{
   use HasFactory;
   protected $table = "df_master";
   protected $fillable = ['df_id', 'function_id', 'des_id'];
}
