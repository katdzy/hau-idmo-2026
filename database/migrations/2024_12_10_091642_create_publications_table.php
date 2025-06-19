<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicationsTable extends Migration
{
    public function up(): void
    {
        Schema::create('publications', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('emp_id');
            $table->string('title');
            $table->longText('description');
            $table->string('file_path');
            $table->string('attachment');
            $table->string('journal_type');
            $table->date('date_published')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('publications');
    }
}
