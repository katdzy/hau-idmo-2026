<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KnowledgeHubLinks extends Model
{
    protected $table = 'knowledge_hub_links';

    protected $fillable = [
        'category',
        'sub_category',
        'type',
        'image_path',
        'title',
        'url',       
    ];
}
