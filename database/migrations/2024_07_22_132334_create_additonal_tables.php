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
        Schema::create('dependencies', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('emp_id'); 
            $table->string('fname'); 
            $table->string('mname')->nullable(); 
            $table->string('lname'); 
            $table->date('date_of_birth');
            $table->string('relationship'); 
            $table->string('status');
            $table->string('attachment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dependencies');
    }
};