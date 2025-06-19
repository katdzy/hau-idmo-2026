<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Client\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class LoadsImport extends Model
{


    public function user() { 
        return $this->belongsTo(Employee::class, 'emp_id', 'emp_id' );
    }

    public function subject() { 
        return $this->belongsTo(Subjects::class, 'subj_id', 'subj_id'); 
    }

    protected $fillable = [
        'emp_id', 'subj_id', 'class_code', 'class_dept', 'created_at', 'updated_at', 'semester', 'sy', 'created_at','added_by'
    ]; 
}
