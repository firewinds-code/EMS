<?php

namespace App\Models\ithm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class location_master extends Model
{
    use HasFactory;
    protected $table = "location_master";
    protected $fillable = ['location'];  
}