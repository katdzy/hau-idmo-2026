<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KpiAccreditation extends Model
{
    use HasFactory;

    protected $fillable = [
        'kpi_id',
        'accrediting_body_id',
        'accrediting_body_name',
        'program_unit',
    ];

    public function kpi()
    {
        return $this->belongsTo(Kpi::class);
    }
}
