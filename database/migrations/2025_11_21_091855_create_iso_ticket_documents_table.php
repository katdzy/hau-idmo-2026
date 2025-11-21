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
        Schema::create('iso_ticket_documents', function (Blueprint $table) {
            $table->id();
            // Foregin key link to iso_tickets.id
            $table->foreignId('ticket_id')->constrained('iso_tickets')->onDelete('cascade');

            $table->string('document_code',100);
            $table->string('document_title',255);
            $table->string('classification',50);
            $table->string('source_type',50);
            $table->string('specific_type',100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iso_ticket_documents');
    }
};
