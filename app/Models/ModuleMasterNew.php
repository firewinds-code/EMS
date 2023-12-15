<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleMasternew extends Model
{
    protected $table = 'module_master_new';
    public $timestamps = false;
    protected $fillable = [
        'module_name',
        'EmployeeID',
        'level',
        'l1empid',
        'l1name',
        'l2empid',
        'l2name',
        'CreatedBy'
    ];
}







