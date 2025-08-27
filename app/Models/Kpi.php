<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kpi extends Model
{
    use HasFactory;

    protected $table = 'kpis'; // This should match your database table name

    protected $fillable = [
        'measure_code',
        'measure_owner',
        'measure_name',
        'description',
        'measure_type',
        'lead_lag',
        'formula',
        'unit_type',
        'polarity',
        'data_provider',
        'data_source',
        'collection_frequency',
        'reporting_frequency',
        'verified_by',
        'validated_by',
        'baseline',
        'target',
        'threshold_low',
        'threshold_high',
        'target_rationale',
        'perspective',
        'strategic_theme',
        'objective',
        'objective_owner',
        'strategic_initiatives',
        'intended_results',
        'comparator',
        'item_author',
        'date',
        'strat_plan',
        'category',
    ];

    public function getRouteKeyName()
    {
        return 'measure_code';
    }

    public function segmentations()
    {
        return $this->hasMany(\App\Models\KpiSegmentation::class, 'kpi_id');
    }

    public function accreditations()
    {
        return $this->hasMany(\App\Models\KpiAccreditation::class);
    }

    public function dimensions()
    {
        return $this->hasMany(\App\Models\KpiDimensions::class);
    }
}
