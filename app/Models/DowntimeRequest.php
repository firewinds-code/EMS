<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DowntimeRequest extends Model
{
    use HasFactory;

    protected $table = 'downtimereqid1';

    public $timestamps = false;

    protected $fillable = [' oldid', 'Process', 'SubProcess', 'QualityID', 'TrainingID', 'OpsID', 'HRID', 'ITID', 'ReportsTo', 'updated_on', 'cm_id'];


}
