<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\IsoTicket;

class TicketStatusChanged extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;
    public $oldStatus;
    public $changedBy;

    /**
     * Create a new message instance.
     */

    public function __construct(IsoTicket $ticket, $oldStatus, $changedBy){
        $this->ticket = $ticket;
        $this->oldStatus = $oldStatus;
        $this->changedBy = $changedBy;
    }

    /**
     * Build the message.
     */
    public function build(){
        return $this->subject('ISO Ticket: ' .$this->ticket->ticket_number. ' -Status Updated to '.$this->ticket->status)
        ->view('emails.ticket-status-changed')
        ->with([
            'recipientName' => 'User'
        ]);
    }
}
