<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orgs extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

     // it is NOT auto-incrementing
     public $incrementing = false;

     // it’s a string (not an integer)
     protected $keyType = 'string';

    public function user() { 
        return $this-> belongsTo(Employee::class, 'emp_id', 'emp_id'); 
    }


    protected $fillable = [
           'id',
           'emp_id', 
           'org', //org name
           'position', 
           'date_joined', 
           'status',
           'attachment',
           'added_by'
    ];

}
