<?php

namespace App\Http\Controllers;

use App\Models\IsoTicketDocument;
use App\Models\IsoTicket;
use Illuminate\Http\Request;

class IsoDocumentController extends Controller 
{
    public function loadDocument(){
        // Fetch the tickets created by the current logged-in user
        // withCount('documents') adds a 'documents_count' field to each ticket
        $tickets = IsoTicket::where('created_by', auth()->id())
            ->withCount('documents')
            ->orderBy('created_at', 'desc')
            ->get();
            
        // Pass tickets to the view
        return view('iso.document', compact('tickets'));

        //TODO: More Logic Here in the future
        
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
        
        // TODO: Adding more logic here
        return redirect()->route('iso.document')->with('success', 'Ticket created successfully!');
    }
}