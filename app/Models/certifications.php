<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class certifications extends Model
{
    use HasFactory;

    public function request()
    {
        return $this->belongsTo(requests::class, 'id', 'id');

    }

    public function user() 
    { 
        return $this->belongsTo(Employee::class, 'emp_id', 'emp_id'); 
    }

    protected $table = 'certifications'; 
    protected $primaryKey = 'id'; 
    protected $fillable = [ 
        'id', 
        'emp_id', 
        'attachment', 
        'date_issued', 'file_path', 'issued_by', 
        'duration', 'cert_title', 
        'cert_validity', 'cert_type', 
        'role',
        'status', 
        'hau_cert', //if the cert is from the admin 
        'created_at', 'updated_at'
    ]; 

    protected $casts = [ 
        'id'=> 'string'
    ]; 

    
}
