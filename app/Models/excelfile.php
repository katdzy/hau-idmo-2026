<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class excelfile extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'code', 'department', 'logo', 'updated_at' , 'created_at'
    ];
}
