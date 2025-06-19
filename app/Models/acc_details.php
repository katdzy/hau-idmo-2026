<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class acc_details extends Model
{
    use HasFactory;

    public function user() { 
        return $this-> belongsTo(Employee::class, 'emp_id', 'emp_id' ); 
    }

    protected $table = 'tbl_accounting_details'; 
    protected $primaryKey = 'emp_id';
    protected $fillable = [
        'emp_id', 
        'sss_no', 
        'tax_no', 
        'pagibig_no',
        'philhealth_no'
    ]; 
}
