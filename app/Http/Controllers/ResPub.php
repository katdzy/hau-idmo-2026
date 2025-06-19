<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Research;
use App\Models\Publication;
use App\Models\requests;
use App\Models\ResearchCoauthor;        
use App\Models\PublicationCoauthor;     
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Carbon;
use Illuminate\Support\Str; 

class ResPub extends Controller
{
    protected function generateId() { 
        do {
            $gen = Auth::user()->id .'rp' . Str::random(10);  
        } while (
            Research::where('id', $gen)->exists() || 
            Publication::where('id', $gen)->exists()); 
        return $gen; 
    }

    protected function createRequest($id, $emp, $date, $title, $type) {
        return requests::insert([
            'id'=> $id, 
            'emp_id'=> $emp, 
            'title'=> $title, 
            'type'=> $type,
            'date_submitted'=> $date
        ]); 
    }

    protected function updateRequest($id,$title) { 
        $req = requests::findOrFail($id); 
        $req->title = $title; 
        $req->save(); 
        return true;
    }

    public function create() { 
        $userId = Auth::user()->id;
        $research = Research::where('emp_id', $userId)->get(); 
        $publication = Publication::where('emp_id', $userId)->get();

        $rapproved = Research::where('emp_id', $userId)->where('status','Approved')->get();
        $rpending = Research::where('emp_id', $userId)->where('status','Pending')->get();
        $rtoreview = Research::where('emp_id', $userId)->where('status','To-review')->get();

        $papproved = Publication::where('emp_id', $userId)->where('status','Approved')->get();
        $ppending = Publication::where('emp_id', $userId)->where('status','Pending')->get();
        $ptoreview = Publication::where('emp_id', $userId)->where('status','To-review')->get();

        $approved = $rapproved->merge($papproved);
        $pending = $rpending->merge($ppending);
        $toreview = $rtoreview->merge($ptoreview);

        $countRes = Research::where('emp_id', $userId)->count();
        $countPub = Publication::where('emp_id', $userId)->count();
        $count = $countRes + $countPub;

        return view('portal.pages.respub.main')->with([
            'user'=> Employee::where('emp_id', $userId)->first(), 
            'research'=> $research, 
            'publication'=> $publication,
            'approved'=> $approved, 
            'pending'=> $pending, 
            'toreview'=> $toreview,
            'rapproved'=> $rapproved,
            'rpending'=> $rpending, 
            'rtoreview'=> $rtoreview,
            'papproved'=> $papproved,
            'ppending'=> $ppending,
            'ptoreview'=> $ptoreview, 
            'count'=> $count       
        ]);
    }

    public function createEdit($id) { 
        $data = Research::find($id);
        if($data) {
            $coauthors = $data->coauthors;
            return view('portal.pages.respub.edit_research')->with([
                'user'=> Employee::where('emp_id', Auth::user()->id)->first(), 
                'data'=> $data,
                'coauthors' => $coauthors,
            ]);
        } else {
            $data = Publication::findOrFail($id);
            $coauthors = $data->coauthors; 
            return view('portal.pages.respub.edit_publication')->with([
                'user'=> Employee::where('emp_id', Auth::user()->id)->first(), 
                'data'=> $data,
                'coauthors' => $coauthors,
            ]);
        }
    }

    public function viewItem($id)
    {
        // Try to find a Research record first
        $research = Research::find($id);
        if ($research) {
            // Retrieve co-authors for this Research
            $coauthors = $research->coauthors; // or ->where('research_id', $id)->get();

            return view('portal.pages.respub.view_research')->with([
                'user'      => Employee::where('emp_id', Auth::user()->id)->first(),
                'data'      => $research,
                'coauthors' => $coauthors,
            ]);
        } else {
            // If not found, it must be a Publication
            $publication = Publication::findOrFail($id);
            $coauthors = $publication->coauthors; // or ->where('publication_id', $id)->get();

            return view('portal.pages.respub.view_publication')->with([
                'user'      => Employee::where('emp_id', Auth::user()->id)->first(),
                'data'      => $publication,
                'coauthors' => $coauthors,
            ]);
        }
    }

    // Separate store methods for Research and Publication
    public function storeResearch(Request $request) {
        $userId = Auth::user()->id;
        $generateID = $this->generateId();
        $type = 'Research';
        $path = 'respub/' . $userId;
        if (!Storage::disk('public')->exists($path)) {
            Storage::disk('public')->makeDirectory($path);
        }

        // Validate
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'attachment' => 'required|file',
            // coauthors will be validated in a more flexible manner
            'coauthors.*.name' => 'nullable|string',
            'coauthors.*.participation' => 'nullable|integer',
        ]);

        // Store the main file
        $save_name = $generateID . '.' . $request->file('attachment')->getClientOriginalExtension();
        $filePath = $request->file('attachment')->storeAs($path, $save_name, 'public');
        $now = now();

        if ($filePath) {
            // Create the main Research
            Research::create([
                'id' => $generateID,
                'emp_id' => $userId,
                'title' => $request->title,
                'description' => $request->description,
                'file_path' => $path . '/' . $save_name,
                'attachment' => $request->file('attachment')->getClientOriginalName(),
                'status' => 'Pending'
            ]);

            // Store multiple co-authors (if any)
            if ($request->has('coauthors')) {
                foreach ($request->coauthors as $co) {
                    ResearchCoauthor::create([
                        'research_id' => $generateID,
                        'coauthor_name' => $co['name'],
                        'coauthor_participation' => $co['participation'],
                    ]);
                }
            }

            // Create the request record
            $this->createRequest($generateID, $userId, $now, $request->title, $type);

            return redirect()->route('portal.respub.success');
        }
    }

    public function storePublication(Request $request) {
        $userId = Auth::user()->id;
        $generateID = $this->generateId();
        $type = 'Publication';
        $path = 'respub/' . $userId;
        if (!Storage::disk('public')->exists($path)) {
            Storage::disk('public')->makeDirectory($path);
        }

        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'attachment' => 'required|file',
            'journal_type' => 'required|string',
            'date_published' => 'nullable|date',
            'coauthors.*.name' => 'nullable|string',
            'coauthors.*.participation' => 'nullable|integer',
        ]);

        // Store file
        $save_name = $generateID . '.' . $request->file('attachment')->getClientOriginalExtension();
        $filePath = $request->file('attachment')->storeAs($path, $save_name, 'public');
        $now = now();

        if ($filePath) {
            $date_published = $request->date_published
                ? Carbon::parse($request->date_published)->format('Y-m-d')
                : null;

            // Create the main Publication
            Publication::create([
                'id' => $generateID,
                'emp_id' => $userId,
                'title' => $request->title,
                'description' => $request->description,
                'file_path' => $path . '/' . $save_name,
                'attachment' => $request->file('attachment')->getClientOriginalName(),
                'journal_type' => $request->journal_type,
                'date_published' => $date_published,
                'status' => 'Pending'
            ]);

            // Save the co-authors
            if ($request->has('coauthors')) {
                foreach ($request->coauthors as $co) {
                    PublicationCoauthor::create([
                        'publication_id' => $generateID,
                        'coauthor_name' => $co['name'],
                        'coauthor_participation' => $co['participation'],
                    ]);
                }
            }

            // Create the request record
            $this->createRequest($generateID, $userId, $now, $request->title, $type);

            return redirect()->route('portal.respub.success');
        }
    }

    public function editItem(Request $request, $id) { 
        // Determine if the record is Research or Publication
        $data = Research::find($id);
        if ($data) {
            // It's a Research record
            $request->validate([
                'title' => 'required|string',
                'description' => 'required|string',
                'coauthors.*.name' => 'nullable|string',
                'coauthors.*.participation' => 'nullable|integer',
                'attachment' => 'file'
            ]);
            
            // If current status is Pending, delete its request ticket
            if ($data->status == 'Pending') {
                $req = requests::find($data->id);
                if ($req) {
                    $req->delete();
                }
            }
            
            // Update basic fields and force status to Pending
            $data->update([
                'title' => $request->title,
                'description' => $request->description,
                'status' => 'Pending',
                'updated_at' => now(),
            ]);
            
            // Remove old coauthors and add the new ones
            $data->coauthors()->delete();
            if ($request->has('coauthors')) {
                foreach ($request->coauthors as $co) {
                    if (!empty($co['name'])) {
                        ResearchCoauthor::create([
                            'research_id' => $data->id,
                            'coauthor_name' => $co['name'],
                            'coauthor_participation' => $co['participation'],
                        ]);
                    }
                }
            }

            // Update attachment if a new file is uploaded
            $path = 'respub/' . Auth::user()->id . '/';
            if($request->file('attachment'))  { 
                // Delete the old file using file_path
                Storage::disk('public')->delete($data->file_path);
                $newExtension = $request->file('attachment')->getClientOriginalExtension();
                $filename = $data->id . '.' . $newExtension;  
                $request->file('attachment')->storeAs($path, $filename, 'public'); 
                $data->attachment = $request->file('attachment')->getClientOriginalName(); 
                $data->file_path = $path . $filename;
                $data->save();
            }
            
            // Create a new request ticket for this research entry
            $this->createRequest($data->id, Auth::user()->id, now(), $request->title, 'Research');
            
        } else {
            // It's a Publication record
            $data = Publication::findOrFail($id);
            $request->validate([
                'title' => 'required|string',
                'description' => 'required|string',
                'journal_type' => 'required|string',
                'date_published' => 'nullable|date',
                'coauthors.*.name' => 'nullable|string',
                'coauthors.*.participation' => 'nullable|integer',
                'attachment' => 'file'
            ]);
            
            if ($data->status == 'Pending') {
                $req = requests::find($data->id);
                if ($req) {
                    $req->delete();
                }
            }
            
            $date_published = $request->date_published ? Carbon::parse($request->date_published)->format('Y-m-d') : null;
            
            $data->update([
                'title' => $request->title,
                'description' => $request->description,
                'journal_type' => $request->journal_type,
                'date_published' => $date_published,
                'status' => 'Pending',
                'updated_at' => now(),
            ]);
            
            // Remove old publication coauthors and add the new ones
            $data->coauthors()->delete();
            if ($request->has('coauthors')) {
                foreach ($request->coauthors as $co) {
                    if (!empty($co['name'])) {
                        PublicationCoauthor::create([
                            'publication_id' => $data->id,
                            'coauthor_name' => $co['name'],
                            'coauthor_participation' => $co['participation'],
                        ]);
                    }
                }
            }

            // Update attachment if a new file is uploaded
            $path = 'respub/' . Auth::user()->id . '/';
            if($request->file('attachment'))  { 
                // Delete the old file using file_path
                Storage::disk('public')->delete($data->file_path);
                $newExtension = $request->file('attachment')->getClientOriginalExtension();
                $filename = $data->id . '.' . $newExtension;  
                $request->file('attachment')->storeAs($path, $filename, 'public'); 
                $data->attachment = $request->file('attachment')->getClientOriginalName(); 
                $data->file_path = $path . $filename;
                $data->save();
            }
            
            
            // Create a new request ticket for this publication entry
            $this->createRequest($data->id, Auth::user()->id, now(), $request->title, 'Publication');
        }
        
        return redirect()->route('portal.respub.edit_success');
    }

    public function createType() { 
        return view('portal.pages.respub.type');
    }

    public function loadResearch(){ 
        return view('portal.pages.respub.research')->with(['user'=>Employee::where('emp_id', Auth::user()->id)->first()]); 
    }

    public function loadPublication() { 
        return view('portal.pages.respub.pub')->with([
            'user'=> Employee::where('emp_id', Auth::user()->id)->first() 
        ]); 
    }

    public function destroy($id) { 
        $res = Research::find($id);
        if($res) {
            Storage::disk('public')->delete($res->file_path);
            $res->delete();
        } else {
            $pub = Publication::findOrFail($id);
            Storage::disk('public')->delete($pub->file_path);
            $pub->delete();
        }

        if(requests::where('id' ,$id)->exists()) { 
            requests::destroy([$id]); 
        }

        return redirect()->route('portal.respub')->with(['msg'=>'The record was deleted.']);
    }
}
