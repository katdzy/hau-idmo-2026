<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    protected $table = 'publications';
    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
        'id','emp_id','title','description','attachment','file_path',
        'journal_type','date_published','status','created_at','updated_at'
    ];

    // Add this relationship
    public function coauthors()
    {
        return $this->hasMany(PublicationCoauthor::class, 'publication_id', 'id');
    }
}
