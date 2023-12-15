<?php

namespace App\Models\Ithm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IthmModel extends Model
{
    use HasFactory;
    protected $table = "ithdk_master_email_address";
    protected $fillable = ['id', 'email', 'emailType', 'location', 'createdBy','createdDate'];
}