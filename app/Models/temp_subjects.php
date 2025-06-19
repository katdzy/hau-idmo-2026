<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class temp_subjects extends Model
{
    protected $fillable = [ 
        'subj_code', 
        'subj_title', 
        'units',
        'subj_sy' 
    ];
}
