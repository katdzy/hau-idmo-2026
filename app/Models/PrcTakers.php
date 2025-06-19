<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrcTakers extends Model
{
    protected $table = 'prc_takers';
    protected $primaryKey = 'id';
    public $incrementing = false;

    public function exam(){
        return $this-> belongsTo(PRC::class, 'exam_id', 'id');
    }

    protected $fillable = [
        'id',
        'exam_id',
        'school',
        'first_pass',
        'first_fail',
        'first_cond',
        'repeat_pass',
        'repeat_fail',
        'repeat_cond'
    ];
}
