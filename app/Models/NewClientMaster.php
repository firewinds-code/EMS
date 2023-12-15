<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class NewClientMaster extends Model
{
   use HasFactory;

   protected $table = "new_client_master";

   protected $fillable = ['cm_id', 'oldcm_id', 'client_name', 'oldclient_name', 'account_head', 'dept_id', 'process', 'location', 'oh', 'qh', 'th', 'er_scop', 'er_spoc2', 'er_spoc3', 'er_spoc4', 'sub_process', 'createdon', 'createdby', 'modifiedby', 'modifiedon', 'Stipend', 'StipendDays', 'days_from_joining', 'days_from_floor', 'days_of_rotation', 'VH', 'excep_spoc', 'SiteSpoc', 'leave1_empid', 'leave2_empid', 'process_head'];

   public $timestamps = false;
}
