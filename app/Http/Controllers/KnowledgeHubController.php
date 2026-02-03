<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KnowledgeHubLinks;

class KnowledgeHubController extends Controller
{
    /**
     * Display the public Knowledge Hub dashboard (no authentication required).
     */
    public function publicIndex()
    {
        $allLinks = KnowLedgeHubLinks::orderBy('id')->get();

        $categories = $allLinks->pluck('category')->unique()->filter(function($v){return !empty($v);})->sort()->values()->toArray();
        $linksByCategory = [];
        foreach ($categories as $cat) {
            $linksByCategory[$cat] = $allLinks->where('category', $cat)->groupBy('sub_category');
        }

        return view('home.knowledge-hub-home', [
            'categories' => $categories,
            'linksByCategory' => $linksByCategory,
        ]);
    }
}
