<?php

namespace App\Models\wmt;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailTemplate extends Model
{
    use HasFactory;
    protected $table = "mail_template";
    protected $fillable = ['name', 'email', 'contact_no', 'doj', 'designation', 'immediate_manager', 'assignment', 'linkdinLink', 'flag', 'ModifiedBy'];
    public $timestamps = false;
}
