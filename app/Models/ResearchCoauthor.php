<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchCoauthor extends Model
{
    use HasFactory;

    protected $table = 'research_coauthors';

    protected $fillable = [
        'research_id',
        'coauthor_name',
        'coauthor_participation',
    ];

    // Relationship back to the main Research
    public function research()
    {
        return $this->belongsTo(Research::class, 'research_id', 'id');
    }
}
