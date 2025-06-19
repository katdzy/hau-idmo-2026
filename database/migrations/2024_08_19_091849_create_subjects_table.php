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

        Schema::create('loads', function(Blueprint $table) { 
            $table->id(); 
            $table-> string('emp_id'); 
            $table-> string('subj_id');
            $table->string('semester');
            $table->string('class_code'); 
            $table->string('class_dept'); 
            $table->string('sy'); //school year
            $table->string('added_by'); //employee id of the admin
            $table-> timestamps(); 
        }); 
        Schema::create('subjects', function (Blueprint $table) {
            $table->string('subj_id')-> primary();
            $table-> string('subj_code'); 
            $table->string('subj_title'); 
            $table-> longText('subj_description')->nullable(); 
            $table->string('subj_sy');
            $table-> integer('units'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
        Schema::dropIfExists('loads'); 
    }
};
