<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KpiSegmentation extends Model
{
    use HasFactory;

    protected $fillable = [
        'kpi_id',
        'segmentation',
        'code',
        'owner',
        'target_level',
        'goal',
    ];

    public function kpi()
    {
        return $this->belongsTo(Kpi::class);
    }
}
