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
        Schema::create('trainings', function (Blueprint $table) {
            $table->string('id')-> primary(); 
            $table->string('emp_id'); 
            $table->string('title'); 
            $table->string('type'); 
            $table->string('organization');
            $table->date('start_date');
            $table->date('end_date');  
            $table->string('hours');  
            $table-> string('skills');
            $table->string('attachment'); 
            $table->string('status'); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainings');
    }
};
