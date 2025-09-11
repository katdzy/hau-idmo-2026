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
        Schema::create('kpi_accreditations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kpi_id')->constrained()->onDelete('cascade');
            $table->string('accrediting_body_id')->nullable();
            $table->string('accrediting_body_name')->nullable();
            $table->string('program_unit')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kpi_accreditations');
    }
};
