<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    use HasFactory;

    public function loads()
    {
        return $this->hasMany(Loads::class, 'subj_id', 'subj_id');

    }

    public function loads_import() { 
        return $this->hasMany(LoadsImport::class,'subj_id' ,'subj_id'); 
    }


    protected $table = 'subjects'; 
    protected $primaryKey = 'subj_id'; 

    protected $fillable = [
        'subj_id', 
        'subj_code',
        'subj_title', 
        'subj_description',
        'subj_sy',
        'units'
    ]; 

    protected $casts = [ 
        'subj_id'=> 'string', 
        'subj_code'=> 'string' 
    ];
    
}
