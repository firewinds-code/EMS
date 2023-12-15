<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Status_table extends Model
{
   use HasFactory;
   protected $table = "status_table";
   protected $fillable = ['ID', 'EmployeeID', 'Status', 'ReportTo', 'Qa_ops', 'BatchID', 'createdon', 'InTraining', 'InOJT', 'OnFloor', 'OutTraining', 'InQAOJT', 'OutOJTQA', 'RetrainTime', 'roster', 'reOJT', 'mapped_date', 'TL'];
}
