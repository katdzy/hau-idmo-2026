<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use App\Models\VisitSetting;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function index()
    {
        // Get homepage period setting
        $homepage_period = VisitSetting::get('visitor_period', 'daily');
        
        // Default chart period to daily 
        $period = 'daily';
        
        // Get all counts
        $daily_count = Visitor::getCount('daily');
        $monthly_count = Visitor::getCount('monthly');
        $yearly_count = Visitor::getCount('yearly');
        
        // Get chart data for all periods
        $daily_chart = Visitor::getChartData('daily');
        $monthly_chart = Visitor::getChartData('monthly');
        $yearly_chart = Visitor::getChartData('yearly');
        
        return view('visitor-count.visitor-count-dashboard', compact(
            'homepage_period',
            'period',
            'daily_count',
            'monthly_count',
            'yearly_count',
            'daily_chart',
            'monthly_chart',
            'yearly_chart'
        ));
    }

    public function setChartPeriod(Request $request)
    {
        $request->validate([
            'period' => 'required|in:daily,monthly,yearly'
        ]);
        
        // Save chart period to session
        session(['chart_period' => $request->period]);
        
        return redirect()->back();
    }

    public function setHomepagePeriod(Request $request)
    {
        $request->validate([
            'homepage_period' => 'required|in:daily,monthly,yearly'
        ]);
        
        // Save homepage period to database 
        VisitSetting::set('visitor_period', $request->homepage_period);
        
        return redirect()->back()->with('success', 'Period updated successfully');
    }

    public function clearAll()
    {
        Visitor::truncate();
        return redirect()->back()->with('success', 'All visitor data cleared successfully');
    }
}
