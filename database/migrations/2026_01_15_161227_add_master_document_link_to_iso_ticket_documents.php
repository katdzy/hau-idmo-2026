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
        Schema::table('iso_ticket_documents', function (Blueprint $table) {
            //Link to master document 
            $table->foreignId('master_document_id')->nullable()
                    ->after('registered_at')
                    ->constrained('iso_master_documents')
                    ->nullOnDelete();

            // When classification = "revision", which document is revising?
            $table->foreignId('revising_master_document_id')->nullable()
                    ->after('master_document_id')
                    ->constrained('iso_master_documents')
                    ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('iso_ticket_documents', function (Blueprint $table) {
            //
            $table->dropForeign(['master_document_id']);
            $table->dropForeign(['revising_master_document_id']);
            $table->dropColumn(['master_document_id', 'revising_master_document_id']);
        });
    }
};
