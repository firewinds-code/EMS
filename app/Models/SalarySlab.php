<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalarySlab extends Model
{
    use HasFactory;

    protected $table = 'tbl_salary_slab_by_cps';

    public $timestamps = false;
}
