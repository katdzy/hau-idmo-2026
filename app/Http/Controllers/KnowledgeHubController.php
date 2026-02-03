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

    /**
     * Display the Knowledge Hub dashboard grouped by categories and departments.
     */
    public function index()
    {
        $allLinks = KnowLedgeHubLinks::orderBy('id')->get();

        // Get all unique categories
        $category = $allLinks->pluck('category')->unique()->filter()->values();

        // Group links by category, then by department
        $linksByCategory = [];
        foreach ($category as $cat) {
            $linksByCategory[$cat] = $allLinks->where('category', $cat)->groupBy('sub_category');
        }

        return view('knowledge-hub.knowledge-hub-dashboard', [
            'category' => $category,
            'linksByCategory' => $linksByCategory,
        ]);
    }

    /**
     * Show the form for creating a new Knowledge Hub link.
     */
    public function create()
    {
        $categories = collect(KnowledgeHubLinks::pluck('category')->unique()->filter(function($v){return !empty($v);})->values()->toArray())->sort()->values()->toArray();

        // Group departments by category
        $subCatByCategory = [];
        foreach ($categories as $cat) {
            $subCatByCategory[$cat] = collect(
                KnowledgeHubLinks::where('category', $cat)
                    ->pluck('sub_category')->unique()->filter(function($v){return !empty($v);})->values()->toArray()
            )->sort()->values()->toArray();
        }

        return view('knowledge-hub.knowledge-hub-add', [
            'categories' => $categories,
            'subCatByCategory' => $subCatByCategory,
        ]);
    }

    /**
     * Store a newly created Knowledge Hub in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category'      => 'nullable|string|max:255',
            'sub_category'  => 'nullable|string|max:255',
            'type'          => 'nullable|string|max:255',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title'         => 'required|string|max:255',
            'url'           => 'required|url|max:1000',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/knowledge-hub'), $imageName);
            $validated['image_path'] = 'images/knowledge-hub/' . $imageName;
        }

        KnowledgeHubLinks::create($validated);

        return redirect()->route('knowledge-hub.dashboard')->with('success', 'Knowledge Hub link added successfully!');
    }

    /**
     * Show the form to select which Knowledge Hub link to edit.
     */
    public function editList()
    {
        $links = KnowledgeHubLinks::orderBy('title')->get();
        return view('knowledge-hub.knowledge-hub-edit-list', compact('links'));
    }

    /**
     * Show the edit form for a specific Knowledge Hub link.
     */
    public function edit($id)
    {
        $link = KnowledgeHubLinks::findOrFail($id);

        // Get all unique categories
        $categories = collect(KnowledgeHubLinks::pluck('category')->unique()->filter(function($v){return !empty($v);})->values()->toArray())->sort()->values()->toArray();

        // Group sub-categories by category
        $subCatByCategory = [];
        foreach ($categories as $cat) {
            $subCatByCategory[$cat] = collect(
                KnowledgeHubLinks::where('category', $cat)
                    ->pluck('sub_category')->unique()->filter(function($v){return !empty($v);})->values()->toArray()
            )->sort()->values()->toArray();
        }

        return view('knowledge-hub.knowledge-hub-edit', [
            'link' => $link,
            'categories' => $categories,
            'subCatByCategory' => $subCatByCategory,
        ]);
    }

    /**
     * Update the specified Knowledge Hub link.
     */
    public function update(Request $request, $id)
    {
        $link = KnowledgeHubLinks::findOrFail($id);

        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'url'           => 'required|url|max:1000',
            'category'      => 'nullable|string|max:255',
            'sub_category'  => 'nullable|string|max:255',
            'type'          => 'nullable|string|max:255',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'remove_image'  => 'nullable',
        ]);

        // Handle image removal
        if ($request->has('remove_image') && $link->image_path) {
            if (file_exists(public_path($link->image_path))) {
                unlink(public_path($link->image_path));
            }
            $validated['image_path'] = null;
        }

        // Handle new image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($link->image_path && file_exists(public_path($link->image_path))) {
                unlink(public_path($link->image_path));
            }
            
            // Upload new image
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/knowledge-hub'), $imageName);
            $validated['image_path'] = 'images/knowledge-hub/' . $imageName;
        }

        // Remove image and remove_image from validated array if not uploading
        unset($validated['image']);
        unset($validated['remove_image']);

        $link->update($validated);

        return redirect()->route('knowledge-hub.edit-list')
                ->with('msg', 'Knowledge Hub link updated successfully.');
    }

    /**
     * Remove the specified Knowledge Hub link from storage.
     */
    public function destroy($id)
    {
        $link = KnowledgeHubLinks::findOrFail($id);
        
        // Delete the image file if it exists
        if ($link->image_path && file_exists(public_path($link->image_path))) {
            unlink(public_path($link->image_path));
        }
        
        // Delete the database record
        $link->delete();

        return redirect()->route('knowledge-hub.edit-list')
            ->with('msg', 'Knowledge Hub link deleted successfully.');
    }

    /**
     * Show a dropdown/form to select a link to edit.
     */
    public function selectForm()
    {
        $links = KnowledgeHubLinks::orderBy('label')->get();
        return view('knowledge-hub.select-link', compact('links'));
    }

    /**
     * Process the selected link and redirect to its edit page.
     */
    public function select(Request $request)
    {
        $validated = $request->validate([
            'link_id' => 'required',
        ]);

        $id = decrypt($validated['link_id']);

        return redirect()->route('knowledge-hub.edit', ['id' => $id]);
    }
}
