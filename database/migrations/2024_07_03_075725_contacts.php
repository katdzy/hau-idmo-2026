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
        // Table for provincial contact
        Schema::create('tbl_provincial_contact', function (Blueprint $table) { 
            // pc - Provincial Contact 
            $table->integer('id')->primary(); 
            $table->string('pc_emp_houseno', 50)->nullable(); 
            $table->string('pc_street', 50)->nullable();
            $table->string('pc_brgy', 50)->nullable(); 
            $table->string('pc_city', 50)->nullable(); 
            $table->string('pc_province', 50)->nullable();  
            $table->string('pc_postal_code', 20)->nullable();
            $table->string('pc_phone', 20)->nullable(); 
            $table->timestamps(); 

            // Foreign key constraint
            $table->foreign('id')->references('emp_id')->on('tbl_info')->onDelete('cascade');
        });

        // Table for emergency contacts
        Schema::create('tbl_emergency', function (Blueprint $table) {
            $table->integer('emp_id')->primary();
            // Contact person - cp
            $table->string('cp_fname', 255)->nullable(); 
            $table->string('cp_mname', 255)->nullable(); 
            $table->string('cp_lname', 255)->nullable(); 
            $table->string('cp_relationship', 255)->nullable(); 
            $table->string('cp_house_no', 50)->nullable(); 
            $table->string('cp_street', 50)->nullable();
            $table->string('cp_brgy', 50)->nullable(); 
            $table->string('cp_city', 50)->nullable(); 
            $table->string('cp_province', 50)->nullable();  
            $table->string('cp_postal_code', 20)->nullable();
            $table->string('cp_home_phone', 20)->nullable(); 
            $table->string('cp_mobile_no', 20)->nullable(); 
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('emp_id')->references('emp_id')->on('tbl_info')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_emergency'); 
        Schema::dropIfExists('tbl_provincial_contact'); 
    }
};
