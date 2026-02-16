<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Remove ticket_id and ticket_document_id
        Schema::table('iso_master_documents', function (Blueprint $table) {
            $table->dropForeign(['ticket_id']);
            $table->dropForeign(['ticket_document_id']);
            $table->dropColumn(['ticket_id','ticket_document_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('iso_master_documents', function (Blueprint $table) {
            //Re-add columns if rollback
            $table->foreignId('ticket_id')->nullable()
                    ->constrained('iso_tickets')
                    ->nullOnDelete(); //Which ticket created this
            $table->foreignId('ticket_document_id')->nullable()
                    ->constrained('iso_ticket_documents')
                    ->nullOnDelete(); //Specific document in that ticket
        });
    }
};
