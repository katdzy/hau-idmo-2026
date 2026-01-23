<?php

namespace App\Http\Controllers;

use App\Models\IsoMasterDocument;
use Illuminate\Http\Request;

class IsoManagementController extends Controller
{
    public function index()
    {
        // Check if user is authorized
        $userRole = auth()->user()->role;
        $allowedRoles = ['IDC Admin', 'SuperAdmin'];

        if(!in_array($userRole, $allowedRoles)){
            return redirect()->back()->with('error', 'Unauthorized Action');
        }
        // Get total count of all registered documents
        $totalDocuments = IsoMasterDocument::count();
        $originalDocuments = IsoMasterDocument::where('is_original', true)->count();
        $revisedDocuments = IsoMasterDocument::where('current_revision', '>', 0)->count();
        $activeDocuments = IsoMasterDocument::where('status', 'active')->count();
        $deletedDocuments = IsoMasterDocument::where('status', 'deleted')->count();
        $supersededDocuments = IsoMasterDocument::where('status', 'superseded')->count();
        $byClassification = IsoMasterDocument::selectRaw('source_type, COUNT(*) as count')
            ->groupBy('source_type')
            ->get();
        // Top 10 departments
        $byDepartment = IsoMasterDocument::selectRaw('originating_section, COUNT(*) as count')
            ->groupBy('originating_section')
            ->orderBy('count', 'desc')
            ->limit(10)
            ->get();
        return view('iso.management.index', compact(
            'totalDocuments',
            'originalDocuments',
            'revisedDocuments',
            'activeDocuments',
            'deletedDocuments',
            'supersededDocuments',
            'byClassification',
            'byDepartment'
        ));
    }

    public function getDocuments(Request $request)
    {
        $query = IsoMasterDocument::query();
        if($request->has('source_type') && !empty($request->source_type)){
            $query->whereIn('source_type', $request->source_type);
        }
        if($request->has('originating_section') && !empty($request->originating_section)){
            $query->whereIn('originating_section', $request->originating_section);
        }
        if($request->has('status') && !empty($request->status)){
            $query->whereIn('status', $request->status);
        }
        if($request->has('revision_filter')){
            if($request->revision_filter === 'original_only'){
                $query->where('is_original',true);
            } elseif($request->revision_filter === 'has_revisions'){
                $query->where('current_revision', '>', 0);
            }
        }
        $documents = $query->orderBy('registered_at','desc')->get();
        return response()->json($documents);
    }
}
