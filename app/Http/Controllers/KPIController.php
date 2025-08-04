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
    public function showKpiView($id)
    {
        $kpi = Kpi::with('segmentations')->findOrFail($id);
        return view('kpis.kpi-view', compact('kpi'));
    }
}
