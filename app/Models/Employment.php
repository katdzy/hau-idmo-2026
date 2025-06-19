<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employment extends Model
{
    use HasFactory;
    
    public function request()
    {
        return $this->belongsTo(requests::class, 'id', 'id');

    }
    protected $primaryKey = 'id'; 
    protected $fillable= [
        'id',
        'position', 
        'emp_id' ,
       'company',
       'date_hired',
       'date_resigned',
      'reason' ,
      'status',
      'attachment',
      'updated_at',
      'created_at'
      
    ];

    protected $casts = [ 

        'id'=> 'string'
    ];
}
