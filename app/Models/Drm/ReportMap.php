<?php

namespace App\Models\Drm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportMap extends Model
{
    use HasFactory;
    protected $table = "report_map";
    protected $fillable = ['EmpID', 'reportID','processID', 'CreatedBy'];
    public $timestamps = false;
}