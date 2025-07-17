<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KPIController extends Controller
{
    public function dashboard()
    {
        return view('kpis.kpi-dashboard');
    }
}
