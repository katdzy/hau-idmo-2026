<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HiringInfo extends Model
{ 
    protected function user() {
        return $this->belongsTo(Employee::class, 'emp_id', 'emp_id'); 
    }

    protected $primaryKey = 'emp_id'; 
    protected $fillable = [ 
        'emp_id',
        'emp_position', 
        'emp_nature', 
        'emp_tenure',
        'non_tenured', 
        'license',
        'division',
        'emp_type' 
    ]; 
}
