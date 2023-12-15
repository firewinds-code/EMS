<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class DeginationMaster extends Model
{
   use HasFactory;
   protected $table = "designation_master";
   protected $fillable = ['ID', 'Designation', 'createdby', 'createdon', 'modifiedby', 'modifiedon', 'desigID'];
   public $timestamps = false;


   public function getdesignation()
   {
    return $list = $this->all();
   }
}
