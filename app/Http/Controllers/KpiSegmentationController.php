<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KpiSegmentationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kpi_id' => 'required|exists:kpis,id',
            'segmentations' => 'required|array',
            'segmentations.*.segmentation' => 'required|string|max:255',
            'segmentations.*.code' => 'nullable|string|max:255',
            'segmentations.*.owner' => 'nullable|string|max:255',
            'segmentations.*.target_level' => 'nullable|string|max:255',
            'segmentations.*.goal' => 'nullable|string|max:255',
        ]);

        foreach ($request->segmentations as $seg) {
            \App\Models\KpiSegmentation::create([
                'kpi_id' => $request->kpi_id,
                'segmentation' => $seg['segmentation'] ?? null,
                'code' => $seg['code'] ?? null,
                'owner' => $seg['owner'] ?? null,
                'target_level' => $seg['target_level'] ?? null,
                'goal' => $seg['goal'] ?? null,
            ]);
        }

        return redirect()->back()->with('success', 'Segmentations added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $segmentation = \App\Models\KpiSegmentation::findOrFail($id);
        $validated = $request->validate([
            'segmentation' => 'required|string|max:255',
            'code' => 'nullable|string|max:255',
            'owner' => 'nullable|string|max:255',
            'target_level' => 'nullable|string|max:255',
            'goal' => 'nullable|string|max:255',
        ]);
        $segmentation->update($validated);
        return redirect()->back()->with('success', 'Segmentation updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $segmentation = \App\Models\KpiSegmentation::findOrFail($id);
        $segmentation->delete();
        return redirect()->back()->with('success', 'Segmentation deleted successfully.');
    }
}
