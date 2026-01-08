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
            //Adding the new column for the iso_ticket_documents table
            $table->string('status', 50)
            ->default('submitted_to_idc')
            ->after('specific_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('iso_ticket_documents', function (Blueprint $table) {
            //If ever rolling back Laravel should remove what we added.
            $table->dropColumn('status');
        });
    }
};
