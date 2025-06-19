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
        Schema::create('certifications', function(Blueprint $table) { 
            $table->string('id')->primary() ; 
            $table->string('emp_id'); 

            //file for certificate
            $table -> string('attachment'); // file path
            $table -> date('date_issued') -> nullable(); 
            $table -> string('duration') -> nullable(); 
            
            //cert infos
            $table -> string('cert_title');
            $table -> date('cert_validity') -> nullable();  
            $table -> string('cert_type') -> nullable() ; //ex: seminar, workshop, etc.
            $table-> string('role') -> nullable() ; //ex: speaker, participation, etc.
            $table-> string('file_path')-> nullable(); //file path for the storage of the web app
            $table->string('issued_by'); 


            $table->string('hau_cert')->nullable(); 
            $table -> string('status'); 
            $table->timestamps(); 
        }); 

        Schema::create('certifications_entries', function(Blueprint $table){ 
            $table-> string('emp_id')-> primary();
            $table-> integer('entries'); 
            $table-> timestamps(); 
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certifications');
        Schema::dropIfExists('certifications_entries'); 
    }
};
