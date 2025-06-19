<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class certifications_entries extends Model
{
    use HasFactory;

    protected $table = 'certifications_entries'; 
    protected $primaryKey = 'emp_id'; 

    protected $fillable = [
        'emp_id','entries','updated_at','created_at' 
    ]; 


    
}
