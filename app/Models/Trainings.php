<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainings extends Model
{
    use HasFactory;

    public function request() { 
        return $this->belongsTo(requests::class, 'id','id'); 
    }

    protected $primaryKey = 'id';

    protected $fillable = [ 
        'id',
        'emp_id', 
        'title', 
        'type' , 
        'organization', 
        'start_date', 
        'end_date', 
        'hours', 
        'skills',
        'attachment', 
        'status', 
        'updated_at', 
        'created_at'
    ];

    protected $casts = [ 
        'id'=> 'string' 
    ];
}
