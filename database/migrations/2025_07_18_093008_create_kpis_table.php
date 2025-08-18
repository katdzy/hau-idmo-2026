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
        Schema::create('kpis', function (Blueprint $table) {
            $table->id();
            $table->string('measure_code')->unique();
            $table->string('measure_owner');
            $table->string('measure_name');
            $table->text('description')->nullable();
            $table->string('measure_type');
            $table->string('lead_lag')-> nullable();
            $table->text('formula')->nullable();
            $table->string('unit_type')->nullable();
            $table->string('polarity')->nullable();
            $table->string('data_provider')->nullable();
            $table->string('data_source')->nullable();
            $table->string('collection_frequency')->nullable();
            $table->string('reporting_frequency')->nullable();
            $table->string('verified_by')->nullable();
            $table->string('validated_by')->nullable();
            $table->string('baseline')->nullable();
            $table->string('target')->nullable();
            $table->string('threshold_low')->nullable();
            $table->string('threshold_high')->nullable();
            $table->text('target_rationale')->nullable();

            // Strategy Section
            $table->string('perspective')->nullable();
            $table->string('strategic_theme')->nullable();
            $table->string('objective')->nullable();
            $table->string('objective_owner')->nullable();

            $table->text('intended_results')->nullable();
            $table->text('strategic_initiatives')->nullable();
            
            // Comparator & Meta
            $table->text('comparator')->nullable();
            $table->string('item_author')->nullable();
            $table->date('date')->nullable();

            // Strategic Plan
            $table->string('strat_plan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kpis');
    }
};
