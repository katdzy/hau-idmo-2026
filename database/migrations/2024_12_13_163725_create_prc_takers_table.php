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
        Schema::create('prc_takers', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('exam_id');
            $table->string('school');
            $table->integer('first_pass');
            $table->integer('first_fail');
            $table->integer('first_cond')->nullable();
            $table->integer('repeat_pass');
            $table->integer('repeat_fail');
            $table->integer('repeat_cond')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prc_takers');
    }
};
