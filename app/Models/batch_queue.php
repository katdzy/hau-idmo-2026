<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class batch_queue extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->hasOne(Employee::class, 'emp_id', 'emp_id');
    
    }



    protected $fillable = [
        'emp_id', 
        'updated_at',
        'created_at'
    ];
}
