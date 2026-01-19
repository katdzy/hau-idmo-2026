<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IsoTicketDocument extends Model
{
    //Assign Laravel which table this model uses
    protected $table = 'iso_ticket_documents';

    // Which fields can be mass-assigned
    protected $fillable = [
        'document_code',
        'document_title',
        'classification',
        'source_type',
        'specific_type',
        'ticket_id',
        'status',
        'registered_at',
        'master_document_id',
        'revising_master_document_id',
    ];

    // Define relationship: The document belongs only to one ticket
    public function ticket(){
        return $this->belongsTo(IsoTicket::class,'ticket_id');
    }
        // New Relationship to master_document_id
    public function masterDocument(): BelongsTo
    {
        return $this->belongsTo(IsoMasterDocument::class, 'master_document_id');
    }
    // Relationship to the master document being revised
    public function revisingMasterDocument(): BelongsTo
    {
        return $this->belongsTo(IsoMasterDocument::class, 'revising_master_document_id');
    }
}
