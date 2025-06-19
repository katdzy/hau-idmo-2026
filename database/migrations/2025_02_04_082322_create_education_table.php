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
        Schema::create('education', function (Blueprint $table) {
            $table->string('id') ->primary();
            $table->string('emp_id'); 
            $table->string('school_name');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('education_type');
            $table->string('school_address');
            $table->string('awards');
            $table->date('grad_date');
            $table->string('last_sem');
            $table->string('so_num');
            $table->string('level');
            $table->string('degree');
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
        Schema::dropIfExists('education');
    }
};
