<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuddyDowntime extends Model
{
    use HasFactory;

    protected $table = 'buddy_dtmatrix';

    public $timestamps = false;

    protected $fillable = ['cm_id', 'Min_Time', 'Max_Time'];

}
