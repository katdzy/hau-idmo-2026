<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SharepointLinks;

class SharepointController extends Controller
{
    public function index()
    {
        $allLinks = SharepointLinks::orderBy('id')->get();

        $isoLinks = $allLinks->where('category', 'ISO')->groupBy('department');
        $planningLinks = $allLinks->where('category', 'Planning and Review')->groupBy('department');
        $qaLinks = $allLinks->where('category', 'Quality Assurance')->groupBy('department');

        return view('sharepoint-sites.sharepoint-sites-dashboard', compact('isoLinks', 'planningLinks', 'qaLinks'));
    }
}
