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
        Schema::create('iso_master_documents', function (Blueprint $table) {
            $table->id();

            // Documents Identity
            $table->string('document_code')->index();
            $table->string('document_title');
            $table->string('source_type');
            $table->string('specific_type')->nullable();

            // Department/office
            $table->string('originating_section');

            // Revision Tracking
            $table->integer('current_revision')->default(0);
            $table->boolean('is_original')->default(true);
            $table->foreignId('original_document_id')->nullable()
                    ->constrained('iso_master_documents')
                    ->nullOnDelete();
            // Status & Dates
            $table->enum('status', ['Active', 'Superseded', 'Deleted'])->default('Active');
            $table->timestamp('registered_at');
            $table->timestamp('superseded_at')->nullable();
            $table->timestamp('deleted_at')->nullable();

            // Audit Trail (back to ticket system)
            $table->enum('source', ['ticket', 'excel'])->default('ticket');
            $table->foreignId('ticket_id')->nullable()
                    ->constrained('iso_tickets')
                    ->nullOnDelete(); //Which ticket created this
            $table->foreignId('ticket_document_id')->nullable()
                    ->constrained('iso_ticket_documents')
                    ->nullOnDelete(); //Specific document in that ticket

            $table->timestamps();

            // Indexes for fast filtering
            $table->index('originating_section');
            $table->index('source_type');
            $table->index('status');
            $table->index(['document_code', 'current_revision']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iso_master_documents');
    }
};
