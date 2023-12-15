<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Doc_details extends Model
{
   use HasFactory;
   protected $table = "doc_details";
   protected $fillable = ['doc_id', 'olddoc_id', 'doc_type', 'doc_stype', 'dov_value', 'doc_file', 'EmployeeID', 'createdon', 'INTID', 'createdby', 'modifiedby', 'modifiedon', 'aadhar_source'];
}
