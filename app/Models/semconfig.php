<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class semconfig extends Model
{


    

    protected $fillable = [ 
        'category',
        'current_sy', 

        'current_sem'
    ];
}
