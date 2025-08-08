<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KpiDimensions extends Model
{
    use HasFactory;

    protected $fillable = [
        'kpi_id',
        'dimensions',
        'description',
    ];

    public function kpi()
    {
        return $this->belongsTo(Kpi::class);
    }
}
