<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class provincial_contact extends Model
{
    use HasFactory;

    public function user() 
    { 
        return $this->belongsTo(Employee::class, 'id', 'emp_id');
    }

    protected $table = 'tbl_provincial_contact';
    protected $primaryKey = 'id';  

    protected $fillable = [
        'id', 
        'pc_emp_houseno', 
        'pc_street', 
        'pc_brgy',  
        'pc_city', 
        'pc_province',  
        'pc_postal_code',
        'pc_phone',
    ];

}
