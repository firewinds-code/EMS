<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class certificationrequirebycmid extends Model
{
    use HasFactory;
    protected $table ="certification_require_by_cmid";
    protected $fillable = ['ID', 'oldid', 'cm_id', 'cert_name', 'filename', 'createdby','createdon','updatedby','updatedon'];
}
