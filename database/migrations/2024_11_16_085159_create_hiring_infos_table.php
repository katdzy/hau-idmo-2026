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
        Schema::create('hiring_infos', function (Blueprint $table) {
            $table->string('emp_id')->primary();
            
            $table->string('emp_position')->nullable(); 
            $table->string('emp_nature')-> nullable(); 
            $table-> string('emp_tenure')->nullable(); 
            $table-> string('non_tenured')->nullable();
            $table-> boolean('license')->default(false);
            $table->string('division')->nullable(); 
            $table->string('emp_type')->nullable();
        

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hiring_infos');
    }
};
