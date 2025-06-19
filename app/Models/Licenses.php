<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licenses extends Model
{
    use HasFactory;
    
    public function request() { 
        return $this-> belongsTo(requests::class, 'id','id');
    }

    protected $primaryKey = 'id'; 
    protected $fillable=[ 

        'id', 
        'emp_id',
        'title', 
        'type', 
        'date_obtained', 
        'attachment', 
        'status', 
        'updated_at', 
        'created_at'
    ]; 

    protected $casts = [ 
        'id'=> 'string'
    ];
}
