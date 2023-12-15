<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppraisalMaster extends Model
{
    use HasFactory;


    protected $table = 'apraisal_matrix';

    public $timestamps = false;
}
