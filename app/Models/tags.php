<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tags extends Model
{
    use HasFactory;

    protected $table = 'tbl_tags'; 
    protected $fillable = [
        'id', 
        'category', 
        'item', 
        'updated_at',
        'created_at'
    ];
}
