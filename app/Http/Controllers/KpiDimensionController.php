<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KpiDimensions;

class KpiDimensionController extends Controller
{
    // List all dimensions for a KPI
    public function index($kpi_id)
    {
        $dimensions = KpiDimensions::where('kpi_id', $kpi_id)->get();
        return view('kpis.dimensions.index', compact('dimensions', 'kpi_id'));
    }

    // Show form to create a new dimension
    public function create($kpi_id)
    {
        return view('kpis.dimensions.create', compact('kpi_id'));
    }

    // Store a new dimension
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kpi_id' => 'required|exists:kpis,id',
            'dimensions' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);
        KpiDimensions::create($validated);
        return redirect()->back()->with('success', 'Dimension added successfully.');
    }

    // Show form to edit a dimension
    public function edit($id)
    {
        $dimension = KpiDimensions::findOrFail($id);
        return view('kpis.dimensions.edit', compact('dimension'));
    }

    // Update a dimension
    public function update(Request $request, $id)
    {
        $dimension = KpiDimensions::findOrFail($id);
        $validated = $request->validate([
            'dimensions' => 'required|string|max:255',
            'code' => 'nullable|string|max:255',
            'owner' => 'nullable|string|max:255',
            'target_level' => 'nullable|string|max:255',
            'goal' => 'nullable|string|max:255',
        ]);
        $dimension->update($validated);
        return redirect()->back()->with('success', 'Dimension updated successfully.');
    }

    // Delete a dimension
    public function destroy($id)
    {
        $dimension = KpiDimensions::findOrFail($id);
        $dimension->delete();
        return redirect()->back()->with('success', 'Dimension deleted successfully.');
    }
}
