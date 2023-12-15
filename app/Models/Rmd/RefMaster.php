<?php

namespace App\Models\Rmd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefMaster extends Model
{
    use HasFactory;
    protected $table = "ref_master";
    protected $fillable = ['Type', 'ContactPerson', 'ContactNo', 'RefName', 'Payout', 'Status', 'ModifiedBy', 'ModifiedOn'];
    public $timestamps = false;
}