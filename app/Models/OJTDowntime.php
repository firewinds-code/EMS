<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OJTDowntime extends Model
{
    use HasFactory;

    protected $table = 'downtime_time_master';

    public $timestamps = false;
}
