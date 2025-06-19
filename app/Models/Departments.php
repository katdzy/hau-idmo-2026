<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::updating(function ($department) {
            $originalCode = $department->getOriginal('code');
            $originalDept = $department->getOriginal('dept');
            if ($department->isDirty('code')) {
                // Update employees that reference the old department code
                \App\Models\Employee::where('emp_dept', $originalCode)
                    ->update(['emp_dept' => $department->code]);

                // Update loads that reference the department code
                \App\Models\Loads::where('class_dept', $originalCode)
                    ->update(['class_dept' => $department->code]);

                // Do the same for any other models referencing the department
            }
            if ($department->isDirty('dept')) {
                // Update employees that reference the old department name
                \App\Models\HAUCert::where('issued_by', $originalDept)
                    ->update(['issued_by' => $department->dept]);

                \App\Models\HiringHistory::where('division', $originalDept)
                    ->update(['division' => $department->dept]);
            }

        });
    }

    public function user() { 
        return $this-> belongsTo(Employee::class, 'emp_dept', 'code');
    }

    protected $fillable = [ 
        'code', 'dept', 'logo'
    ];
}
