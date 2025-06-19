<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class emergency extends Model
{
    use HasFactory;

    public function user() { 
        return $this-> belongsTo(Employee::class, 'emp_id', 'emp_id'); 
    }
    protected $table = 'tbl_emergency'; 
    protected $primaryKey = 'emp_id';
    protected $fillable = [
        'id', 
        'cp_fname', 
        'cp_mname', 
        'cp_lname', 
        'cp_relationship',
        'cp_house_no',
        'cp_street', 
        'cp_city', 
        'cp_province', 
        'cp_postal_code',
        'cp_home_phone', 
        'cp_mobile_no',
        
    ];


}
