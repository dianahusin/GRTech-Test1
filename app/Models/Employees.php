<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    protected $table = 'employees';

    public function companyName()
    {
        return $this->belongsTo(Companies::class, 'company', 'id');
    }

    public function setFullName($firstname,$lastname)
    {
        return $this->attributes['fullname'] = $firstname . ' ' . $lastname;
    }
}


