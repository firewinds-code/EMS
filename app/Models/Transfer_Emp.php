<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer_Emp extends Model
{
    use HasFactory;
    protected $table = "transfer_emp";
    protected $fillable = ['id', 'EmployeeID', 'old_loc', 'location', 'client_name', 'process', 'sub_process', 'reports_to', 'transfer_date', 'createdon'];
}
