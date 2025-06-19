<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    public function request()
    {
        return $this->belongsTo(requests::class, 'id', 'id');
    }

    protected $primaryKey = 'id'; 
    protected $fillable= [
        'id',
        'emp_id' ,
        'school_name',
        'start_date',
        'end_date',
        'education_type',
        'school_address',
        'awards',
        'grad_date',
        'last_sem',
        'so_num',
        'level',
        'degree',
        'status',
        'attachment',
        'updated_at',
        'created_at'
    ];

    protected $casts = [ 

        'id'=> 'string'
    ];
}
