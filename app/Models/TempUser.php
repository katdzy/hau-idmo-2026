<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'emp_id',
        'emp_fname',
        'emp_mname',
        'emp_lname',
        'emp_dept',
        'emp_gender',
        'email_address_1',
        'email',
        'password',
        'role',
        // Add other fields as necessary
    ];
}
