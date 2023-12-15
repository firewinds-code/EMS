<?php

namespace App\Models\Holidaylist;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Ho_list_admin extends Model
{
    use HasFactory;
    protected $table = "ho_list_admin";
    protected $fillable = ['id', 'DateOn', 'Reason', 'Associates', 'Support', 'location'];
}
