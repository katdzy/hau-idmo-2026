<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    ];

    // Define relationship: The document belongs only to one ticket
    public function ticket(){
        return $this->belongsTo(IsoTicket::class,'ticket_id');
    }
}
