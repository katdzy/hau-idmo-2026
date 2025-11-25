<?php

namespace App\Http\Controllers;

use App\Models\IsoTicketDocument;
use App\Models\IsoTicket;
use Illuminate\Http\Request;

class IsoDocumentController extends Controller 
{
    public function authTicketCheck(IsoTicket $ticket){
        // Auth check: Make sure ticket belongs to the current user
        if($ticket->created_by !== auth()->id()){
            abort(403, 'Unauthorized action.');
        }

        // Auth Check: Only allow edit on pending tickets
        if($ticket->status !=='pending'){
            abort(403, 'Cannot edit tickets that are not pending.');
        }
    }
    public function loadDocument(Request $request){
        // Make the query - get the tickets for the current user
        $query = IsoTicket::where('created_by', auth()->id());

        // Status from URL (?status=something)
        $statusFilter = $request->query('status');

        // If a status filter was provided AND it's not 'all'
        if($statusFilter && $statusFilter !== 'all'){
            $query->where('status', $statusFilter);
        }

        // Search filter
        $search = $request->query('search');
        if ($search) {
            $query->where(function($q) use ($search) {
                // Search in ticket fields
                                $q->where('id', '=',  $search)
                                    ->orWhere('originating_section', 'like', "%{$search}%")

                                //   Search in related documents
                                    ->orWhereHas('documents', function($docQuery) use ($search) {
                                            $docQuery->where('document_code', 'like', "%{$search}%")
                                                             ->orWhere('document_title', 'like', "%{$search}%");
                                    });
            });
        }

        // Execute the query with document count and ordering
        $tickets = $query->with('documents')
            ->withCount('documents')
            ->orderBy('created_at','desc')
            ->get();

            
        // Pass tickets to the view and the current filter to the view
        return view('iso.document', compact('tickets', 'statusFilter', 'search'));
    }

    public function editDocument(IsoTicket $ticket){
        // Auth Check
        $this->authTicketCheck($ticket);

        // Load the ticket with its documents relationship
        $ticket -> load('documents');

        // Return the ticket data as JSON for the model
        return response()->json($ticket);
    }

    public function updateDocument(Request $request, IsoTicket $ticket){
        // Auth Check
        $this->authTicketCheck($ticket);

        // Validate incoming data
        $validated = $request->validate([
            'originating_section' => 'required |string|max:255',
            'sharepoint_link' => 'required|url',
            'message_to_idc'=> 'required|string',
            'documents' => 'required|json'
        ]);

        // Parse the documents JSON
        $documents = json_decode($validated['documents'], true);

        // Update the ticket
        $ticket->update([
            'originating_section' => $validated['originating_section'],
            'sharepoint_link'=> $validated['sharepoint_link'],
            'message_to_idc'=>$validated['message_to_idc']
        ]);

        // Delete all existing documents for the current ticket
        $ticket->documents()->delete();

        // Recreate documents with the new list
        foreach ($documents as $document){
            IsoTicketDocument::create([
                'ticket_id' => $ticket->id,
                'document_code' => $document['code'],
                'document_title'=> $document['title'],
                'classification'=> $document['classification'],
                'source_type'=> $document['source'],
                'specific_type'=> $document['specificType'],
            ]);
        }

        return redirect()->route('iso.document')->with('success', 'Ticket updated successfully!');
    }

    public function destroyDocument(IsoTicket $ticket){
        // Check if ticket belongs to current user
        if ($ticket-> created_by !== auth()-> id()){
            abort(403, 'Unauthorized action.');
        }

        // Auth check: Only allow deleting pending tickets
        if ($ticket-> status !== 'pending'){
            abort(403, 'Cannot delete tickets that are not pending.');
        }

        // Delete related documents first (Foreign Key Constraint)
        $ticket->documents()->delete();

        // Delete the ticket itself
        $ticket->delete();

        return redirect()->route('iso.document')->with('success', 'Ticket deleted successfully!');
    }

    public function storeDocument(Request $request){
        $validated = $request ->validate([
            'originating_section'=> 'required|string|max:255',
            'sharepoint_link' => 'required|url',
            'message_to_idc' => 'required|string',
            'documents' => 'required|json'

        ]);
        
        // Parsing the JSON documents
        $documents = json_decode($validated['documents'], true);
        
        $ticket = IsoTicket::create([
            'originating_section'=> $validated['originating_section'],
            'sharepoint_link' => $validated['sharepoint_link'],
            'message_to_idc' => $validated['message_to_idc'],
            'status' => 'pending',
            'created_by' => auth()->id()
        ]);
        
        // Save each document
        foreach($documents as $document){
            IsoTicketDocument::create([
                'ticket_id'=> $ticket->id,
                'document_code' => $document['code'],
                'document_title'=> $document['title'],
                'classification' => $document['classification'],
                'source_type' => $document['source'],
                'specific_type' => $document['specificType']
            ]);
        }
        return redirect()->route('iso.document')->with('success', 'Ticket created successfully!');
    }
    public function submitToIDC(IsoTicket $ticket){
        // Auth check
        $this->authTicketCheck($ticket);

        // Update ticket Status
        $ticket->update([
            'status' => 'submitted_to_idc'
        ]);
        return redirect()->route('iso.document')->with('success','Ticket submitted to IDC successfully!');
    }
}