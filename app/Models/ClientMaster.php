<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ClientMaster extends Model
{
   use HasFactory;
   protected $table = "client_master";
   protected $fillable = ['client_id', 'client_name', 'createdon', 'createdby', 'modifiedon', 'modifiedbyexit'];
   public $timestamps = false;
}
