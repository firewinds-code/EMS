<?php

namespace App\Models\Salarymaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salary_master extends Model
{
    use HasFactory;
    protected $table = 'salary_master';
    protected $fillable = ['id', 'EmpID', 'location', 'created_at'];
}
