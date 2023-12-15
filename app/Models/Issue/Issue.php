<?php

namespace App\Models\Issue;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;
    protected $table = "issue_master";
    protected $fillable = ['id', 'queary', 'bt', 'handler', 'tat', 'modifiedby', 'modifiedon'];
    public $timestamps = false;
}