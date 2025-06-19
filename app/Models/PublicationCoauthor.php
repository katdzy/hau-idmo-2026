<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicationCoauthor extends Model
{
    use HasFactory;

    protected $table = 'publication_coauthors';

    protected $fillable = [
        'publication_id',
        'coauthor_name',
        'coauthor_participation',
    ];

    // Relationship back to the main Publication
    public function publication()
    {
        return $this->belongsTo(Publication::class, 'publication_id', 'id');
    }
}
