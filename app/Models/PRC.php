<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class PRC extends Model
{
    protected $table = 'prc';
    protected $primaryKey = 'id';
    public $incrementing = false;

    public function takers(){
        return $this-> hasMany(PrcTakers::class, 'exam_id', 'id'); 
    } 

    protected $fillable = [
        'id',
        'title',
        'exam_date',
    ];
}
