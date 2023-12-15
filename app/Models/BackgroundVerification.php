<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BackgroundVerification extends Model
{
    use HasFactory;


    protected $table = 'bgv_matrix';

    public $timestamps = false;

    protected $fillable = ['cm_id','desig','Addr','Edu','Emp','Crim'];
}
