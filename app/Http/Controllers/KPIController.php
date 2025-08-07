<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kpi;

class KpiController extends Controller
{
    /**
     * Display the KPI library dashboard with optional search.
     */
    public function dashboard(Request $request)
    {
        $search = $request->input('search');

        $kpis = Kpi::query()
            ->when($search, function ($query, $search) {
                $query->where('measure_name', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
            })
            ->get();

        return view('kpis.kpi-dashboard', compact('kpis'));
    }

    /**
     * Show details for a single KPI.
     */
    public function showKpiView(Kpi $kpi)
    {
        $kpi->load(['segmentations', 'accreditations', 'dimensions']);
        return view('kpis.kpi-view', compact('kpi'));
    }

    public function create()
    {
        return view('kpis.kpi-add');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'measure_code' => 'required|string|unique:kpis',
            'measure_owner' => 'required|string',
            'measure_name' => 'required|string',
            'description' => 'nullable|string',
            'measure_type' => 'required|string',
            'lead_lag' => 'required|string',
            'formula' => 'nullable|string',
            'unit_type' => 'nullable|string|max:255',
            'polarity' => 'nullable|string|max:255',
            'data_provider' => 'nullable|string|max:255',
            'data_source' => 'nullable|string|max:255',
            'collection_frequency' => 'nullable|string|max:255',
            'reporting_frequency' => 'nullable|string|max:255',
            'verified_by' => 'nullable|string|max:255',
            'validated_by' => 'nullable|string|max:255',
            'baseline' => 'nullable|string|max:255',
            'target' => 'nullable|string|max:255',
            'threshold_low' => 'nullable|string|max:255',
            'threshold_high' => 'nullable|string|max:255',
            'target_rationale' => 'nullable|string|max:255',
            'perspective' => 'nullable|string|max:255',
            'strategic_theme' => 'nullable|string|max:255',
            'objective' => 'nullable|string|max:255',
            'objective_owner' => 'nullable|string|max:255',
            'strategic_initiatives' => 'nullable|string',
            'intended_results' => 'nullable|string',
            'comparator' => 'nullable|string',
            'item_author' => 'nullable|string|max:255',
            'date' => 'nullable|date',
        ]);

        KPI::create($validated); // Make sure the fillable properties are set in your KPI model

        return redirect()->route('kpis.dashboard')->with('success', 'KPI added successfully.');
    }

    public function edit(Kpi $kpi)
    {
        return view('kpis.kpi-edit', compact('kpi'));
    }

    public function update(Request $request, Kpi $kpi)
    {
        $request->validate([
            'measure_code' => 'required|string|max:255|unique:kpis,measure_code,' . $kpi->id,
            'measure_name' => 'required|string|max:255',
            'measure_owner' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'measure_type' => 'nullable|string|max:255',
            'lead_lag' => 'nullable|string|max:255',
            'formula' => 'nullable|string',
            'unit_type' => 'nullable|string|max:255',
            'polarity' => 'nullable|string|max:255',
            'data_provider' => 'nullable|string|max:255',
            'data_source' => 'nullable|string|max:255',
            'collection_frequency' => 'nullable|string|max:255',
            'reporting_frequency' => 'nullable|string|max:255',
            'verified_by' => 'nullable|string|max:255',
            'validated_by' => 'nullable|string|max:255',
            'baseline' => 'nullable|string|max:255',
            'target' => 'nullable|string|max:255',
            'threshold_low' => 'nullable|string|max:255',
            'threshold_high' => 'nullable|string|max:255',
            'target_rationale' => 'nullable|string',
            'perspective' => 'nullable|string|max:255',
            'strategic_theme' => 'nullable|string|max:255',
            'objective' => 'nullable|string|max:255',
            'objective_owner' => 'nullable|string|max:255',
            'strategic_initiatives' => 'nullable|string',
            'intended_results' => 'nullable|string',
            'comparator' => 'nullable|string',
            'item_author' => 'nullable|string|max:255',
            'date' => 'nullable|string|max:255',
        ]);

        $kpi->update($request->only([
            'measure_code',
            'measure_name',
            'measure_owner',
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
        ]));

        return redirect()->route('kpis.dashboard')->with('success', 'KPI updated successfully!');
    }

    public function destroy(Kpi $kpi)
    {
        $kpi->delete();
        return redirect()->route('kpis.dashboard')->with('success', 'KPI deleted successfully!');
    }

    public function ajaxSearch(Request $request)
    {
        $search = $request->input('search');

        $kpis = KPI::when($search, function ($query, $search) {
            return $query->where('measure_name', 'like', "%{$search}%");
        })->get();

        return view('kpis.kpi-search', compact('kpis'));
    }

}
