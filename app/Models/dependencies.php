<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dependencies extends Model
{
    use HasFactory;

    public function user() { 
        return $this-> belongsTo(Employee::class, 'emp_id', 'emp_id' ); 
    }

    protected $table = 'dependencies'; 
    protected $primaryKey = 'id'; 
    protected $fillable = [ 
        'id', 
        'emp_id', 
        'fname',
        'mname',
        'lname', 
        'date_of_birth', 
        'relationship',
        'status',
        'attachment',
        'updated_at', 
        'created_at' 
    ];

    protected $casts = [
        'id' => 'string', // Ensure 'id' is cast to string
    ];
    
}
