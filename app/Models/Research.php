<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Research extends Model
{
    use HasFactory;

    protected $table = 'researches';
    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
        'id','emp_id','title','description','attachment','file_path','status','created_at','updated_at'
    ];

    // Add this relationship
    public function coauthors()
    {
        return $this->hasMany(ResearchCoauthor::class, 'research_id', 'id');
    }
}
