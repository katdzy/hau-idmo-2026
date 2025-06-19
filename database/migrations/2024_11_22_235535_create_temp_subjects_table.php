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
        Schema::create('temp_subjects', function (Blueprint $table) {
            $table->id();
            $table->string('subj_code'); 
            $table->string('subj_title'); 
            $table-> integer('units') ;
            $table->string('subj_sy');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temp_subjects');
    }
};
