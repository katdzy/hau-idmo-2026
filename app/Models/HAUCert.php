<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HAUCert extends Model
{
    use HasFactory;
    

    protected $table = 'hau_certs'; 

       
    protected $primaryKey = 'id'; 

    protected $fillable = [ 
        'id', 
        'attachment', 
        'date_issued', 'file_path', 'issued_by', 
        'duration', 'cert_title', 
        'cert_validity', 'cert_type', 
        'role', 
        'created_by', 
        'created_at', 'updated_at'
    ]; 

    protected $casts = [ 
        'id'=> 'string'
    ];
     


}
