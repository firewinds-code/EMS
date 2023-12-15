<?php

namespace App\Models\wmt;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactDetail extends Model
{
    use HasFactory;
    protected $table = "contact_details";
    protected $fillable = ['mobile', 'ofc_emailid'];
}